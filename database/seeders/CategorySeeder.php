<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Problemi hardware'],
            ['name' => 'Problemi software'],
            ['name' => 'Connessioni di rete'],
            ['name' => 'Credenziali dimenticate']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
