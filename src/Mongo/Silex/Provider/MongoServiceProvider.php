<?php

namespace Mongo\Silex\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MongoServiceProvider implements ServiceProviderInterface
{

    protected $app;

    protected $client;

    /**
     * MongoServiceProvider constructor.
     */
    public function __construct($app)
    {
        $this->app = $app;
    }


    public function register(Container $app)
    {

        $app['mongo'] = function () use ($app) {
            $conf = $this->app['config']['dbs']['nosql']['mongo.connections']['default'];
            $mongoClass = (version_compare(phpversion('mongo'), '1.3.0', '<')) ? '\MongoDB\Client' : '\MongoClient';
            $this->client = new $mongoClass($conf['server'], $conf['options']);
            return $this->client;
        };
    }
}