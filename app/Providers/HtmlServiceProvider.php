<?php
namespace Curso\Providers;

use Collective\Html\HtmlServiceProvider as CollectiveHtmlServiceProvider;
use Curso\Components\HtmlBuilder;

class HtmlServiceProvider extends CollectiveHtmlServiceProvider
{
    /**
     * Register the HTML builder instance.
     *
     * @return void
     */
    protected function registerHtmlBuilder()
    {
        $this->app->singleton('html', function ($app) {
            return new HtmlBuilder($app['config'], $app['view'], $app['url']);
        });
    }
}