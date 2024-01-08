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
        'productTechnicalInfo' => 'regex_match[/^(?:(?!"(\d+)"|:"\s*"|\[".*"\]).)*$/]',
        'categoryTags'         => 'required',
        'relevance'            => 'required|integer|regex_match[/^([1-9]|[1-9][0-9]|100)$/]',
    ];
    protected $validationMessages = [
        'productName'          => ['required' => 'El nombre del producto es obligatorio'],
        'productModel'         => ['required' => 'El modelo es obligatorio'],
        'productCategoryId'    => ['required' => 'La categoría del producto es obligatoria'],
        'categoryTags'         => ['required' => 'Los tags de la categoría son obligatorios'],
        'productDescription'   => ['required' => 'La descripción del producto es obligatoria'],
        'productTechnicalInfo' => ['regex_match' => 'Los detalles del producto son obligatorios'],
        'productDetails'       => ['required' => 'La ficha técnica del producto es obligatoria'],
        'relevance'            => [
            'required'    => 'La relevancia del producto es obligatoria',
            'integer'     => 'La relevancia debe de ser un dato entero',
            'regex_match' => 'La relevancia debe tener un valor entre 1 y 100',
        ],
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
