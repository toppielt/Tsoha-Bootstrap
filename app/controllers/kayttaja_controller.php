<?php

class KayttajaController extends BaseController {

    public static function index() {
        $kayttajat = Kayttaja::all();

        View::make('kayttaja/index.html', array("kayttajat" => $kayttajat));
    }

    public static function showKayttaja($jasennumero) {

        $kayttaja = Kayttaja::find($jasennumero);

        View::make('kayttaja/kayttaja.html', array('kayttaja' => $kayttaja));
    }

    public static function store() {
        $params = $_POST;



        $kayttaja = new Kayttaja(array(
            'jasennumero' => $params['jasennumero'],
            'nimi' => $params['nimi'],
            'email' => $params['email'],
            'salasana' => $params['salasana'],
            'status' => $params['status']
        ));
        // Luodaan validoija
        $v = new Valitron\Validator(array(
            'jasennumero' => $params['jasennumero'],
            'nimi' => $params['nimi'],
            'email' => $params['email'],
            'salasana' => $params['salasana'],
            'status' => $params['status']));
        // Tietojen validointi
        $v->rule('required', 'jasennumero');
        $v->rule('required', 'nimi');
        $v->rule('required', 'email');
        $v->rule('required', 'salasana');
        $v->rule('required', 'status');

        $v->rule('integer', 'jasennumero');
        $v->rule('lengthMax', 'jasennumero', 10);
        $v->rule('lengthMin', 'jasennumero', 4);

        $v->rule('lengthMin', 'nimi', 5);
        $v->rule('lengthMax', 'nimi', 30);

        $v->rule('email', 'email');

        $v->rule('lengthMin', 'salasana', 8);
        $v->rule('lengthMax', 'salasana', 20);



        if ($v->validate()) {
            echo 'Hyvin meni';
        } else {
            print_r($v->errors());
            View::make('kayttaja/uusi.html', array('message' => $v->errors()));
        }
        $kayttaja->save();

        Redirect::to('/kayttaja/', array('message' => 'Käyttäjä on tallennettu!'));
    }

    public static function create() {
        View::make('kayttaja/uusi.html');
    }

    public static function editKayttaja($jasennumero) {
        $kayttaja = Kayttaja::find($jasennumero);
        View::make('kayttaja/edit.html', array('kayttaja' => $kayttaja));
    }

    public static function update($jasennumero) {
        $params = $_POST;

        $attributes = array(
            'jasennumero' => $jasennumero,
            'nimi' => $params['nimi'],
            'email' => $params['email'],
            'salasana' => $params['salasana'],
            'status' => $params['status']
        );

        $v = new Valitron\Validator(array(
            'nimi' => $params['nimi'],
            'email' => $params['email'],
            'salasana' => $params['salasana'],
            'status' => $params['status']));
        // Tietojen validointi

        $v->rule('required', 'nimi');
        $v->rule('required', 'email');
        $v->rule('required', 'salasana');
        $v->rule('required', 'status');


        $v->rule('lengthMin', 'nimi', 5);
        $v->rule('lengthMax', 'nimi', 30);

        $v->rule('email', 'email');

        $v->rule('lengthMin', 'salasana', 8);
        $v->rule('lengthMax', 'salasana', 20);



        $kayttaja = new Kayttaja($attributes);

        

        if ($v->validate()) {
              $kayttaja->update();
            Redirect::to('/kayttaja/' . $kayttaja->jasennumero, array('message' => 'Tietojen muokkaus onnistui!'));
            } else {
           print_r($v->errors());
            View::make('/kayttaja/edit.html', array('kayttaja' => $kayttaja, 'message' => 'pieleen meni'));

            
        }
    }

    public static function destroy($jasennumero) {

        $kayttaja = new Kayttaja(array('jasennumero' => $jasennumero));

        $kayttaja->destroy($jasennumero);

        Redirect::to('/kayttaja', array('message' => 'Käyttäjä poistettu onnistuneesti!'));
    }

   public static function login() {
       View::make('/login.html');
    }

    public static function handle_login() {
        
        $params = $_POST;

        $kayttaja = User::authenticate($params['jasennumero'], $params['salasana']);

        if (!$kayttaja) {
            View::make('login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'jasennumero' => $params['jasennumero']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->jasennumero;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->nimi . '!'));
        }
    }

    public static function validateKayttaja($kayttaja) {

        $v = new Valitron\Validator(array(
            'jasennumero' => $kayttaja['jasennumero'],
            'nimi' => $kayttaja['nimi'],
            'email' => $kayttaja['email'],
            'salasana' => $kayttaja['salasana'],
            'status' => $kayttaja['status']));
        // Tietojen validointi
        $v->rule('required', 'jasennumero');
        $v->rule('required', 'nimi');
        $v->rule('required', 'email');
        $v->rule('required', 'salasana');
        $v->rule('required', 'status');

        $v->rule('integer', 'jasennumero');
        $v->rule('lengthMax', 'jasennumero', 10);
        $v->rule('lengthMin', 'jasennumero', 4);

        $v->rule('lengthMin', 'nimi', 5);
        $v->rule('lengthMax', 'nimi', 30);

        $v->rule('email', 'email');

        $v->rule('lengthMin', 'salasana', 8);
        $v->rule('lengthMax', 'salasana', 20);

        return $v->errors();
    }

}
