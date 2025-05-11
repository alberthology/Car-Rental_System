<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/Renter/register', 'auth::register');
// $routes->get('/renterpage', 'auth::login'); 

// Authentication Routes
// Show login page
$routes->post('/auth/loginProcess', 'Auth::loginProcess'); // Process login
$routes->get('/logout', 'Auth::logout'); // Logout user
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'RegisterController::register');
$routes->post('register/registerCompany', 'RegisterController::registerCompany');
$routes->post('RegisterController/registerCompany', 'RegisterController::registerCompany');
$routes->post('register/registerRenter', 'RegisterController::registerRenter');

// UPDATED ROUTE - ROY
// $routes->post('RegisterController/registerRenter', 'RegisterController::registerRenter');


$routes->get('/renterpage', 'Auth::renter');

// Admin Dashboard Routes - cleaned up and organized
$routes->group('AdminDashBoard', ['namespace' => 'App\Controllers', 'filter' => 'adminauth'], function ($routes) {
    $routes->get('adminpage', 'Auth::adminpage');
    $routes->get('logout', 'Auth::adminLogout');
});

$routes->group('admin', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('approve/(:num)', 'AdminController::approve/$1');
    $routes->get('decline/(:num)', 'AdminController::decline/$1');
    $routes->get('approve/renter/(:num)', 'AdminController::approveRenter/$1');
    $routes->get('decline/renter/(:num)', 'AdminController::declineRenter/$1');
});


$routes->get('RentalCompany/managerent', 'RentalController::managerent');
$routes->get('RentalCompany/approveRental/(:num)', 'RentalController::approveRental/$1');
$routes->get('RentalCompany/rejectRental/(:num)', 'RentalController::rejectRental/$1');
// Remove these duplicate routes
// $routes->get('/adminpage', 'AdminController::admin');
// $routes->get('adminpage/approve/(:num)', 'AdminController::approve/$1');
// $routes->get('adminpage/decline/(:num)', 'AdminController::decline/$1');

// Authentication
$routes->get('/loginpage', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->post('auth/loginProcess', 'Auth::loginProcess');
$routes->post('/loginProcess', 'Auth::loginProcess');


$routes->post('auth/login', 'Auth::loginProcess'); // Process login
$routes->get('/logout', 'Auth::logout'); // Logout


// $routes->get('adminpage', 'Home::Adminpage');
$routes->get('dashboard', 'Dashboard::dashboard');
$routes->get('companycars', 'Dashboard::Cars');

$routes->get('/loginpage', 'AdminController::logout');

// renter
$routes->get('Renter/companycars', 'RenterController::cars');
$routes->get('Renter/rent', 'RenterController::rent');
$routes->get('Renter/profile', 'RenterController::profile');
$routes->get('Renter/loginpage', 'RenterController::logout');
$routes->get('Renter/cardetailsEuropcar', 'CardetailsController::index');
$routes->get('Renter/cardetailsHertz', 'CardetailsController::index');

// company
$routes->get('RentalCompany/company', 'CompanyController::company');
$routes->get('RentalCompany/managecars', 'CompanyController::manage');
$routes->get('RentalCompany/reports', 'ReportsController::reports');
$routes->get('RentalCompany/loginpage', 'CompanyController::logout');

// $routes->get('RentalCompany/notification', 'NotificationController::notification');


$routes->get('/dashboard', 'Dashboard::dashboard', ['filter' => 'authfilter']);


$routes->get('RentalCompany/notification', 'NotificationController::notif');



//new
$routes->get('Renter/cars/europcar', 'RenterController::europcar');
$routes->get('Renter/cars/hertz', 'RenterController::hertz');
$routes->get('Renter/cars/avis', 'RenterController::avis');
$routes->get('Renter/cars/alamo', 'RenterController::alamo');
$routes->get('Renter/cars/budget', 'RenterController::budget');
$routes->get('Renter/cars/national', 'RenterController::national');
$routes->get('Renter/cars/dollar', 'RenterController::dollar');
$routes->get('Renter/cars/thrifty', 'RenterController::thrifty');
$routes->get('Renter/cars/goldcar', 'RenterController::goldcar');
$routes->get('Renter/cars/sixt', 'RenterController::sixt');

// cars
$routes->get('/manage-cars', 'CarController::index');
$routes->post('/CarController/addCar', 'CarController::addCar');
$routes->get('/CarController/updateStatus/(:num)/(:any)', 'CarController::updateStatus/$1/$2');

$routes->post('/manage-cars/add', 'CarController::addCar');
$routes->post('/manage-cars/update-status', 'CarController::updateStatus');



// rental
$routes->get('RentalCompany/managerent', 'RentalController::managerent');
$routes->get('RentalCompany/approveRental/(:num)', 'RentalController::approveRental/$1');
$routes->get('RentalCompany/rejectRental/(:num)', 'RentalController::rejectRental/$1');
$routes->get('/admin/dashboard', 'AdminController::dashboard');

// Car Management Routes
$routes->group('manage-cars', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'CarController::index');
    $routes->post('add', 'CarController::addCar');
    $routes->post('update-status', 'CarController::updateStatus');
});

// Admin logout route
$routes->get('/AdminDashBoard/logout', 'Auth::adminLogout');
$routes->post('/AdminDashBoard/logout', 'Auth::adminLogout'); // Add POST route just in case
$routes->get('/notification', 'Admin\NotificationController::notification');


$routes->get('/adminpage', 'AdminController::admin');

//eurpcar
$routes->match(['get', 'post'], 'Renter/confirmBooking', 'RenterController::confirmBooking');

$routes->get('/AdminDashBoard/adminpage', 'Auth::adminpage');
$routes->get('/renterpage', 'Auth::renter');
$routes->get('/RentalCompany/company', 'Auth::company');

$routes->get('/logout', 'Auth::logout');

$routes->get('/admin', 'AdminController::admin');
$routes->get('/admin/dashboard', 'AdminController::dashboard');
$routes->get('/admin/approve/(:num)', 'AdminController::approve/$1');
$routes->get('/admin/decline/(:num)', 'AdminController::decline/$1');
