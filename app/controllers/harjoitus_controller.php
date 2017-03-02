<?php

class HarjoitusController extends BaseController {

    public static function index() {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $harjoitukset = Harjoitus::all();

        View::make('harjoitus/index.html', array('harjoitukset' => $harjoitukset, 'user_logged_in' => $user_logged_in));
    }

    public static function showHarjoitus($harjoitusid) {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $harjoitus = Harjoitus::find($harjoitusid);
        View::make('harjoitus/harjoitus.html', array('harjoitus' => $harjoitus, 'user_logged_in' => $user_logged_in));
    }

    public static function create() {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        View::make('harjoitus/uusi.html', array('user_logged_in' => $user_logged_in));
    }

    public static function store() {

        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $params = $_POST;

        $harjoitus = new Harjoitus(array(
            'pvm' => $params['pvm'],
            'paikka' => $params['paikka'],
            'kello' => $params['kello'],
            'maxosallistujat' => $params['maxosallistujat'],
            'kesto' => $params['kesto'],
            'lisatiedot' => $params['lisatiedot'],
            'omaharjoitus' => $params['omaharjoitus']
        ));
        // Luodaan validoija
        $v = new Valitron\Validator(array(
            'pvm' => $params['pvm'],
            'paikka' => $params['paikka'],
            'kello' => $params['kello'],
            'maxosallistujat' => $params['maxosallistujat'],
            'kesto' => $params['kesto'],
            'lisatiedot' => $params['lisatiedot'],
            'omaharjoitus' => $params['omaharjoitus']
        ));

        // Tietojen validointi
        $v->rule('required', 'pvm');
        $v->rule('required', 'paikka');
        $v->rule('required', 'kello');
        $v->rule('required', 'maxosallistujat');
        $v->rule('required', 'kesto');


        $v->rule('date', 'pvm');

        $v->rule('numeric', 'kesto');

        $v->rule('numeric', 'kello');

        if ($v->validate()) {
            echo 'Hyvin meni';
        } else {
            print_r($v->errors());
            View::make('harjoitus/uusi.html', array('message' => $v->errors(), 'user_logged_in' => $user_logged_in));
        }
        $harjoitus->save();

        Redirect::to('/', array('message' => 'Harjoitus on tallennettu!', 'user_logged_in' => $user_logged_in));
    }

    public static function destroy($harjoitusid) {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $harjoitus = new Harjoitus(array('harjoitusid' => $harjoitusid));

        $harjoitus->destroy($harjoitusid);

        Redirect::to('/harjoitus', array('message' => 'Harjoitus poistettu onnistuneesti!', 'user_logged_in' => $user_logged_in));
    }

    public static function editHarjoitus($harjoitusid) {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $harjoitus = Harjoitus::find($harjoitusid);

        View::make('harjoitus/edit.html', array('harjoitus' => $harjoitus, 'user_logged_in' => $user_logged_in));
    }

    public static function update($harjoitusid) {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $params = $_POST;

        $attributes = array(
            'pvm' => $params['pvm'],
            'paikka' => $params['paikka'],
            'kello' => $params['kello'],
            'maxosallistujat' => $params['maxosallistujat'],
            'kesto' => $params['kesto'],
            'lisatiedot' => $params['lisatiedot'],
            'omaharjoitus' => $params['omaharjoitus']
        );
        // Luodaan validoija
        $v = new Valitron\Validator(array(
            'pvm' => $params['pvm'],
            'paikka' => $params['paikka'],
            'kello' => $params['kello'],
            'maxosallistujat' => $params['maxosallistujat'],
            'kesto' => $params['kesto'],
            'lisatiedot' => $params['lisatiedot'],
            'omaharjoitus' => $params['omaharjoitus']
        ));

        // Tietojen validointi
        $v->rule('required', 'pvm');
        $v->rule('required', 'paikka');
        $v->rule('required', 'kello');
        $v->rule('required', 'maxosallistujat');
        $v->rule('required', 'kesto');

        $v->rule('date', 'pvm');

        $harjoitus = new Harjoitus($attributes);

        if ($v->validate()) {
            $harjoitus->update();
            Redirect::to('/', $harjoitus->harjoitusid, array('message' => 'Tietojen muokkaus onnistui!', 'user_logged_in' => $user_logged_in));
        } else {
            print_r($v->errors());
            View::make('/harjoitus/edit.html', array('harjoitus' => $harjoitus, 'message' => 'pieleen meni', 'user_logged_in' => $user_logged_in));
        }
    }

    public static function ilmoittaudu() {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $ampuja = $user_logged_in->jasennumero;

        $params = $_POST;

        $harjoitus = $params['harjoitus'];





        $query = DB::connection()->prepare('INSERT INTO Kayttajanharjoitus (harjoitus, ampuja) VALUES (:harjoitus, :ampuja)');

        $query->execute(array('harjoitus' => $harjoitus, 'ampuja' => $ampuja));

        $row = $query->fetch();

        Redirect::to('/harjoitus', array( 'message' => 'Ilmoittautuminen onnoistui!', 'user_logged_in' => $user_logged_in));
    }

    public static function omatHarjoitukset() {
        self::check_logged_in();

        $user_logged_in = self::get_user_logged_in();

        $jasennumero1 = $user_logged_in->jasennumero;

        $harjoitukset = Harjoitus::omat($jasennumero1);

        View::make('/harjoitus/omatharjoitukset.html', array('harjoitukset' => $harjoitukset, 'user_logged_in' => $user_logged_in));
    }
    
    

}
