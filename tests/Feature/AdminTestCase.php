<?php

namespace Tests\Feature;

use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTestCase extends TestCase
{
    use RefreshDatabase;

    protected $route = "";
    protected $modelClass = "";

    public function setUp(): void
    {
        parent::setUp();

        $role = Role::factory()->create(['name' => 'Admin']);
        $admin = User::factory()->create(['role_id' => $role->id]);

        $this->actingAs($admin,'api');
    }

    /**
     * Создает фейковый список данных для тестирования
     *
     * @return array
     */
    public function generateFakeModel(): array
    {
        return $this->modelClass::factory()->make()->toArray();
    }

    /**
     * Проверка Index маршрута
     *
     * @return void
     */
    public function test_admin_index()
    {
        $this->get("/api/admin/$this->route")->assertStatus(200);
    }

    /**
     * Проверка Store маршрута
     *
     * @return void
     */
    public function test_admin_store ()
    {
        $model = $this->generateFakeModel();

        $this->post("/api/admin/$this->route", $model)->assertStatus(201);
    }

    /**
     * Проверка Show маршрута
     *
     * @return void
     */
    public function test_admin_show()
    {
        $modelId = $this->modelClass::factory()->create()->id;

        $this->get("/api/admin/$this->route/{$modelId}")->assertStatus(200);
    }

    /**
     * Проверка Update маршрута
     *
     * @return void
     */
    public function test_admin_update()
    {
        $modelId = $this->modelClass::factory()->create()->id;

        $model = $this->generateFakeModel();

        $this->put("/api/admin/$this->route/{$modelId}", $model)->assertStatus(200);
    }

    /**
     * Проверка Destroy маршрута
     *
     * @return void
     */
    public function test_admin_destroy()
    {
        $modelId = $this->modelClass::factory()->create()->id;

        $this->delete("/api/admin/$this->route/{$modelId}")->assertStatus(204);
    }
}
