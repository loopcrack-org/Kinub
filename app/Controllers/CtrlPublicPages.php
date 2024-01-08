<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\CertificateModel;

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
        $categoryModel = new CategoryModel();
        $categories    = $categoryModel->join('files', 'files.fileId = categories.categoryIconId')->findAll();
        $data          = [
            'metaTitle'       => 'Equipos',
            'metaDescription' => 'Descubre los mejores equipos que puedes encontrar solo en Kinub',
            'categories'      => $categories,
        ];

        return view('public/equipment', $data);
    }

    public function viewCategory($categoryId): string
    {
        // title, description and image for metadata here will be dynamic and will need to be according to the category that is loaded
        $categoryModel = new CategoryModel();
        $category      = $categoryModel->join('files', 'files.fileId = categories.categoryImageId')->find($categoryId);
        $data          = [
            'metaTitle'       => $category['categoryName'],
            'metaDescription' => 'Explora los mejores productos de ' . $category['categoryName'],
            'metaImage'       => $category['fileRoute'],
        ];

        return view('public/category', $data);
    }

    public function viewCertificates(): string
    {
        $certificates = (new CertificateModel())->getAllCertificateWithFiles();
        $data         = [
            'metaTitle'       => 'Certificados',
            'metaDescription' => 'Conoce los Certificados que acreditan la experiencia y excelencia de Kinub',
            'certificates'    => $certificates,
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
