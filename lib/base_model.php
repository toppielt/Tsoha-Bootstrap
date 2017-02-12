<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        }

        return $errors;
    }

    public function validate_string_length($string, $length) {
        $errors = array();

        if ($string == '' || $string == null) {
            $errors[] = 'Tyhjä merkkijono!';
        }

        if (strlen($string) < 3) {
            $errors[] = 'Merkkijonon tulee olla vähintään kolme merkkiä!';
        }

        if (strlen($string) > $length) {
            $errors[] = 'Merkkijono on liian pitkä!';
        }
    }

    public function validate_jasennumero($jasennumero) {


        $v = new Valitron\Validator(array(
            'jasennumero' => 'jasennumero'));

     


        $v->rule('integer', 'jasennumero');
        $v->rule('lenghtMin', 'jasennumero', 5);
        $v->rule('lengthMax', 'jasennumero', 10);

        return $v->errors();
    }

    public function validate_nimi($nimi) {
        $v = new Valitron\Validator(array(
            'nimi' => 'nimi'));

        $v->rule('lengthMin', 'nimi', 5);
        $v->rule('lengthMax', 'nimi', 30);

        return $v->errors();
    }

    public function validate_email($email) {
        $v = new Valitron\Validator(array(
            'email' => 'email'));

        $v->rule('email', 'email');

        return $v->errors();
    }

    public function validate_salasana($salasana) {
        $v = new Valitron\Validator(array(
            'salasana' => 'salasana'));

        $v->rule('lengthMin', 'salasana', 8);
        $v->rule('lengthMax', 'salasana', 20);

        return $v->errors();
    }
    
    

}
