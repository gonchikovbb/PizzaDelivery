<?php

namespace Tests\Feature\Controllers\Order;

use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Order\Order;
use App\Models\Role\Role;
use App\Models\User\User;
use Tests\Feature\ControllerTestCase;

class OrderTest extends ControllerTestCase
{
    protected $route = "admin/orders";
    protected $modelClass = Order::class;

    public function test_index ()
    {
        $role = Role::factory()->create(['name' => 'Admin']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user,'api');

        Order::factory()->count(2)->create();

        $this->get("/api/orders")->assertStatus(200);
    }

    public function test_store ()
    {
        $role = Role::factory()->create(['name' => 'User']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user,'api');

        $cart = Cart::factory()->create(['user_id' => $user->id]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
        ]);

        $order = Order::factory()->create([
            'user_id' => $user->id,
        ])->toArray();

        $this->post("/api/orders", $order)->assertStatus(201);
    }

    public function test_show ()
    {
        $role = Role::factory()->create(['name' => 'Admin']);
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($user,'api');

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
        $role = Role::factory()->create(['name' => 'Admin']);
        $admin = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($admin,'api');

        $cart = Cart::factory()->create(['user_id' => $admin->id]);

        CartItem::factory()->create([
            'cart_id' => $cart->id,
        ]);

        $order = Order::factory()->create([
            'user_id' => $admin->id,
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
        $roleAdmin = Role::factory()->create(['name' => 'Admin']);
        $admin = User::factory()->create(['role_id' => $roleAdmin->id]);

        $order = Order::factory()->create();

        $this->actingAs($admin,'api');

        $this->put("/api/admin/orders/{$order->id}", [
            'name' => 'Пиццы',
        ])->assertStatus(200);
    }
}
