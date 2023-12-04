<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Faker\Generator as Faker;

class FakerProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $new_project = new Project();
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->name = 'Progetto '.$faker->words(2, true);
            $new_project->slug = Project::generateSlug($new_project->name);
            $new_project->start_date = $faker->dateTime();
            $new_project->delivery_date = $faker->dateTimeInInterval($new_project->start_date, '+3 month');
            $new_project->status = $faker->randomElement(['done','in process','failed' ]);
            $new_project->description = $faker->paragraph();
            $new_project->steps = '1. Creazione '.$faker->word().' - '.'2. Modifica '.$faker->word().' - '.'3. Gestione '.$faker->word();
            $new_project->save();
        }

    }
}
