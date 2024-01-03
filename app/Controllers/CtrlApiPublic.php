<?php

namespace App\Controllers;

use App\Exceptions\InvalidInputException;
use App\Models\CategoryTagModel;
use App\Models\ProductModel;
use App\Validation\ApiPublicValidation;
use CodeIgniter\HTTP\Response;
use Throwable;

class CtrlApiPublic extends BaseController
{
    /**
     * get all category tags according to the requested categories
     *
     * @return array
     */
    public function getCategoryTags()
    {
        try {
            $categoryIds      = $this->request->getGet('category');
            $categoryTagModel = new CategoryTagModel();
            $categoryTags     = $categoryTagModel->getAllByCategories([$categoryIds]);

            return $this->response->setJSON($categoryTags);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, 'error')->setJSON(['error' => 'Ha ocurrido un error, porfavor inténtalo de nuevo']);
        }
    }

    /**
     * get product with filters applied
     *
     * @return array
     */
    public function getProducts()
    {
        try {
            $filter    = $this->request->getGet();
            $validator = new ApiPublicValidation();

            // validation
            if (! $validator->validateInputs($filter)) {
                throw new InvalidInputException($validator->getErrors());
            }

            // default values
            $filter['categorias']     = empty($filter['categorias']) ? [] : explode(',', $filter['categorias']);
            $filter['producto-tags']  = empty($filter['producto-tags']) ? [] : explode(',', $filter['producto-tags']);
            $filter['categoria-tags'] = empty($filter['categoria-tags']) ? [] : explode(',', $filter['categoria-tags']);

            $productModelQueryBuilder = (new ProductModel())->filterProducts(
                $filter['categorias'],
                $filter['categoria-tags'],
                $filter['producto-tags'],
                $filter['busqueda'] ?? ''
            )->order($filter['orden'] ?? 'asc');

            $totalProducts  = $productModelQueryBuilder->countAllResults(false);
            $productsByPage = $productModelQueryBuilder->getByPage($filter['pagina'], $filter['por-pagina']);

            return $this->response->setJSON([
                'metadata' => [
                    'page'    => (int) ($filter['pagina']),
                    'perPage' => (int) ($filter['por-pagina']),
                    'total'   => $totalProducts,
                ],
                'products' => $productsByPage,
            ]);
        } catch (InvalidInputException $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, 'invalid request')->setJSON(['errors' => $th->getErrors()]);
        } catch (Throwable $th) {
            return $this->response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR, 'error')->setJSON(['error' => 'Ha ocurrido un error en el filtro']);
        }
    }
}
