<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase;

abstract class AbstractTestCase extends TestCase
{
    use CreatesApplication;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';
}
