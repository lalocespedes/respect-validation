<?php

use Respect\Validation\Validator as v;

use lalocespedes\Validators\Item as validator;

require '../app/bootstrap.php';

function validar()
{

  $number = 123;

  $validate = v::numeric()->validate($number); // true

  dump($validate);

  $number = "texto";

  $validate = v::numeric()->validate($number); // true

  dump($validate);

}

validar();

function validate()
{
    $validateValues = [
        'empleado_id' => "text"
    ];

    $validator = new validator;

    $isValid = $validator->assert($validateValues);

    if (!$isValid) {

      dump($validator->errors());

    }

    dump($isValid);
}

validate();
