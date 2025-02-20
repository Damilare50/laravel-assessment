<?php

namespace Tests\Unit\Models;

use App\Models\Account;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;


    public function testCategoryBelongsToAccount()
    {
        $account = Account::factory()->create();
        $category = Category::factory()->create(['account_id' => $account->id]);

        $this->assertEquals($account->id, $category->account->id);
    }
}
