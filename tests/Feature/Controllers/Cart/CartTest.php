<?php

namespace Tests\Feature\Controllers\Cart;

use App\Models\Cart\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\GuestResourceTestCase;
use Tests\TestCase;

class CartTest extends GuestResourceTestCase
{
    protected $route = "carts";
    protected $modelClass = Cart::class;
}
