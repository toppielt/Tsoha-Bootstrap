<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/edit_omat_tiedot', function() {
    HelloWorldController::edit_omat_tiedot();
});
$routes->get('/omat_tiedot', function() {
    HelloWorldController::omat_tiedot();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});
