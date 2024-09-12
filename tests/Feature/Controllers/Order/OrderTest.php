<?php

namespace Tests\Feature\Controllers\Order;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Order\Order;
use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\AdminTestCase;

class OrderTest extends AdminTestCase
{
    protected $route = "orders";
    protected $modelClass = Order::class;

    public function setUp(): void
    {
        parent::setUp();

        $roleAdmin = Role::factory()->create(['name' => 'Admin']);
        $admin = User::factory()->create(['role_id' => $roleAdmin->id]);

        $this->actingAs($admin,'api');
    }

    public function test_index ()
    {
        Order::factory()->count(2)->create();

        $this->get("/api/orders")->assertStatus(200);
    }

    public function test_store ()
    {
        $cart = Cart::factory()->create(['user_id' => Auth::user()->getAuthIdentifier()]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
        ]);

        $order = Order::factory()->create([
            'user_id' => Auth::user()->getAuthIdentifier(),
        ])->toArray();

        $this->post("/api/orders", $order)->assertStatus(201);
    }

    public function test_show ()
    {
        $order = Order::factory()->create();

        $this->get("/api/orders/{$order->id}")->assertStatus(200);
    }

    /**
     * Администраторские маршруты
     *
     * Проверка Store маршрута
     *
     * @return void
     */
    public function test_admin_store ()
    {
        $cart = Cart::factory()->create(['user_id' => Auth::user()->getAuthIdentifier()]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
        ]);

        $order = Order::factory()->create([
            'user_id' => Auth::user()->getAuthIdentifier(),
        ])->toArray();

        $this->post("/api/admin/orders", $order)->assertStatus(201);
    }

    /**
     * Проверка Update маршрута
     *
     * @return void
     */
    public function test_admin_update()
    {
        $order = Order::factory()->create();

        $this->put("/api/admin/orders/{$order->id}", [
            'name' => 'Пиццы',
        ])->assertStatus(200);
    }
}
