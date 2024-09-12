<?php

namespace Tests\Feature\Controllers\User;

use App\Models\User\User;
use Tests\Feature\AdminTestCase;

class UserTest extends AdminTestCase
{
    protected $route = "users";
    protected $modelClass = User::class;
}
