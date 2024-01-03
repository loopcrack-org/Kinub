<?php

namespace App\Controllers;

use App\Models\CategoryTagModel;
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
}
