<?php

namespace Config;

use App\Controllers\CtrlEmail;
use App\Controllers\CtrlLogin;

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


/*
 * --------------------------------------------------------------------
 * LOGIN
 * --------------------------------------------------------------------
 */
$routes->group('login', static function($routes) {
    /** @var \CodeIgniter\Router\RouteCollection $routes */
    $routes->get('', [CtrlLogin::class, 'index']);
    $routes->get('password/reset', [CtrlLogin::class, 'viewPasswordEmail']);
    $routes->get('password/reset/(:any)', [CtrlLogin::class, 'viewPasswordReset']);
    $routes->post('', [CtrlLogin::class, 'login']);
    $routes->post('password/reset', [CtrlEmail::class, 'sendEmailToResetPassword']);
    $routes->post('password/reset/(:any)', [CtrlLogin::class, 'passwordReset']);
    $routes->post('out', [CtrlLogin::class, 'logout']);
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
