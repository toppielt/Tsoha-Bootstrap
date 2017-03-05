<?php

class Tulos extends BaseModel {

    public $ampuja, $rasti, $aika, $pisteet;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
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
        $query = DB::connection()->prepare('SELECT * FROM Tulos WHERE jasennumero = :jasennumero LIMIT 1');
        $query->execute(array('jasennumero' => $jasennumero));
        $row = $query->fetch();

        if ($row) {
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

    public function save() {

        $query = DB::connection()->prepare('INSERT INTO Tulos (ampuja, rasti, aika, pisteet) VALUES (:ampuja, :rasti, :aika, :pisteet)');

        $query->execute(array('ampuja' => $this->ampuja, 'rasti' => $this->rasti, 'aika' => $this->aika, 'pisteet' => $this->pisteet));

        $row = $query->fetch();
        error_log($row);
    }

    public function destroy($jasennumero) {

        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE jasennumero = :jasennumero');

        $query->execute(array('jasennumero' => $jasennumero));
    }

    public function authenticate($jasennumero, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE jasennumero = :jasennumero AND salasana = :salasana LIMIT 1');
        $query->execute(array('jasennumero' => $jasennumero, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
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

    public function update() {

        $query = DB::connection()->prepare('UPDATE Kayttaja SET (ampuja, rasti, aika, pisteet) = ( :ampuja, :rasti, :aika, :pisteet) WHERE jasennumero= :jasennumero');

        $query->execute(array(
            'ampuja' => $this->ampuja,
            'rasti' => $this->rasti,
            'aika' => $this->aika,
            'pisteet' => $this->pisteet
        ));

        $row = $query->fetch();
    }

}
