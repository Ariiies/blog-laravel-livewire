<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;


class PersonalizedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users = [
            [
            'name' => 'Aries Allen',
            'email' => 'aries@allen.com',
            'password' => bcrypt('ariesallen'),
            ],
            [
            'name' => 'Paula Cervon',
            'email' => 'paula@cervon.com',
            'password' => bcrypt('paulacervon'),
            ],
            [
            'name' => 'Robin Kael',
            'email' => 'robin@kael.com',
            'password' => bcrypt('rob'),
            ],
            [
            'name' => 'luis meza',
            'email' => 'luis@meza.com',
            'password' => bcrypt('luismeza'),
            ],
             [
            'name' => 'Dora Castillo',
            'email' => 'dora@castillo.com',
            'password' => bcrypt('doracastillo'),
             ],
            [
            'name' => 'Sofia Steinberg',
            'email' => 'sofia@steinberg.com',
            'password' => bcrypt('steinberg'),
            ],
            [
            'name' => 'test user',
            'email' => 'test@user.com',
            'password' => bcrypt('testuser'),
            ],
            
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }
        
        $categories = [
            'action',
            'filosofia',
            'tecnologia',
            'programacion',
            'especulativo',
        ];

        foreach ($categories as $category) {
            Category::factory()->create(['name' => $category]);
        }

        $tags = [
            'aventura',
            'suspenso',
            'misterio',
            'fantasia',
            'ficcion',
            'realidad',
            'ciencia',
            'ficcion',
            'historia',
            'romance',
            'drama',
            'comedia',
            'terror',
            'accion',
            'technologia',
            'programacion',
        ];

        foreach ($tags as $tag) {
            Tag::factory()->create(['name' => $tag]);
        }

        

    }
}
