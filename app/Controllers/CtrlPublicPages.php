<?php

namespace App\Controllers;

class CtrlPublicPages extends BaseController
{
    public function index(): string
    {
        return view('public/index');
    }

    public function viewSupport(): string
    {
        $data = [
            'metaTitle'       => 'Soporte',
            'metaDescription' => 'Contacta a Soporte de Kinub y obten ayuda con tus productos',
        ];

        return view('public/support', $data);
    }

    public function viewEquipment(): string
    {
        $data = [
            'metaTitle'       => 'Equipos',
            'metaDescription' => 'Descubre los mejores equipos que puedes encontrar solo en Kinub',
        ];

        return view('public/equipment', $data);
    }

    public function viewCategory(): string
    {
        $filter = $this->request->getGet();

        // default values
        $filter['categoria']      = empty($filter['categoria']) ? [] : explode(',', $filter['categoria']);
        $filter['producto-tags']  = empty($filter['producto-tags']) ? [] : explode(',', $filter['producto-tags']);
        $filter['categoria-tags'] = empty($filter['categoria-tags']) ? [] : explode(',', $filter['categoria-tags']);

        $categories   = [];
        $categoryTags = [];
        $productTags  = [];

        for ($i = 1; $i <= 8; $i++) {
            $categoryName        = "Categoria {$i}";
            $categoryNameSlug    = "categoria-{$i}";
            $categoryTagName     = "Tag categoria {$i}";
            $categoryTagNameSlug = "cat-tag-{$i}";
            $productTagName      = "Tag producto {$i}";
            $productTagNameSlug  = "pro-tag-{$i}";

            $categories[] = [
                'name'     => $categoryName,
                'slug'     => $categoryNameSlug,
                'selected' => in_array($categoryNameSlug, $filter['categoria'], true),
            ];

            $categoryTags[] = [
                'name'     => $categoryTagName,
                'slug'     => $categoryTagNameSlug,
                'selected' => in_array($categoryTagNameSlug, $filter['categoria-tags'], true),
            ];
            $productTags[] = [
                'name'     => $productTagName,
                'slug'     => $productTagNameSlug,
                'selected' => in_array($productTagNameSlug, $filter['producto-tags'], true),
            ];
        }

        // title, description and image for metadata here will be dynamic and will need to be according to the category that is loaded
        $data = [
            'metaTitle'       => 'Categoría',
            'metaDescription' => 'Explora los mejores productos de la categoría',
            'categories'      => $categories,
            'categoryTags'    => $categoryTags,
            'productTags'     => $productTags,
            // 'metaImage' => 'imagenCategoria.jpg'
        ];

        return view('public/category', $data);
    }

    public function viewCertificates(): string
    {
        $data = [
            'metaTitle'       => 'Certificados',
            'metaDescription' => 'Conoce los Certificados que acreditan la experiencia y excelencia de Kinub',
        ];

        return view('public/certificates', $data);
    }

    public function viewProduct(): string
    {
        // title, description and image for metadata here will be dynamic and will need to be according to the product that is loaded
        $data = [
            'metaTitle'       => 'Producto',
            'metaDescription' => 'Mira nuestro nuevo y genial producto',
            // 'metaImage' => 'imagenProducto.jpg'
        ];

        return view('public/product', $data);
    }

    public function viewPrivacyPolicy(): string
    {
        $data = [
            'metaTitle'       => 'Aviso de Privacidad',
            'metaDescription' => 'Aviso de Privacidad de Kinub',
        ];

        return view('public/privacy-policy', $data);
    }
}
