<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // إضافة 10 مراجعات باستخدام الـ Factory
        Review::factory()->count(10)->create();
    }
}
