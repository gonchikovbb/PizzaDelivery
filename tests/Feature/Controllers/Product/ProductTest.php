<?php

namespace Tests\Feature\Controllers\Product;

use App\Models\Category\Category;
use App\Models\Product\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\GuestResourceTestCase;
use Tests\TestCase;

class ProductTest extends GuestResourceTestCase
{
    protected $route = "products";
    protected $modelClass = Product::class;

}
