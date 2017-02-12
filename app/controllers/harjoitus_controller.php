<?php

class HarjoitusController extends BaseController{
    
    public static function index(){
        $harjoitukset = Harjoitus::all();
        
        View::make('harjoitus/index.html', array('harjoitukset' =>$harjoitukset));
    }
    
    public static function showHarjoitus($harjoitusid) {
       
        $harjoitus = Harjoitus::find($harjoitusid);
        View::make('harjoitus/harjoitus.html', array('harjoitus' =>$harjoitus));
    }
  
}
