<?php

$routes->get('/', function() {
    HarjoitusController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

// kayttajan reitit

$routes->get('/kayttaja/:jasennumero/edit', function($jasennumero) {
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

$routes->post('/kayttaja/:jasennumero/edit', function($jasennumero) {

    KayttajaController::update($jasennumero);
});

$routes->post('/kayttaja/:jasennumero/destroy', function($jasennumero) {

    KayttajaController::destroy($jasennumero);
});

$routes->get('/omatharjoitukset', function() {
    HarjoitusController::omatHarjoitukset();
});

//harjoitus reitit
$routes->post('/ilmoittaudu', function() {
    
    HarjoitusController::ilmoittaudu();
});

$routes->get('/harjoitus', function() {
    HarjoitusController::index();
});

$routes->get('/harjoitus/uusi', function() {
    HarjoitusController::create();
});
$routes->post('/harjoitus/', function() {
    HarjoitusController::store();
});


$routes->get('/harjoitus/:harjoitusid', function($harjoitusid) {
    HarjoitusController::showHarjoitus($harjoitusid);
});

$routes->get('/harjoitus/:harjoitusid/edit', function($harjoitusid) {
HarjoitusController::editHarjoitus($harjoitusid);

});

$routes->post('/harjoitus/:harjoitusid/edit', function($harjoitusid) {
HarjoitusController::update($harjoitusid);
});

$routes->get('/harjoitus/:harjoitusid/osallistujat', function($harjoitusid) {
KayttajaController::osallistujat($harjoitusid);
});



$routes->post('/logout', function() {
    KayttajaController::logout();
});



$routes->post('/harjoitus/:harjoitusid/destroy', function($harjoitusid) {

    HarjoitusController::destroy($harjoitusid);
});
    


$routes->get('/harjoitus/:harjoitusid/rasti/lisaa', function($harjoitusid) {
RastiController::create($harjoitusid);
});

// rastin reitit

$routes->post('/harjoitus/:harjoitusid/rasti/lisaa', function() {
RastiController::store();
});

$routes->get('/harjoitus/:rastiid/ammunta', function($rastiid) {
RastiController::lisaaAmmunta($rastiid);
});

$routes->get('/rasti/:rastiid/tulos', function($rastiid) {
RastiController::tulos($rastiid);
});

$routes->post('/kayttaja/:harjoitusid/destroy', function($harjoitusid) {
HarjoitusController::peru($harjoitusid);
});

$routes->post('/rasti/:rasti/tulos', function() {
RastiController::storeTulos();
});

$routes->post('/rasti/:rasti/ammunta', function() {
RastiController::storeAmmunta();
});




$routes->get('/login', function() {
    // Kirjautumislomakkeen esittäminen
    KayttajaController::login();
});

$routes->post('/login', function() {
    // Kirjautumisen käsittely
    KayttajaController::handle_login();
});