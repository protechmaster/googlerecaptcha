<?php namespace Protechmaster\GoogleRecaptcha;

use Illuminate\Support\Facades\Input;

class GoogleRecaptcha {

    protected $public_key;
    protected $private_key;
    protected $verifyURL;
    public $errorMessage;
    public $position;


    public function __construct()
    {
        $this->public_key = config('GoogleRecaptcha.public_key');
        $this->private_key = config('GoogleRecaptcha.private_key');
        $this->errorMessage = config('GoogleRecaptcha.error_message');
        $this->verifyURL = config('GoogleRecaptcha.verify_api_url');
        $this->position = config('GoogleRecaptcha.bootstrap_float_class');
    }

    public function recaptchaField()
    {
        if(\Session::get('error'))
        {
            return '<div class="g-recaptcha '.$this->position.'" data-sitekey="'.$this->public_key.'"></div>'. \Session::get('error');
        }
        return '<div class="g-recaptcha '.$this->position.'" data-sitekey="'.$this->public_key.'"></div><br>';
    }

    public function validate()
    {
        $json = json_decode(file_get_contents($this->verifyURL.'?secret='.$this->private_key.'&response='.Input::get('g-recaptcha-response')),true);

        if($json["success"]==false)
        {
            throw new GoogleRecaptchaException($this->errorMessage);
        }

    }



}