<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        // Přidáme 5 autorů do databáze
        Author::create(['name' => 'J.K. Rowling']);
        Author::create(['name' => 'J.R.R. Tolkien']);
        Author::create(['name' => 'George R.R. Martin']);
        Author::create(['name' => 'Isaac Asimov']);
        Author::create(['name' => 'Arthur C. Clarke']);
    }
}
