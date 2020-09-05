<?php

namespace Tests\Routes;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\AbstractTestCase;

abstract class AbstractRouteTestCase extends AbstractTestCase
{
    use DatabaseMigrations;
}
