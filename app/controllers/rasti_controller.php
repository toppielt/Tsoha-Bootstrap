<?php

class RastiController extends BaseController {

    public static function index() {
        self::check_logged_in();
    }

    public static function showRasti($rastiid) {
        self::check_logged_in();

        $rasti = Rasti::find($rastiid);
        View::make('harjoitus/showrasti.html', array('rasti' => $rasti));
    }

    public static function create($harjoitusid) {
        self::check_logged_in();

        $harjoitus = Harjoitus::find($harjoitusid);

        View::make('/rasti/uusi.html', array('harjoitus' => $harjoitus));
    }

    public static function store() {
        self::check_logged_in();

        $params = $_POST;

        $rasti = new Rasti(array(
            'harjoitus' => $params['harjoitus'],
            'rastikuvaus' => $params['rastikuvaus']
        ));
        // Luodaan validoija
        $v = new Valitron\Validator(array(
            'harjoitus' => $params['harjoitus'],
            'rastikuvaus' => $params['rastikuvaus']
        ));

        // Tietojen validointi
        //  $v->rule('required', 'harjoitusid');


        if ($v->validate()) {
            echo 'Hyvin meni';
        } else {
            print_r($v->errors());
            View::make('/rasti/uusi.html', array('harjoitus' => $harjoitus, 'message' => $v->errors()));
        }
        $rasti->save();

        $rastiid = $rasti->rastiid;

        $rasti = Rasti::find($rastiid);

        $harjoitus = Harjoitus::find($params['harjoitus']);

        Redirect::to('/harjoitus/:rasti/ammunta', array('harjoitus' => $harjoitus, 'rasti' => $rasti, 'message' => 'Rastikuvaus on tallennettu!'));
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

    public static function lisaaAmmunta($rasti) {
        self::check_logged_in();

        View::make('/rasti/ammunta.html', array('rasti' => $rasti));
    }

    public static function storeAmmunta() {
        self::check_logged_in();

        $params = $_POST;


        $ammunta = new Ammunta(array(
            'asetyyppi' => $params['asetyyppi'],
            'laukausmaara' => $params['laukausmaara'],
            'rasti' => $params['rasti']
        ));
        // Luodaan validoija
        $v = new Valitron\Validator(array(
            'asetyyppi' => $params['asetyyppi'],
            'laukausmaara' => $params['laukausmaara'],
            'rasti' => $params['rasti']
        ));

        // Tietojen validointi
        //  $v->rule('required', 'harjoitusid');


        if ($v->validate()) {
            echo 'Hyvin meni';
        } else {
            print_r($v->errors());
            View::make('/rasti/uusi.html', array('harjoitus' => $harjoitus, 'message' => $v->errors()));
        }
        $ammunta->save();


        $rasti = Rasti::find($params['rasti']);

        $harjoitus = $rasti->harjoitus;



        $osallistujat = Kayttaja::osallistujat($harjoitus);

        Redirect::to('/rasti/:rasti/tulos', array('osallistujat' => $osallistujat, 'rasti' => $rasti, 'message' => 'Rastikuvaus on tallennettu!'));
    }

    public static function tulos($rasti) {
        self::check_logged_in();



        View::make('/rasti/tulos.html', array('rasti' => $rasti));
    }

    public static function storeTulos() {
        self::check_logged_in();

        $params = $_POST;

        $rasti = $_POST['rasti'];


        for ($i = 1; $params['ampuja[i]'] = null; $i++) {

            $tulos = new Tulos(array(
                'ampuja' => $params['ampuja' . $i],
                'rasti' => $params['rasti'],
                'aika' => $params['aika' . $i],
                'pisteet' => $params['pisteet' . $i]
            ));
            // Luodaan validoija
          //  $v = new Valitron\Validator(array(
           //     'asetyyppi' => $params['asetyyppi'],
            //    'laukausmaara' => $params['laukausmaara'],
            //    'rasti' => $params['rasti']
        //    ));

            // Tietojen validointi
            //  $v->rule('required', 'harjoitusid');

            if ($v->validate()) {
                echo 'Hyvin meni';
            } else {
                print_r($v->errors());
                View::make('/rasti/tulos.html', array('rasti' => $rasti, 'message' => $v->errors()));
            }
            
             $tulos->save();
        }
        
        $rasti2 = Rasti::find($rasti);

        $harjoitus = $rasti2->harjoitus;

       
        if (isset($_POST['palaa'])) {
            Redirect::to('/', array('message' => 'Rastit on tallennettu'));
        } else {
            
            self::create($harjoitus);
        }

    }

}
