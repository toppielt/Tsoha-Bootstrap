<?php

class Ammunta extends BaseModel {

    public $ammuntaid, $rasti, $asetyyppi, $laukausmaara;

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

        $query = DB::connection()->prepare('INSERT INTO Ammunta (rasti, asetyyppi, laukausmaara) VALUES (:rasti, :asetyyppi, :laukausmaara) RETURNING ammuntaid');

        $query->execute(array('rasti' => $this->rasti, 'asetyyppi' => $this->asetyyppi, 'laukausmaara' => $this->laukausmaara));
        
        $row = $query->fetch();
        
        $this->ammuntaid = $row['ammuntaid'];
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

        $query = DB::connection()->prepare('UPDATE Kayttaja SET (nimi, email, salasana, status) = ( :nimi, :email, :salasana, :status) WHERE jasennumero= :jasennumero');

        $query->execute(array(
            'jasennumero' => $this->jasennumero,
            'nimi' => $this->nimi,
            'email' => $this->email,
            'salasana' => $this->salasana,
            'status' => $this->status
        ));

        $row = $query->fetch();
    }

}
