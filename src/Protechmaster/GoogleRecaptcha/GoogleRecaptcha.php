<?php namespace Protechmaster\GoogleRecaptcha;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;

class GoogleRecaptcha {

    protected $public_key;
    protected $private_key;
    protected $verifyURL;
    public $errorMessage;


    public function __construct()
    {
        $this->public_key = config('GoogleRecaptcha.public_key');
        $this->private_key = config('GoogleRecaptcha.private_key');
        $this->errorMessage = config('GoogleRecaptcha.error_message');
        $this->verifyURL = config('GoogleRecaptcha.verify_api_url');
    }

    public function recaptchaField($error = '')
    {
        if(!empty($error))
        {
            return '<div class="g-recaptcha" data-sitekey="'.$this->public_key.'"></div>'. \Session::get($error);
        }
        return '<div class="g-recaptcha" data-sitekey="'.$this->public_key.'"></div><br>';
    }

    public function validate()
    {
        $json = json_decode(file_get_contents($this->verifyURL.'?secret='.$this->private_key.'&response='.Input::get('g-recaptcha-response')),true);

        if($json["success"]==false)
        {
            throw new RecaptchaException($this->errorMessage);
        }

    }



}