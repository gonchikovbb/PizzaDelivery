<?php

namespace Tests\Feature\Controllers\Role;

use App\Models\Role\Role;
use Tests\Feature\AdminTestCase;

class RoleTest extends AdminTestCase
{
    protected $route = "roles";
    protected $modelClass = Role::class;

    public function generateFakeModel(): array
    {
        return ['name' => 'Moderator'];
    }
}
