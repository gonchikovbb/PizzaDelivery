<?php

namespace Tests\Feature\Controllers\Category;

use App\Models\Category\Category;
use Tests\Feature\AdminTestCase;

class CategoryTest extends AdminTestCase
{
    protected $route = "categories";
    protected $modelClass = Category::class;
}
