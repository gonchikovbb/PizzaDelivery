<?php

namespace Tests\Feature\Controllers\Address;

use App\Models\Address\Address;
use Tests\Feature\CRUDTestCase;

class AddressTest extends CRUDTestCase
{
    protected $route = "addresses";
    protected $modelClass = Address::class;
}
