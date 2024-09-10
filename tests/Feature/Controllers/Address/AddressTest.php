<?php

namespace Tests\Feature\Controllers\Address;

use App\Models\Address\Address;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\GuestResourceTestCase;
use Tests\TestCase;

class AddressTest extends GuestResourceTestCase
{
    protected $route = "address";
    protected $modelClass = Address::class;
}
