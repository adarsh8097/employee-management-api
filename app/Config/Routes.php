<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Department;
$routes->post('/department/add','Department::addDepartment');
$routes->get('/department/alldata','Department::GetAlldepartment');
$routes->get('/department/singledata/(:num)','Department::SingleDepartment/$1');
$routes->put('/department/update/(:num)','Department::UpdateSingledata/$1');
$routes->delete('/department/delete/(:num)','Department::DeleteDepartementedata/$1');
// Employee add;
$routes->post('/employee/add','Employee::addEmployee');
$routes->get('/employee/alldata','Employee::GetAllEmployee');
$routes->get('/employee/data/(:num)','Employee::SingleEmployee/$1');
$routes->put('employee/update/(:num)','Employee::UpdateEmployeedetails/$1');
$routes->delete('/employee/delete/(:num)','Employee::DeleteEmployeedata/$1');
$routes->get('/employees/search', 'Employee::search');