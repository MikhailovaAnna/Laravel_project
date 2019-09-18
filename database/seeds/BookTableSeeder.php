<?php
use App\Book;
use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Book::class, 500000)->create()->each(function($book){
            $book->save();
        });
    }
}
