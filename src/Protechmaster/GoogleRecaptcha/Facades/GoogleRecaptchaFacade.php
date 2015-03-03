<?php
/**
 * Created by PhpStorm.
 * User: rafia
 * Date: 3/2/2015
 * Time: 9:46 PM
 */

namespace Protechmaster\GoogleRecaptcha\Facades;


use Illuminate\Support\Facades\Facade;

class GoogleRecaptchaFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'GoogleRecaptcha';
    }

}