<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('it_IT');
        $project = new Project();
        $project->title = $faker->firstName();
        $project->description = $faker->paragraph();
        $project->production_date = $faker->date();
        $project->languages_used = $faker->firstName();
        $project->slug = Str::slug($project->title, '-');
        $project->save();
    }
}
