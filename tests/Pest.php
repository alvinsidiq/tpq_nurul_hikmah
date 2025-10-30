<?php

use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Pest bootstrap
|--------------------------------------------------------------------------
|
| This file configures Pest to use Laravel's TestCase for all tests.
|
*/

uses(TestCase::class)->in('Feature', 'Unit');

