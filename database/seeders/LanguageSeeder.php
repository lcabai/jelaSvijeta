<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        Language::create(['locale' => 'hr']);
        Language::create(['locale' => 'en']);
        Language::create(['locale' => 'fr']);
    }
}
