<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::factory()->count(20)->create();
        Book::factory()->count(200)->create();

        $books = Book::all();
        foreach ($books as $book){
            $authorsCount = mt_rand(1,3);
            $authors = Author::limit($authorsCount)->inRandomOrder()->get()->pluck('id')->toArray();
            $book->authors()->sync($authors);
        }
    }
}
