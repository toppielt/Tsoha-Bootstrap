<?php

  class BaseController{

    public static function get_user_logged_in(){
    // Katsotaan onko user-avain sessiossa
    if(isset($_SESSION['kayttaja'])){
      $jasennumero = $_SESSION['kayttaja'];
      // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
      $kayttaja = User::find($jasennumero);

      return $kayttaja;
    }

    // Käyttäjä ei ole kirjautunut sisään
    return null;
  
  // ...
}

    public static function check_logged_in(){
      // Toteuta kirjautumisen tarkistus tähän.
      // Jos käyttäjä ei ole kirjautunut sisään, ohjaa hänet toiselle sivulle (esim. kirjautumissivulle).
    }

  }
