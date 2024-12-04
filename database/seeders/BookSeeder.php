<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    public function run()
    {
        $authors = Author::all();

        Book::create([
            'title' => 'Harry Potter a Kámen mudrců',
            'author_id' => $authors[0]->id,
            'available' => true,
        ]);

        Book::create([
            'title' => 'Pán prstenů: Společenstvo prstenu',
            'author_id' => $authors[1]->id,
            'available' => true,
        ]);

        Book::create([
            'title' => 'Hra o trůny',
            'author_id' => $authors[2]->id,
            'available' => true,
        ]);

        Book::create([
            'title' => 'Nadace',
            'author_id' => $authors[3]->id,
            'available' => true,
        ]);

        Book::create([
            'title' => '2001: Vesmírná odysea',
            'author_id' => $authors[4]->id,
            'available' => true,
        ]);
    }
}
