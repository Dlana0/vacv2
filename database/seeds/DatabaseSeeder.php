<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'id' => 8,
            'username' => 'programm',
            'email' => 'programm@test.lv',
            'name' => 'sia programm',
            'password' => '$2y$10$IIBKkxQZZZuNQsdgSxch6uh40QZp.RBOS3NaFqf7N3xJWv/6u4hnK',
            'type' => 1,
        ]);


        DB::table('users')->insert([
            'id' => 4,
            'username' => 'Di',
            'email' => 'diana@in.lv',
            'name' => 'Di',
            'password' => '$2y$10$QWO656B78P1pM1gqKSBQbuBa.cU.LKeNUafx98HPSGUZh67fjFzEe',
            'type' => 1,
        ]);


        DB::table('users')->insert([
            'id' => 5,
            'username' => 'kandidats',
            'email' => 'kan@test.lv',
            'name' => 'kandidats',
            'password' => '$2y$10$P8S6LZS9BxJtYozqjkvRreBGPb8/dKjl3sEDJgOJHQMUM25jb6sy6',
            'type' => 2,
        ]);

        DB::table('users')->insert([
            'id' => 6,
            'username' => 'admin',
            'email' => 'admin@cv.dev',
            'name' => 'Administr�?tors',
            'password' => bcrypt('testtest'),
            'type' => 3,
        ]);

        DB::table('vacancies')->insert([
            'id' => 9,
            'title' => 'Aicinam darb�? programmēt�?ju',
            'description' => 'Uzņēmums pied�?v�?:
- Interesantu darbu stabil�?, augo�?�? uzņēmum�?;
- Dinamisku darbu un profesion�?las izaugsmes iespējas;
- Konkurētspējīgu un motivējo�?u atalgojumu;
- Darbs draudzīg�?, rado�?�?, profesion�?l�? un pozitīvi noskaņot�? kolektīv�?;',
            'requirements' => '- PHP;
- HTML;
- CSS;
- MySQL;
- Zin�?�?anas jQuery un Javascript tiks uzskatītas par priek�?rocību. 
- Interese un spēja apgūt jaunas web tehnoloģijas;
- Saskarsmes prasmes un sadarbības prasmes, spēja str�?d�?t komand�?;
- Spēja patst�?vīgi pl�?not, sistematizēt un organizēt savu darbu;
- Atbildīga pieeja, precizit�?te, enerģiskums un inovatīva dom�?�?ana;',
            'knowledge' => '- Zin�?�?anas jQuery un Javascript tiks uzskatītas par priek�?rocību. ',
            'obligations' => 'Web programmēt�?js',
            'duration' => '2016-05-31 00:00:00',
            'user_id' => 8,
        ]);

        DB::table('vacancies')->insert([
            'id' => 5,
            'title' => 'Testt',
            'description' => 'Tests',
            'requirements' => 'Tests',
            'knowledge' => 'Tests',
            'obligations' => 'Tests',
            'duration' => '2016-05-31 00:00:00',
            'user_id' => 4,
        ]);


    }
}
