<?php

use App\Models\UserModel;
use CodeIgniter\Router\RouteCollection;
use CodeIgniter\Controller\LoginController;

/** @var RouteCollection $routes */


$routes->get('/', 'AuthController::index');

$routes->post('/login', 'AuthController::login');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->group('', ['filter' => 'role:registrar'], function ($routes) {

        $routes->get('/registrar', 'Registrar\DashboardController::index');

        $routes->get('/registrar/manage-student', 'Registrar\ManageStudent::index');

        $routes->get('/registrar/manage-subjects', 'Registrar\ManageSubject::index');

        $routes->get('/registrar/manage-enrollment', 'Registrar\ManageEnrollment::index');
        $routes->post('/registrar/manage-enrollment', 'Registrar\ManageEnrollment::enroll');
        $routes->get('/registrar/manage-enrollment/records', 'Registrar\ManageEnrollment::getRecords');
        $routes->get('/registrar/manage-enrollment/(:num)', 'Registrar\ManageEnrollment::viewRecord/$1');

        $routes->get('/registrar/manage-schedules', 'Registrar\ManageSchedule::index');

        $routes->get('/registrar/reports', 'Registrar\Report::index');
    });


    $routes->get('/logout', 'AuthController::logout');
});
