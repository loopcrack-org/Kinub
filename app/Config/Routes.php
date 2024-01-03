<?php

namespace Config;

use App\Controllers\CtrlAboutUs;
use App\Controllers\CtrlAdminEmail;
use App\Controllers\CtrlApiPublic;
use App\Controllers\CtrlCategory;
use App\Controllers\CtrlCertificate;
use App\Controllers\CtrlEmail;
use App\Controllers\CtrlHomeSection;
use App\Controllers\CtrlLogin;
use App\Controllers\CtrlProduct;
use App\Controllers\CtrlPublicPages;
use App\Controllers\CtrlSolution;
use App\Controllers\CtrlUser;
use CodeIgniter\Router\RouteCollection;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'CtrlPublicPages::index');
$routes->get('/soporte', 'CtrlPublicPages::viewSupport');
$routes->post('/email/contacto', 'CtrlEmail::sendContactEmail');
$routes->post('/email/soporte', 'CtrlEmail::sendSupportEmail');
$routes->post('/email/producto', 'CtrlEmail::sendProductEmail');
$routes->get('/equipos', 'CtrlPublicPages::viewEquipment');
$routes->get('/categoria/(:num)', [CtrlPublicPages::class, 'viewCategory']);
$routes->get('/certificados', 'CtrlPublicPages::viewCertificates');
$routes->get('/producto', 'CtrlPublicPages::viewProduct');
$routes->get('/aviso', 'CtrlPublicPages::viewPrivacyPolicy');
$routes->group('api', static function (RouteCollection $routes) {
    $routes->get('categorytags', [CtrlApiPublic::class, 'getCategoryTags']);
});

/*
 * --------------------------------------------------------------------
 * LOGIN
 * --------------------------------------------------------------------
 */
$routes->get('login', [CtrlLogin::class, 'index']);
$routes->get('password_reset', [CtrlLogin::class, 'viewPasswordEmail']);
$routes->get('password_reset/(:any)', [CtrlLogin::class, 'viewPasswordReset']);
$routes->get('password_set/(:any)', [CtrlLogin::class, 'viewPasswordSet']);
$routes->get('password_response', [CtrlLogin::class, 'viewPasswordResponse']);
$routes->post('login', [CtrlLogin::class, 'login']);
$routes->post('password_reset', [CtrlEmail::class, 'sendEmailToResetPassword']);
$routes->post('password_reset/(:any)', [CtrlLogin::class, 'passwordReset']);
$routes->post('password_set/(:any)', [CtrlLogin::class, 'passwordSet']);
$routes->post('logout', [CtrlLogin::class, 'logout']);
/*
 * --------------------------------------------------------------------
 * ADMIN
 * --------------------------------------------------------------------
 */
$routes->group('admin', static function ($routes) {
    /** @var \CodeIgniter\Router\RouteCollection $routes */
    $routes->get('', [CtrlHomeSection::class, 'viewHomeSection']);
    $routes->group('home', static function ($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('editar', [CtrlHomeSection::class, 'viewHomeSectionEdit']);
        $routes->post('editar', [CtrlHomeSection::class, 'editHomeSection']);
    });

    $routes->group('soluciones', static function ($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlSolution::class, 'viewSolutions']);
        $routes->get('crear', [CtrlSolution::class, 'viewSolutionCreate']);
        $routes->post('crear', [CtrlSolution::class, 'createSolution']);
        $routes->get('editar/(:num)', [CtrlSolution::class, 'viewSolutionEdit']);
        $routes->post('editar/(:num)', [CtrlSolution::class, 'updateSolution']);
        $routes->post('borrar', [CtrlSolution::class, 'deleteSolution']);
        generateFileApiRoutesByController($routes, CtrlSolution::class);
    });

    $routes->group('productos', static function ($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlProduct::class, 'viewProducts']);
        $routes->get('crear', [CtrlProduct::class, 'viewProductCreate']);
        $routes->post('crear', [CtrlProduct::class, 'createProduct']);
        $routes->get('editar/(:num)', [CtrlProduct::class, 'viewProductEdit']);
        $routes->post('editar/(:num)', [CtrlProduct::class, 'updateProduct']);
        $routes->post('borrar', [CtrlProduct::class, 'deleteProduct']);
        generateFileApiRoutesByController($routes, CtrlProduct::class);
    });
    $routes->group('categorias', static function ($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlCategory::class, 'viewCategories']);
        $routes->get('crear', [CtrlCategory::class, 'viewCategoryCreate']);
        $routes->post('crear', [CtrlCategory::class, 'createCategory']);
        $routes->get('editar/(:num)', [CtrlCategory::class, 'viewCategoryEdit']);
        $routes->post('editar/(:num)', [CtrlCategory::class, 'updateCategory']);
        $routes->post('borrar', [CtrlCategory::class, 'deleteCategory']);
        generateFileApiRoutesByController($routes, CtrlCategory::class);
    });

    $routes->group('certificados', static function ($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlCertificate::class, 'viewCertificates']);
        $routes->get('crear', [CtrlCertificate::class, 'viewCertificateCreate']);
        $routes->post('crear', [CtrlCertificate::class, 'createCertificate']);
        $routes->get('editar/(:num)', [CtrlCertificate::class, 'viewCertificateEdit']);
        $routes->post('editar/(:num)', [CtrlCertificate::class, 'updateCertificate']);
        $routes->post('borrar', [CtrlCertificate::class, 'deleteCertificate']);
        generateFileApiRoutesByController($routes, CtrlCertificate::class);
    });

    $routes->group('emails', static function ($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlAdminEmail::class, 'viewEmails']);
        $routes->get('ver/(:num)', [CtrlAdminEmail::class, 'viewSpecificEmails']);
        $routes->post('borrar', [CtrlAdminEmail::class, 'deleteEmail']);
    });

    $routes->group('usuarios', static function ($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlUser::class, 'viewUsers']);
        $routes->get('crear', [CtrlUser::class, 'viewUserCreate']);
        $routes->post('crear', [CtrlUser::class, 'createUser']);
        $routes->get('editar/(:num)', [CtrlUser::class, 'viewUserEdit']);
        $routes->post('editar/(:num)', [CtrlUser::class, 'updateUser']);
        $routes->post('borrar', [CtrlUser::class, 'deleteUser']);
        $routes->get('reenviarConfirmacionCuenta/(:num)', [CtrlUser::class, 'resendConfirmationEmail/$1']);
    });
    $routes->group('nosotros', static function ($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlAboutUs::class, 'viewAboutUsEdit']);
        $routes->post('', [CtrlAboutUs::class, 'updateAboutUsSection']);
        generateFileApiRoutesByController($routes, CtrlAboutUs::class);
    });
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

// generate routes dynamically
function generateFileApiRoutesByController(RouteCollection $routes, string $controller)
{
    $routes->post('process', [$controller, 'processTemporalFile']);
    $routes->patch('process', [$controller, 'processTemporalFileByChunks']);
    $routes->get('restore', [$controller, 'restoreTemporalFile']);
    $routes->get('load', [$controller, 'getFileFromServer']);
    $routes->delete('delete', [$controller, 'deleteTemporalFile']);
}
