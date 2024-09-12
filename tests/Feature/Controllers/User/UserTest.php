<?php

namespace Tests\Feature\Controllers\User;

use App\Models\User\User;
use Tests\Feature\ControllerTestCase;

class UserTest extends ControllerTestCase
{
    protected $route = "admin/users";
    protected $modelClass = User::class;
}
