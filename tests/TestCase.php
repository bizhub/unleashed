<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\UnleashedServiceProvider;
use \Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            UnleashedServiceProvider::class,
        ];
    }

    protected function getSample($name)
    {
        $json = file_get_contents(__DIR__ . '/samples/' . $name . '.json');

        return json_decode($json, true);
    }
}