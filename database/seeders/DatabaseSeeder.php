<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $category=Category::create(['name'=>'Home', 'is_featured'=>1,'is_featured'=>1, 'image'=>'Category_1653259519.png' ]);
        // $product=Product::create(['name'=>'wedding dress', 'is_featured'=>1,'price'=>500, 'discount'=>50,'image'=>'product_1653.png', 'description'=>'A weddingpanjabi. It is usually long and marron.']);
        // $me=User::create([
        // 'first_name'=>'Lina','last_name'=>'Haque','email'=>'lina@gmail.com', 'password'=>bcrypt('lina@gmail.com1')]);

        // $SuperAdmin=Role::create(['name'=>'SuperAdmin']);
        // $admin=Role::create(['name'=>'admin']);
        // $customer=Role::create(['name'=>'customer']);

    }
}
