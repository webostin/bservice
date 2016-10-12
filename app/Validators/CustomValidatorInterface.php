<?php

namespace App\Validators;

interface CustomValidatorInterface{
    public function isValid($attribute, $value, $parameters, $validator);
}