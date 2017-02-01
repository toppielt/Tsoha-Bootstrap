<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }
    
     public static function edit_omat_tiedot(){
    View::make('suunnitelmat/edit_omat_tiedot.html');
  }

  public static function omat_tiedot(){
    View::make('suunnitelmat/omat_tiedot.html');
  }

  public static function login(){
    View::make('suunnitelmat/login.html');
  }

}
