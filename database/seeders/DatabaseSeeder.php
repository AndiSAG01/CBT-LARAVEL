<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $file = UploadedFile::fake()->image('thumbnail.jpg');
        $fileName = rand(0, 9999999) . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('users', $fileName, 'public');
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345678'),
                'isAdmin' => 1,
                'NIK' => '12345678',
                'image' => $filePath,
                'Position' => 'Admin',
            ],
        ]);
    }
}
