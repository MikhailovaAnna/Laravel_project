<?php

namespace App\Http\Controllers;
use App\Book;
use Illuminate\Http\Request;

/*!
	\brief Контроллер для БД
	Данный контроллер имеет только одну простую цель: возможность просмотра БД с помощью разных функций.
*/
class BookController extends Controller
{
    public function index(){
        /// пагинация по 15 записей на странице
        $books = Book::paginate(15);
        return view('table', compact('books'));
    }

    public function welcome(){
        return view('welcome');
    }

    public function search(){
        return view('search');
    }

    public function sort(){
        /// сортировка таблицы по дате
        $books = Book::orderBy('Date')->paginate(15);
        return view('/sort', compact('books'));
    }
}
