<?php

namespace Tests\Feature\Controllers\Product;

use App\Models\Category\Category;
use App\Models\Product\Product;
use Tests\Feature\AdminTestCase;

class ProductTest extends AdminTestCase
{
    protected $route = "products";
    protected $modelClass = Product::class;

    public function test_get_all_products()
    {
        Product::factory()->count(5)->create();

        $this->get(route('api.products.index'))->assertStatus(200);
    }

    public function test_get_product_by_id()
    {
        $product = Product::factory()->create();

        $this->get(route('api.products.show', $product->id))->assertStatus(200);
    }

    public function test_get_products_by_category()
    {
        $category = Category::factory()->create();
        Product::factory()->count(3)->create(['category_id' => $category->id]);

        $this->get(route('api.products.getByCategory', $category->id))->assertStatus(200);
    }
}
