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
            'password' => bcrypt('ari'),
            ],
            [
            'name' => 'Paula Cervon',
            'email' => 'paula@cervon.com',
            'password' => bcrypt('pau'),
            ],
            [
            'name' => 'Robin Kael',
            'email' => 'robin@kael.com',
            'password' => bcrypt('rob'),
            ],
            [
            'name' => 'luisa meza',
            'email' => 'luisa@meza.com',
            'password' => bcrypt('lu'),
            ],
            [
            'name' => 'Aeris Steinberg',
            'email' => 'aeris@steinbergcom',
            'password' => bcrypt('stein'),
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
