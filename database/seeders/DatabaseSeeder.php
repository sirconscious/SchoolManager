<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Courses;
use App\Models\Groupe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(20)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Mehdi Elbakouri',
        //     'email' => 'mehdi@mehdi.com',
        //     'password'=>'123456789',
        //     "phone"=>'0648772911',
        //     'role'=>'admin'
        // ]); 
        // Groupe::factory()->createMany([
        //     ['group_name' => 'DEV201'],
        //     ['group_name' => 'DEV202'] ,
        //     ['group_name' => 'DEV203'] ,
        //     ['group_name' => 'DEV204'] ,
        // ]);

        Courses::factory()->createMany([
            ['name' => 'PHP' , 
            'description' => 'Server-side scripting language'
            ],
            ['name' => 'Laravel' , 
            'description' => 'A PHP framework for web artisans'
            ],
            ['name' => 'React' , 
            'description' => 'A JavaScript library for building user interfaces'
            ],
            ['name' => 'Js' , 
            'description' => 'A programming language that conforms to the ECMAScript specification'
            ],

        ]) ;
        
    }
}
