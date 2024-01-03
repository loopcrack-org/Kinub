<?php

namespace App\Validation;

use App\Models\CategoryModel;

class ProductValidation extends BaseValidation
{
    protected $validationRules = [
        'productName'          => 'required',
        'productModel'         => 'required',
        'productCategoryId'    => 'required',
        'productDescription'   => 'required',
        'productDetails'       => 'required',
        'productTechnicalInfo' => 'required',
        'categoryTags'         => 'required',
    ];
    protected $validationMessages = [
        'productName'          => ['required' => 'El nombre del producto es obligatorio'],
        'productModel'         => ['required' => 'El modelo es obligatorio'],
        'productCategoryId'    => ['required' => 'La categoría del producto es obligatoria'],
        'categoryTags'         => ['required' => 'Los tags de la categoría son obligatorios'],
        'productDescription'   => ['required' => 'La descripción del producto es obligatoria'],
        'productTechnicalInfo' => ['required' => 'Los detalles del producto son obligatorios'],
        'productDetails'       => ['required' => 'La ficha técnica del producto es obligatoria'],
    ];

    public function existCategoryId(string $categoryId)
    {
        $category = (new CategoryModel())->selectCount('categoryId', 'category')->find($categoryId);

        if (! $category) {
            $this->errors = [
                'productCategoryId' => 'La categoría seleccionada no existe',
            ];

            return false;
        }

        return true;
    }
}
