<?php

namespace Tests\Feature\Controllers\Address;

use App\Models\Address\Address;
use Tests\Feature\ControllerTestCase;

class AddressTest extends ControllerTestCase
{
    protected $route = "addresses";
    protected $modelClass = Address::class;
}
