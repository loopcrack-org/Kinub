<?php

namespace Config;

use App\Controllers\CtrlCategory;
use App\Controllers\CtrlEmail;
use App\Controllers\CtrlLogin;
use App\Controllers\CtrlHomeSection;
use App\Controllers\CtrlSolution;
use App\Controllers\CtrlTestFiles;

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
$routes->get('/equipos', 'CtrlPublicPages::viewEquipment');


/*
 * --------------------------------------------------------------------
 * LOGIN
 * --------------------------------------------------------------------
 */
$routes->get('login', [CtrlLogin::class, 'index']);
$routes->get('password_reset', [CtrlLogin::class, 'viewPasswordEmail']);
$routes->get('password_reset/(:any)', [CtrlLogin::class, 'viewPasswordReset']);
$routes->post('login', [CtrlLogin::class, 'login']);
$routes->post('password_reset', [CtrlEmail::class, 'sendEmailToResetPassword']);
$routes->post('password_reset/(:any)', [CtrlLogin::class, 'passwordReset']);
$routes->post('logout', [CtrlLogin::class, 'logout']);
/*
 * --------------------------------------------------------------------
 * ADMIN
 * --------------------------------------------------------------------
 */
$routes->group('admin', static function($routes) {
    /** @var \CodeIgniter\Router\RouteCollection $routes */

    $routes->get('', [CtrlHomeSection::class, 'viewHomeSection']);
    $routes->group('home', static function($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('editar', [CtrlHomeSection::class, 'viewHomeSectionEdit']);
        $routes->post('editar', [CtrlHomeSection::class, 'editHomeSection']);
    });

    $routes->group('soluciones', static function($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlSolution::class, 'viewSolutions']);
        $routes->get('crear', [CtrlSolution::class, 'viewSolutionCreate']);
        $routes->post('crear', [CtrlSolution::class, 'createSolution']);
        $routes->get('editar/(:num)', [CtrlSolution::class, 'viewSolutionEdit']);
        $routes->post('editar/(:num)', [CtrlSolution::class, 'updateSolution']);
        $routes->post('borrar', [CtrlSolution::class, 'deleteSolution']);
    });

    $routes->group('categorias', static function($routes) {
        /** @var \CodeIgniter\Router\RouteCollection $routes */
        $routes->get('', [CtrlCategory::class, 'viewCategories']);
        $routes->get('crear', [CtrlCategory::class, 'viewCategoryCreate']);
        $routes->post('crear', [CtrlCategory::class, 'createCategory']);
        $routes->get('editar/(:num)', [CtrlCategory::class, 'viewCategoryEdit']);
        $routes->post('editar/(:num)', [CtrlCategory::class, 'updateCategory']);
        $routes->post('borrar', [CtrlCategory::class, 'deleteCategory']);
    });

    $routes->get('testFiles', [CtrlTestFiles::class, 'index']);
    $routes->post('testFiles', [CtrlTestFiles::class, 'saveData']);
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
