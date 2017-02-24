<?php

class BaseController {

    public static function get_user_logged_in() {
        // Katsotaan onko user-avain sessiossa
        if (isset($_SESSION['kayttaja'])) {
            $jasennumero = $_SESSION['kayttaja'];
            // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
            $kayttaja = Kayttaja::find($jasennumero);

            return $kayttaja;
        }

        // Käyttäjä ei ole kirjautunut sisään
        return null;

        // ...
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['kayttaja'])) {
            Redirect::to('/login', array('message' => 'Sinun täytyy kirjautua ensin!'));
        }
    }

    
}
