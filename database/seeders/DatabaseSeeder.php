<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Product;
use App\Models\Studiekeuze;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //users
        User::factory()->create([
            'first_name' => 'Benjamin',
            'last_name' => 'Migom',
            'email' => 'migom@hotmail.be',
            'gsm_number' => '0471234567',
            'password' => '12345678',
        ]);
        User::factory()->create([
            'first_name' => 'Benjamin',
            'last_name' => 'Migom',
            'email' => 'test@hotmail.be',
            'gsm_number' => '0471234567',
            'password' => '12345678',
        ]);
        User::factory(50)->create();

        //categories
        $categories = [
            ['name' => 'Boeken'],
            ['name' => 'Gereedschap'],
            ['name' => 'Turnkledij'],
            ['name' => 'Stagekledij'],
            ['name' => 'Veiligheidskledij'],
            ['name' => 'Werkkledij'],
            ['name' => 'Kluisjes']
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }

        //attributes
        $attributes = [
            ['name' => 'Geen'],
            ['name' => 'Schoenmaten'],
            ['name' => 'Kledingmaten'],
            ['name' => 'broekmaten'],

        ];
        foreach ($attributes as $attribute) {
            Attribute::create($attribute);
        }

        //attribute_options
        $attribute_options = [];
        for ($i=36; $i<=47; $i++) {
            $schoenmaten=[ 'value' => $i, 'attribute_id' => 2];
            $attribute_options[] = $schoenmaten;
        }
        for ($i=36; $i<=54; $i+=2) {
            $broekmaten=[ 'value' => $i, 'attribute_id' => 4];
            $attribute_options[] = $broekmaten;
        }
        $attribute_options[] = [ 'value' => 'XS', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'S', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'M', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'L', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'XL', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'XXL', 'attribute_id' => 3];
        foreach ($attribute_options as $attribute_option) {
            AttributeOption::create($attribute_option);
        }

        //call all seeders
        $this->call([
            AcademicYearSeeder::class,
            CampusSeeder::class,
            GradeSeeder::class,
            StudyFieldSeeder::class,
            SubjectSeeder::class,
            StudiekeuzeSeeder::class,
            ChildSeeder::class,
            ProductSeeder::class,

        ]);

        //create roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        //create permissions
        Permission::create(['name' => 'manage backend']);

        //give permissions to roles
        $adminRole->givePermissionTo('manage backend');

        //assign roles to users
        $user = User::find(1);
        $user->assignRole('admin');
        //assign user role to everyone else
        $users = User::all();
        foreach ($users as $user) {
            $user->assignRole('user');
        }
    }
}
