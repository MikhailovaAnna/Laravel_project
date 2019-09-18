<?php
use App\Book;
use Illuminate\Support\Facades\Input;
    /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/table', 'BookController@index');

Route::get('/', 'BookController@welcome');

Route::get('/search', 'BookController@search');

Route::get('/sort', 'BookController@sort');

/**
 * Метод для поиска по таблице
 *
 * @param '/result', function()
 *   Страница, где будут выведены результаты поиска, и функция самого поиска по таблице
 * @return query() строки из таблицы
 */
Route::post('/result', function (){
    $q = Input::get('text_search');
    $q_phone = Input::get('phone_search');
    $q_date = Input::get('date_search');
    if($q != "" or $q_phone != "" or $q_date != ""){
        if ($q != ""){
            $book = Book::where('Text', 'LIKE', '%'.$q.'%')->get();
            if (count($book) > 0){
                return view('search')->with('details', $book)->with('query', $q);
            }
        }
        if ($q_phone != ""){
            $book = Book::where('Phone', 'LIKE', '%'.$q_phone.'%')->get();
            if (count($book) > 0){
                return view('search')->with('details', $book)->with('query', $q_phone);
            }
        }
        if ($q_date != ""){
            $book = Book::where('Date', 'LIKE', '%'.$q_date.'%')->get();
            if (count($book) > 0){
                return view('search')->with('details', $book)->with('query', $q_date);
            }
        }
    }

    return view('search')->with('message', "No results!");
});

/**
 * Сортировка таблицы по дате, начиная с введенного числа
 *
 * @param '/startSort', function()
 *   Страница, где будут выведены результаты сортировки, и функция сортировки
 * @return query() строки из таблицы
 */
Route::post('/startSort', function(){
    $q = Input::get('text_sort');
    if ($q != ""){
        $book = Book::where('Date', '>', '%'.$q.'%')->orderBy('Date')->get();
        if (count($book) > 0){
            return view('startSort')->with('details', $book)->with('query', $q);
        }
    }
    return view('startSort')->with('message', "No results!");
});



