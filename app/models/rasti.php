<?php

class Rasti extends BaseModel {

    public $rastiid, $ammunta, $harjoitus, $rastikuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);

        // $ekaharjoitus = new Harjoitus(array('harjoitusid' => 1, 'pvm' => 01-01-2017, 'kello' => 18.00, 'paikka' => 'Kovelo', 'maxOsallistujat' => 12, 'kesto' => 1.5 ,'lisatiedot' => 'ei ole', 'omaharjoitu' => false ));
    }

    public static function harjoituksenRastit($harjoitusid) {

        $query = DB::connection()->prepare('SELECT * from Rasti WHERE harjoitusid = :harjoitusid ');

        $query->execute();

        $rows = $query->fetchAll();

        $rastit = array();

        foreach ($rows as $row) {
            $rastit[] = new Rasti(array(
                'rastiid' => $row['rastiid'],
                'ammunta' => $row['ammunta'],
                'harjoitus' => $row['harjoitus'],
                'rastikuvaus' => $row['rastikuvaus']
            ));
        }
        return $rastit;
    }

    public static function find($rastiid) {
        $query = DB::connection()->prepare('SELECT * FROM Rasti WHERE rastiid = :rastiid LIMIT 1');
        $query->execute(array('rastiid' => $rastiid));
        $row = $query->fetch();

        if ($row) {
            $rasti = new Rasti(array(
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

}
