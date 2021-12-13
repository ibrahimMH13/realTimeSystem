<?php

namespace Database\Seeders;

use App\Models\Token;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Token::create([
            'app_id' => 1,
            'key'    => sha1(Str::uuid()),
            'secret' => sha1(Str::uuid()),
        ]);
    }
}
