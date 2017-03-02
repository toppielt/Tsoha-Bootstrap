<?php

class RastiController extends BaseController {

    public static function index() {
          self::check_logged_in();
       
    }

    public static function showRasti($rastiid) {
          self::check_logged_in();

        $rasti = Rasti::find($rastiid);
        View::make('harjoitus/harjoitus.html', array('rasti' => $rasti));
    }

    public static function create($harjoitusid) {
        self::check_logged_in();
        
        View::make('/rasti/uusi.html', array('harjoitus' => $harjoitusid));
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;


        $ammunta = 
        
        $harjoitus = new Harjoitus(array(
            '' => $params['pvm'],
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
            View::make('harjoitus/uusi.html', array('message' => $v->errors()));
        }
        $harjoitus->save();

        Redirect::to('/kayttaja', array('message' => 'Harjoitus on tallennettu!'));
    }

    public static function destroy($harjoitusid) {
        self::check_logged_in();

        $harjoitus = new Harjoitus(array('harjoitusid' => $harjoitusid));

        $harjoitus->destroy($harjoitusid);

        Redirect::to('/harjoitus', array('message' => 'Harjoitus poistettu onnistuneesti!'));
    }

    public static function editHarjoitus($harjoitusid) {
        self::check_logged_in();
        $harjoitus = Harjoitus::find($harjoitusid);
        View::make('harjoitus/edit.html', array('harjoitus' => $harjoitus));
    }

    public static function update($harjoitusid) {
        self::check_logged_in();

       
        $harjoitus = new harjoitus(array(
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





        $harjoitus = new Harjoitus($attributes);



        if ($v->validate()) {
            $harjoitus->update();
            Redirect::to('/harjoitus/' . $harjoitus->harjoitusid, array('message' => 'Tietojen muokkaus onnistui!'));
        } else {
            print_r($v->errors());
            View::make('/harjoitus/edit.html', array('harjoitus' => $harjoitus, 'message' => 'pieleen meni'));
        }
    }

}
