<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{

    public function run()
    {
        Post::factory()->count(20)->create();
    }
}
