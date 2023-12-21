<?php

namespace App\Controllers;

use App\Classes\FileValidationConfig;
use App\Classes\FileValidationConfigBuilder;
use App\Exceptions\InvalidInputException;
use App\Models\MeasurementSolutionModel;
use App\Utils\FileManager;
use App\Validation\SolutionValidation;
use Exception;
use Throwable;

class CtrlSolution extends CtrlApiFiles
{
    private static $MEASUREMENT_SOLUTIONS_BASE_ROUTE;
    private static $MEASUREMENT_SOLUTIONS_CREATE_ROUTE;
    protected FileValidationConfig $fileConfig;

    public function __construct()
    {
        self::$MEASUREMENT_SOLUTIONS_BASE_ROUTE   = url_to(self::class . '::viewSolutions');
        self::$MEASUREMENT_SOLUTIONS_CREATE_ROUTE = url_to(self::class . '::viewSolutionCreate');

        $fileConfigBuilder = new FileValidationConfigBuilder(self::$MEASUREMENT_SOLUTIONS_BASE_ROUTE);

        $fileConfigBuilder->builder('msIcon')->isSVG()->minFiles(1)->maxFiles(1)->maxSize(1, 'MB')->build();
        $fileConfigBuilder->builder('msImage')->isImage()->minFiles(1)->maxFiles(1)->maxDims(500, 500)->maxSize(2, 'MB')->build();

        $this->fileConfig = $fileConfigBuilder->getConfig();
    }

    public function viewSolutions()
    {
        $measurementSolutionModel = new MeasurementSolutionModel();
        $measurementSolutions     = $measurementSolutionModel->findAll();

        return view('admin/typeSolutions/Solutions', ['measurementSolutions' => $measurementSolutions]);
    }

    public function viewSolutionCreate()
    {
        if (session()->has('clientData')) {
            $this->fileConfig->setDataInClientConfig(session()->get('clientData'));
        }

        return view('admin/typeSolutions/SolutionCreate', ['filepondConfig' => $this->fileConfig->getClientConfig()]);
    }

    public function viewSolutionEdit($msId)
    {
        $msData = (new MeasurementSolutionModel())->getMeasurementSolutionDataWithFiles($msId);

        if (session()->has('clientData')) {
            $dataFiles = session()->get('clientData');
        } else {
            $dataFiles['msIcon']  = [$msData['msIcon']];
            $dataFiles['msImage'] = [$msData['msImage']];
        }

        $this->fileConfig->setDataInClientConfig($dataFiles);

        return view('admin/typeSolutions/SolutionEdit', ['solution' => $msData, 'filepondConfig' => $this->fileConfig->getClientConfig()]);
    }

    public function createSolution()
    {
        $msData = $this->request->getPost();

        try {
            $fileValidationRules = $this->fileConfig->getCollectionFileValidationRules();

            $msDataValidator = new SolutionValidation();
            $msDataValidator->addRules($fileValidationRules['rules'], $fileValidationRules['messages']);

            if (! $msDataValidator->validateInputs($msData)) {
                throw new InvalidInputException($msDataValidator->getErrors());
            }

            $this->insertMsFilesData($msData);

            (new MeasurementSolutionModel())->createMeasurementSolution($msData);

            $this->storeMsFiles($msData);

            $response = [
                'title'   => 'Solución de medición registrada con éxito',
                'message' => 'La solución de medición se ha registrado exitosamente',
                'type'    => 'success',
            ];

            return redirect()->to(self::$MEASUREMENT_SOLUTIONS_BASE_ROUTE)->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $msData);

            return redirect()->to(self::$MEASUREMENT_SOLUTIONS_CREATE_ROUTE)->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $msData);
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al registrar los datos, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to(self::$MEASUREMENT_SOLUTIONS_CREATE_ROUTE)->withInput()->with('response', $response);
        }
    }

    public function updateSolution(string $msId)
    {
        $msUpdatedData = $this->request->getPost();

        try {
            $fileValidationRules = $this->fileConfig->getCollectionFileValidationRules();

            $msDataValidator = new SolutionValidation();
            $msDataValidator->addRules($fileValidationRules['rules'], $fileValidationRules['messages']);

            if (! $msDataValidator->validateInputs($msUpdatedData)) {
                throw new InvalidInputException($msDataValidator->getErrors());
            }

            $this->insertMsFilesData($msUpdatedData);

            (new MeasurementSolutionModel())->updateMeasurementSolution($msId, $msUpdatedData);

            $this->storeMsFiles($msUpdatedData);

            $this->deletePreviousMsFiles($msUpdatedData);

            $response = [
                'title'   => 'Actualización exitosa',
                'message' => 'Los datos de la solución de medición han sido actualizados correctamente',
                'type'    => 'success',
            ];

            return redirect()->to(self::$MEASUREMENT_SOLUTIONS_BASE_ROUTE)->with('response', $response);
        } catch (InvalidInputException $th) {
            session()->setFlashdata('clientData', $msUpdatedData);

            return redirect()->to(url_to(self::class . '::viewSolutionEdit', $msId))->withInput()->with('errors', $th->getErrors());
        } catch (Throwable $th) {
            session()->setFlashdata('clientData', $msUpdatedData);

            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => $th->getMessage(),
                'type'    => 'error',
            ];

            return redirect()->to(self::$MEASUREMENT_SOLUTIONS_BASE_ROUTE)->with('response', $response);
        }
    }

    public function deleteSolution()
    {
        try {
            $msModel = new MeasurementSolutionModel();

            $msData = $msModel->getMeasurementSolutionDataWithFiles($this->request->getPost()['msId']);

            $isDeleted = (new MeasurementSolutionModel())->deleteMeasuremenSolution($msData);

            if (! $isDeleted) {
                throw new Exception();
            }

            $this->deleteMsFiles([$msData['msIcon'], $msData['msImage']]);

            $response = [
                'title'   => 'Eliminación exitosa',
                'message' => 'Se ha eliminado la solución de medición correctamente',
                'type'    => 'success',
            ];

            return redirect()->to(self::$MEASUREMENT_SOLUTIONS_BASE_ROUTE)->with('response', $response);
        } catch (Throwable $th) {
            $response = [
                'title'   => 'Oops! Ha ocurrido un error.',
                'message' => 'Ha ocurrido un error al tratar de eliminar la solución de medición, por favor intente nuevamente.',
                'type'    => 'error',
            ];

            return redirect()->to(self::$MEASUREMENT_SOLUTIONS_BASE_ROUTE)->with('response', $response);
        }
    }

    private function insertMsFilesData(array &$msData)
    {
        $msFiles = $this->fileConfig->filterNewFilesInInputsFile($msData);

        $msData['msIcon']  = $msFiles['msIcon'];
        $msData['msImage'] = $msFiles['msImage'];
    }

    private function storeMsFiles(array $msData)
    {
        FileManager::changeDirectoryCollectionFolder($msData['msIcon']);
        FileManager::changeDirectoryCollectionFolder($msData['msImage']);
    }

    private function deletePreviousMsFiles(array $msData)
    {
        $previousFilesUUIDs = $this->fileConfig->getKeysFolderToDelete($msData);

        foreach ($previousFilesUUIDs as $previousFileUUID) {
            FileManager::deleteMultipleFoldersWithContent($previousFileUUID);
        }
    }

    private function deleteMsFiles(array $msUUIDFiles)
    {
        FileManager::deleteMultipleFoldersWithContent($msUUIDFiles);
    }
}
