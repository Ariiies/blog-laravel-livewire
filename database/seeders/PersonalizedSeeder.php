<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Address;
use App\Models\Category;

class PersonalizedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::factory()->create([
            'name' => 'Aries Allen',
            'email' => 'aries@allen.com',
            'password' => bcrypt('ari'),
        ]);
        User::factory()->create([
            'name' => 'Paula Cervon',
            'email' => 'paula@cervon.com',
            'password' => bcrypt('pau'),
        ]);
        User::factory()->create([
            'name' => 'Robin Kael',
            'email' => 'robin@kael.com',
            'password' => bcrypt('rob'),
        ]);
        User::factory()->create([
            'name' => 'luisa meza',
            'email' => 'luisa@meza.com',
            'password' => bcrypt('lu'),
        ]);
        User::factory()->create([
            'name' => 'Aeris Steinberg',
            'email' => 'aeris@steinbergcom',
            'password' => bcrypt('stein'),
        ]);
        Category::factory()->create([
            'name' => 'action'
        ]);
        Category::factory()->create([
            'name' => 'filosofia'
        ]);
        Category::factory()->create([
            'name' => 'tecnologia'
        ]);
        Category::factory()->create([
            'name' => 'programacion'
        ]);
        Category::factory()->create([
            'name' => 'especulativo'
        ]);
    }
}
