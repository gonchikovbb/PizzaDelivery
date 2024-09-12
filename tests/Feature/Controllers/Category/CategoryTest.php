<?php

namespace Tests\Feature\Controllers\Category;

use App\Models\Category\Category;
use Tests\Feature\ControllerTestCase;

class CategoryTest extends ControllerTestCase
{
    protected $route = "admin/categories";
    protected $modelClass = Category::class;
}
