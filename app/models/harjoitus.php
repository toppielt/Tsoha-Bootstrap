<?php

class Harjoitus extends BaseModel {

    public $harjoitusid, $pvm, $kello, $paikka, $maxosallistujat, $kesto, $lisatiedot, $omaharjoitus;

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

    public function uusi() {
         $query = DB::connection()->prepare('INSERT INTO Harjoitus (pvm, kello, paikka, maxosallistujat, kesto, lisatiedot ) VALUES (:pvm; :kello, :paikka, :maxosallistujat, :kesto, :lisatiedot) RETURNING harjoitusID');
         
         $query->execute(array('pvm' => $this->pvm, 'kello' => $this->kello, 'paikka' => $this->paikka, 'maxosallistujat' => $this->maxosallistujat, 'kesto' => $this->kesto, 'lisatiedot' => $this->lisatiedot));
         
         $row = $query->fetch();
         
         $this->harjoitusid = $row['harjoitusid'];
    }
}

