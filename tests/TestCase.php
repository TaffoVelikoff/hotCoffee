<?php

namespace TaffoVelikoff\HotCoffee\Tests;

use TaffoVelikoff\HotCoffee\HotCoffeeServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends \Orchestra\Testbench\TestCase
{

    use RefreshDatabase;

    protected function setUp(): void {

        parent::setUp();

        $this->withFactories(__DIR__.'/../database/factories');

    }

	/**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app) {

    	return [
    		HotCoffeeServiceProvider::class,
    	];
    }

    protected function getEnvironmentSetUp($app) {

        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);

        $app['config']->set('hotcoffee.languages',[
            'en'    => 'English',
            'bg'    => 'Bulgarian',
        ]);

    }
}