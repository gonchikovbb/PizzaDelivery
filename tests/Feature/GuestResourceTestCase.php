<?php

namespace Tests\Feature;

use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class GuestResourceTestCase extends TestCase
{
    use RefreshDatabase;

    protected $route = "";
    protected $modelClass = "";

    public function setUp(): void
    {
        parent::setUp();
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
    public function test_index_crud_route(): void
    {
        $this->get("/api/$this->route")->assertOk();
    }

    /**
     * Проверка Store маршрута
     *
     * @return void
     */
    public function test_store_crud_route(): void
    {
        $newModel = $this->generateFakeModel();

        $this->post("/api/$this->route", $newModel)->assertCreated();
    }

    /**
     * Проверка Show маршрута
     *
     * @return void
     */
    public function test_show_crud_route(): void
    {
        $modelId = $this->modelClass::query()->first()->id;

        $this->get("/api/$this->route/$modelId")->assertOk();
    }

    /**
     * Проверка Update маршрута
     *
     * @return void
     */
    public function test_update_crud_route(): void
    {
        $modelId = $this->modelClass::query()->first()->id;

        $newModel = $this->generateFakeModel();

        $this->put("/api/$this->route/$modelId", $newModel)->assertOk();
    }

    /**
     * Проверка Destroy маршрута
     *
     * @return void
     */
    public function test_destroy_crud_route(): void
    {
        $modelId = $this->modelClass::query()->first()->id;

        $this->delete("/api/$this->route/$modelId")->assertOk();
    }
}
