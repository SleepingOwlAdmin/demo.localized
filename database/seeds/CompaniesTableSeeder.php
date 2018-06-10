<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->deleteDirectory('company');

        factory(Company\Type::class, 5)->create();
        $types = Company\Type::all();

        factory(Company::class, 20)->create([
            'type_id' => function () use ($types) {
                return array_random($types->all())->id;
            }
        ]);

        factory(Company::class)->create([
            'type_id' => function () use ($types) {
                return array_random($types->all())->id;
            },
            'verified' => true,
            'login' => 'admin',
            'email' => 'admin@company.com',
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        ]);
    }
}
