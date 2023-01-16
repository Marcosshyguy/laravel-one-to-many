<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types_of_project = ['FrontEnd', 'BackEnd', 'FullStack'];
        foreach ($types_of_project as $type) {
            $new_type = new Type();
            $new_type->project_type = $type;
            $new_type->slug = Str::slug($type);
            $new_type->save();
        }
    }
}
