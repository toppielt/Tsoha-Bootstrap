<?php

class Kayttaja extends BaseModel {
    
    public $jasennumero, $nimi, $email, $salasana, $status;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        
        //$matti = new Kayttaja(array('jasennumero' => 1234, 'name' => 'MAtti', 'email' => 'matti@meikalainen.com', 'salasana' => 'mopo', 'status' => "admin"));
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $kayttajat = array();
        
        foreach ($rows as $row) {
            
            $kayttajat[] = new Kayttaja(array(
                'jasennumero' => $row['jasennumero'],
                'nimi' => $row['nimi'],
                'email' => $row['email'],
                'salasana' => $row['salasana'],
                'status' => $row['status']
            ));
        }
        return $kayttajat;
    }
    
    public static function find($jasennumero) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE jasennumero = :jasennumero LIMIT 1');
        $query->execute(array('jasennumero' => $jasennumero));
        $row = $query->fetch();
        
        if($row){
            $kayttaja = new Kayttaja(array(
                'jasennumero' => $row['jasennumero'],
                'nimi' => $row['nimi'],
                'email' => $row['email'],
                'salasana' => $row['salasana'],
                'status' => $row['status']
            ));
            return $kayttaja;
        }
        return null;
    }
}
