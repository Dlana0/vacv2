<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
            'name' => 'Administrātors',
            'password' => bcrypt('testtest'),
            'type' => 3,
        ]);

        DB::table('vacancies')->insert([
            'id' => 9,
            'title' => 'Aicinam darbā programmētāju',
            'description' => 'Uzņēmums piedāvā:
- Interesantu darbu stabilā, augošā uzņēmumā;
- Dinamisku darbu un profesionālas izaugsmes iespējas;
- Konkurētspējīgu un motivējošu atalgojumu;
- Darbs draudzīgā, radošā, profesionālā un pozitīvi noskaņotā kolektīvā;',
            'requirements' => '- PHP;
- HTML;
- CSS;
- MySQL;
- Zināšanas jQuery un Javascript tiks uzskatītas par priekšrocību. 
- Interese un spēja apgūt jaunas web tehnoloģijas;
- Saskarsmes prasmes un sadarbības prasmes, spēja strādāt komandā;
- Spēja patstāvīgi plānot, sistematizēt un organizēt savu darbu;
- Atbildīga pieeja, precizitāte, enerģiskums un inovatīva domāšana;',
            'knowledge' => '- Zināšanas jQuery un Javascript tiks uzskatītas par priekšrocību. ',
            'obligations' => 'Web programmētājs',
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
