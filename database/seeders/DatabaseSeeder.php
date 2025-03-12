<?php

namespace Database\Seeders;

use App\Models\Link;
use App\Models\LinkItem;
use App\Models\Todo;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Todo::factory(10)->create();
        Link::factory(10)->has(LinkItem::factory()->count(5))->create();
    }
}
