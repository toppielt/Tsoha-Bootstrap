<?php

class KayttajaController extends BaseController{
    
    public static function index(){
            $kayttajat = Kayttaja::all();
            
            View::make('kayttaja/index.html', array("kayttajat" => $kayttajat));
    }
    
    public static function showKayttaja($jasennumero) {
        
        $kayttaja = Kayttaja::find($jasennumero);
        
        View::make('kayttaja/kayttaja.html', array('kayttaja' => $kayttaja)) ;
        
    }
    
    public static function store(){
        $params = $_POST;
        
        $kayttaja = new Kayttaja(array(
            'jasennumero' => $params['jasennumero'],
            'nimi' => $params['nimi'],
            'email' => $params['email'],
            'salasana' => $params['salasana'],
            'status' => $params['status']
        ));
        $kayttaja->save();
        
        Redirect::to('/kayttaja/', array('message' => 'Käyttäjä on tallennettu!'));
    }
    
    public static function create() {
        View::make('kayttaja/uusi.html');
    }
}
