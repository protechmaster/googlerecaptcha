<?php namespace Protechmaster\GoogleRecaptcha;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class GoogleRecaptchaServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['GoogleRecaptcha'] = $this->app->share(function($app)
        {
            return new GoogleRecaptcha();
        });

        //register our facade
        $this->app->booting(function()
        {
            AliasLoader::getInstance()->alias('GoogleRecaptcha','Protechmaster\GoogleRecaptcha\Facades\GoogleRecaptchaFacade');
        });

        $this->publishes([
            __DIR__.'/../../config/GoogleRecaptchaConfig.php' => config_path('GoogleRecaptcha.php'),
        ]);
	}



    /**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}
