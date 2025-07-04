<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Database\Factories\CategoryFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Contracts\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        // User::factory(10)->create();

        // Seeder personalizado
        $this->call(PersonalizedSeeder::class);

        // seeders
        Category::factory(10)->create();
        Post::factory(150)->create();

        // permissions
        $this->call([PermissionSeeder::class,
                    RoleSeeder::class]);

        $user = User::find(1);
        $roles = ['admin'];
        $user->syncRoles($roles);
        // roles
        //$this->call([RoleSeeder::class]);
    }
}
