<?php

namespace App\Providers;

use App\Validators\ImageUrlValidator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Validator::extend('urlToImage', function($attribute, $value, $parameters, $validator) {
            $urlToImageValidator = new ImageUrlValidator();
            return $urlToImageValidator->isValid($attribute, $value, $parameters, $validator);
        });
    }

    public function register()
    {

    }

}