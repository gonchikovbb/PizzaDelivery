<?php

namespace Tests\Feature\Controllers\Role;

use App\Models\Role\Role;
use Tests\Feature\ControllerTestCase;

class RoleTest extends ControllerTestCase
{
    protected $route = "admin/roles";
    protected $modelClass = Role::class;

    public function generateFakeModel(): array
    {
        return ['name' => 'Moderator'];
    }
}
