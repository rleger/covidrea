<?php

namespace Tests;

use Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;

    /**
     * Set up the test case.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();
    }
}
