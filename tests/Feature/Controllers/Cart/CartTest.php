<?php

namespace Tests\Feature\Controllers\Cart;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product\Product;
use App\Models\User\User;
use Tests\Feature\ControllerTestCase;

class CartTest extends ControllerTestCase
{
    protected $route = "carts";
    protected $modelClass = Cart::class;

    public function test_add_item_to_cart()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);
        $product = Product::factory()->create(['price' => 10.00]);

        $this->actingAs($user);

        $this->post(route('api.carts.addItem', $cart->id), [
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ])->assertStatus(200);
    }

    public function test_get_current_items_in_cart()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);
        $product = Product::factory()->create(['price' => 10.00]);
        CartItem::factory()->create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $this->actingAs($user);

        $this->get(route('api.carts.getCurrentItems', $cart->id))->assertStatus(200);
    }
}
