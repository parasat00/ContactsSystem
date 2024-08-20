<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        Contact::create([
            'user_id' => $user->id,
            'name' => 'Вася',
            'phone' => '7777777777',
        ]);

        Contact::create([
            'user_id' => $user->id,
            'name' => 'Саня',
            'phone' => '7777777778',
        ]);
    }
}
