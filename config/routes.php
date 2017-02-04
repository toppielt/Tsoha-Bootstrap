<?php

$routes->get('/', function() {
    HarjoitusController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/harjoitus', function() {
    HarjoitusController::index();
});

$routes->get('/harjoitus/uusi', function() {
    HarjoitusController::uusi();
});

$routes->get('/harjoitus/:harjoitusid', function($harjoitusid) {
    HarjoitusController::showHarjoitus($harjoitusid);
});

//$routes->get('/edit_omat_tiedot', function() {
//  HelloWorldController::edit_omat_tiedot();
//});
$routes->get('/kayttaja/', function() {
    KayttajaController::index();
});

$routes->post('/kayttaja/', function() {
    KayttajaController::store();
});

$routes->get('/kayttaja/uusi', function() {
    KayttajaController::create();
});





$routes->get('/kayttaja/:jasennumero', function($jasennumero) {
    KayttajaController::showKayttaja($jasennumero);
});



$routes->get('/login', function() {
    HelloWorldController::login();
});
