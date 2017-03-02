<?php

class Harjoitus extends BaseModel {

    public $harjoitusid, $pvm, $kello, $paikka, $maxosallistujat, $kesto, $lisatiedot, $omaharjoitus, $nimi;

    public function __construct($attributes) {
        parent::__construct($attributes);

        // $ekaharjoitus = new Harjoitus(array('harjoitusid' => 1, 'pvm' => 01-01-2017, 'kello' => 18.00, 'paikka' => 'Kovelo', 'maxOsallistujat' => 12, 'kesto' => 1.5 ,'lisatiedot' => 'ei ole', 'omaharjoitu' => false ));
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * from Harjoitus');

        $query->execute();

        $rows = $query->fetchAll();

        $harjoitukset = array();

        foreach ($rows as $row) {
            $harjoitukset[] = new Harjoitus(array(
                'harjoitusid' => $row['harjoitusid'],
                'pvm' => $row['pvm'],
                'kello' => $row['kello'],
                'paikka' => $row['paikka'],
                'maxosallistujat' => $row['maxosallistujat'],
                'kesto' => $row['kesto'],
                'lisatiedot' => $row['lisatiedot'],
                'omaharjoitus' => $row['omaharjoitus']
            ));
        }
        return $harjoitukset;
    }

    public static function find($harjoitusid) {
        $query = DB::connection()->prepare('SELECT * FROM Harjoitus WHERE harjoitusid = :harjoitusid LIMIT 1');
        $query->execute(array('harjoitusid' => $harjoitusid));
        $row = $query->fetch();

        if ($row) {
            $harjoitus = new Harjoitus(array(
                'harjoitusid' => $row['harjoitusid'],
                'pvm' => $row['pvm'],
                'kello' => $row['kello'],
                'paikka' => $row['paikka'],
                'maxosallistujat' => $row['maxosallistujat'],
                'kesto' => $row['kesto'],
                'lisatiedot' => $row['lisatiedot'],
                'omaharjoitus' => $row['omaharjoitus']
            ));
            return $harjoitus;
        }
        return null;
    }

    public static function omat($jasennumero) { 
        
        $query = DB::connection()->prepare('SELECT * from Kayttajanharjoitus WHERE ampuja = :jasennumero'); 

        $query->execute();

        $rows = $query->fetchAll();

        $harjoitukset = array();

        foreach ($rows as $row) {
            $harjoitukset[] = new Harjoitus(array(
                'harjoitusid' => $row['harjoitus']
            ));
        }
        return $harjoitukset;
       
    }

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Harjoitus (pvm, kello, paikka, maxosallistujat, kesto, lisatiedot, omaharjoitus) VALUES (:pvm, :kello, :paikka, :maxosallistujat, :kesto, :lisatiedot, :omaharjoitus) RETURNING harjoitusid');

        $query->execute(array('pvm' => $this->pvm, 'kello' => $this->kello, 'paikka' => $this->paikka, 'maxosallistujat' => $this->maxosallistujat, 'kesto' => $this->kesto, 'lisatiedot' => $this->lisatiedot, 'omaharjoitus' => $this->omaharjoitus));

        $row = $query->fetch();

        $this->harjoitusid = $row['harjoitusid'];
    }

    public function destroy($harjoitusid) {

        $query = DB::connection()->prepare('DELETE FROM Harjoitus WHERE harjoitusid = :harjoitusid');

        $query->execute(array('harjoitusid' => $harjoitusid));
    }
    
    public static function osallistujat($harjoitusid) {
        
         $query = DB::connection()->prepare('SELECT Kayttaja.nimi AS kayttaja, Harjoitus.harjoitusid AS harjoitus FROM Kayttaja, Kayttajanharjoitus, Harjoitus WHERE Kayttaja.jasennumero = Kayttajanharjoitus.kayttaja AND Kayttajanharjoitus.harjoitus = Harjoitus.harjoitusid AND Kayttajanharjoitus.harjoitus = :harjoitusid');

        $query->execute();

        $rows = $query->fetchAll();

        $osallistujat = array();

        foreach ($rows as $row) {
            $osallistujat[] = new Harjoitus(array(
                'harjoitus' => $row['harjoitusid'],
                'kayttaja' =>$row['jasennumero']
            ));
        }
        return $osallistujat;
        
    }
    
     public function update() {

        $query = DB::connection()->prepare('UPDATE Harjoitus SET (pvm, paikka, kello, maxosallistujat, kesto, lisatiedot, omaharjoitus) = ( :pvm, :paikka, :kello, :maxosallistujat, :kesto, :lisatiedot, :omaharjoitus) WHERE harjoitusid= :harjoitusid');

        $query->execute(array(
            'harjoitusid' => $this->harjoitusid,
            'pvm' => $this->pvm,
            'paikka' => $this->paikka,
            'kello' => $this->kello,
            'maxosallistujat' => $this->maxosallistujat,
            'kesto' => $this->kesto,
            'lisatiedot' => $this->lisatiedot,
            'omaharjoitus' => $this->omaharjoitus
        ));

        $row = $query->fetch();
    }

}
