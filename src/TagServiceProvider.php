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
            'Version' => '1.0.0',
            'Desc' => 'This package creates a custom googlesearch tag so that you can write AIML and return a link to google results',
            'Release Info' => 'https://github.com/lemurengine/aiml-google-search-tag/releases/tag/v1.0.0',
        ]);
    }
}
