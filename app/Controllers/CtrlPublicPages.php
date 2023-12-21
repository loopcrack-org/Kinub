<?php

namespace App\Controllers;

use App\Models\HomeSectionModel;

class CtrlPublicPages extends BaseController
{
    public function index(): string
    {
        $aboutUsData = (new HomeSectionModel())->getDataWithFiles();

        return view('public/index', ['aboutUsData' => $aboutUsData]);
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
        // title, description and image for metadata here will be dynamic and will need to be according to the category that is loaded
        $data = [
            'metaTitle'       => 'Categoría',
            'metaDescription' => 'Explora los mejores productos de la categoría',
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
