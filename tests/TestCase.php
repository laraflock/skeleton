<?php

/**
 * @package   :package_namespace
 * @author    :author_name <:author_email>
 * @license   MIT
 * @copyright 2015, :license_holder
 * @link      :website
 */

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Testing\TestCase as Base;
use Laraflock\Skeleton\Providers\ServiceProvider;

class TestCase extends Base
{
    /**
     * The base URL to use while doing integration testing.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the laravel application to use.
     *
     * @return mixed
     */
    public function createApplication()
    {
        // Require Laravel bootstrap application.
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';

        // Make the application and bootstrap.
        $app->make(Kernel::class)
            ->bootstrap();

        // Register this package to the application.
        $app->register(ServiceProvider::class);

        // Return the application.
        return $app;
    }

    /**
     * Set up the application.
     */
    public function setUp()
    {
        // Run parent class set up method.
        parent::setUp();

        // Refresh application.
        // - This is if you are going to publish configs, assets, and views. As your first test will need the new
        // - config in place for it to properly run the tests. Uncomment if you are publishing configs to use.
        //$this->refreshApplication();

        // Setup Configuration to work with Laravel for testing.
        // - This will setup the testing sqlite database from the phpunit.xml file.
        config([
          'database.connections.sqlite.database' => env('DB_DATABASE'),
        ]);
    }
}