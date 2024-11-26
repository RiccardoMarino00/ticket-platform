<?php

namespace Database\Seeders;

use App\Models\Operator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $operators = [
            ['name' => 'Spongebob', 'email' => 'spongebob@gmail.com', 'is_available' => true],
            ['name' => 'Patrick', 'email' => 'patrick@gmail.com', 'is_available' => true],
            ['name' => 'Squiddy', 'email' => 'squiddy@gmail.com', 'is_available' => true]
        ];

        foreach ($operators as $operator) {
            Operator::create($operator);
        }
    }
}
