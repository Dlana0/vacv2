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
            'name' => 'AdministrÄ?tors',
            'password' => bcrypt('testtest'),
            'type' => 3,
        ]);

        DB::table('vacancies')->insert([
            'id' => 9,
            'title' => 'Aicinam darbÄ? programmÄ“tÄ?ju',
            'description' => 'UzÅ†Ä“mums piedÄ?vÄ?:
- Interesantu darbu stabilÄ?, augoÅ?Ä? uzÅ†Ä“mumÄ?;
- Dinamisku darbu un profesionÄ?las izaugsmes iespÄ“jas;
- KonkurÄ“tspÄ“jÄ«gu un motivÄ“joÅ?u atalgojumu;
- Darbs draudzÄ«gÄ?, radoÅ?Ä?, profesionÄ?lÄ? un pozitÄ«vi noskaÅ†otÄ? kolektÄ«vÄ?;',
            'requirements' => '- PHP;
- HTML;
- CSS;
- MySQL;
- ZinÄ?Å?anas jQuery un Javascript tiks uzskatÄ«tas par priekÅ?rocÄ«bu. 
- Interese un spÄ“ja apgÅ«t jaunas web tehnoloÄ£ijas;
- Saskarsmes prasmes un sadarbÄ«bas prasmes, spÄ“ja strÄ?dÄ?t komandÄ?;
- SpÄ“ja patstÄ?vÄ«gi plÄ?not, sistematizÄ“t un organizÄ“t savu darbu;
- AtbildÄ«ga pieeja, precizitÄ?te, enerÄ£iskums un inovatÄ«va domÄ?Å?ana;',
            'knowledge' => '- ZinÄ?Å?anas jQuery un Javascript tiks uzskatÄ«tas par priekÅ?rocÄ«bu. ',
            'obligations' => 'Web programmÄ“tÄ?js',
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
