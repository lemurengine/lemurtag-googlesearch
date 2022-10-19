<?php

namespace LemurEngine\GoogleSearch;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\AboutCommand;
use LemurEngine\GoogleSearch\LemurTag\GoogleSearchTag;

class TagServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GoogleSearchTag::class, function () {
            return new GoogleSearchTag();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        AboutCommand::add('Lemur Engine Google Search Tag Package', fn () => [
            'Version' => '1.0.2',
            'Desc' => 'Fixed typo in readme',
            'Release Info' => 'https://github.com/lemurengine/lemurtag-googlesearch/releases/tag/1.0.2',
        ]);
    }
}
