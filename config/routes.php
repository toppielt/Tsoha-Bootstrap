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

$routes->get('/kayttaja/:jasennumero/edit', function($jasennumero){
    //Redirect::to('{{base_path}}');
  KayttajaController::editKayttaja($jasennumero);
});
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



$routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
  KayttajaController::login();
});

$routes->post('/login', function(){
  // Kirjautumisen käsittely
  KayttajaController::handle_login();
});


$routes->post('/kayttaja/:jasennumero/edit', function($jasennumero){

  KayttajaController::update($jasennumero);
});

$routes->post('/kayttaja/:jasennumero/destroy', function($jasennumero){
  // Pelin poisto
  KayttajaController::destroy($jasennumero);
});

