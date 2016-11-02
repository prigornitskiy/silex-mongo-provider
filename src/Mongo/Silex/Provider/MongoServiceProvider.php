<?php

namespace Appi\Providers;

use MongoClient as Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MongoServiceProvider implements ServiceProviderInterface
{

    protected $client;

    public function register(Container $app)
    {

        $app['mongo'] = function () use ($app) {
            $this->client = new Client($app['mongo.options']['server'], $app['mongo.options']['options']);
            return $this->client->{$app['mongo.options']['dbname']};
        };
    }
}