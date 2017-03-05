<?php

class Rasti extends BaseModel {

    public $rastiid, $harjoitus, $rastikuvaus;

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
                'rastiid' => $row['rastiid'],
                'harjoitus' => $row['harjoitus'],
                'rastikuvaus' => $row['rastikuvaus']
            ));
            return $rasti;
        }
        return null;
    }

    public function save() {
       
        
        $query = DB::connection()->prepare('INSERT INTO Rasti (harjoitus, rastikuvaus) VALUES ( :harjoitus, :rastikuvaus) RETURNING rastiid');

        $query->execute(array('harjoitus' => $this->harjoitus, 'rastikuvaus' => $this-> rastikuvaus));

        $row = $query->fetch();

        $this->rastiid = $row['rastiid'];
    }
    
     public function destroy($rastiid) {

        $query = DB::connection()->prepare('DELETE FROM Rasti WHERE rastiid = :rastiid');

        $query->execute(array('rastiid' => $rastiid));
    }

}
