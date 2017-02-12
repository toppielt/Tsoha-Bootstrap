<?php

class Kayttaja extends BaseModel {

    public $jasennumero, $nimi, $email, $salasana, $status;

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
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE jasennumero = :jasennumero LIMIT 1');
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

        $query = DB::connection()->prepare('INSERT INTO Kayttaja (jasennumero, nimi, email, salasana, status) VALUES (:jasennumero, :nimi, :email, :salasana, :status)');

        $query->execute(array('jasennumero' => $this->jasennumero, 'nimi' => $this->nimi, 'email' => $this->email, 'salasana' => $this->salasana, 'status' => $this->status));

        $row = $query->fetch();
    }

    public function destroy($jasennumero) {

        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE kayttaja.jasennumero = $jasennumero');
    }

    public function authenticate() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
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
        } else {
            return null;
        }
    }

}
