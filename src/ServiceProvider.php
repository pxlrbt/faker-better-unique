<?php

namespace pxlrbt\FakerBetterUnique;
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected static $fakers = [];

    public function register()
    {
        $this->app->singleton(\Faker\Generator::class, function ($app, $parameters) {
            $locale = $parameters['locale'] ?? $app['config']->get('app.faker_locale', 'en_US');

            if (! isset(static::$fakers[$locale])) {
                static::$fakers[$locale] = Factory::create($locale);
            }

            static::$fakers[$locale]->unique(true);

            return static::$fakers[$locale];
        });
    }
}
