<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayTypeProject = [1,2,3];

        for ($i=0; $i < 5; $i++) {
          DB::table('projects')->insert([
              'thai_name'     => str_random(10),
              'eng_name'      => str_random(10),
              'typeProjectId' => array_random($arrayTypeProject),
              'abstack'       => str_random(10),
              'keywords'      => str_random(10),
              'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
              'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
          ]);
       }
    }
}
