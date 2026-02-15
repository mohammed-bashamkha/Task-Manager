<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory()->count(50)->create();

        Category::all()->each(function ($category) {
            $tasks = Task::inRandomOrder()->take(rand(1, 50))->pluck('id');
            $category->tasks()->attach($tasks);
            $category->save();
        });
    }
}
