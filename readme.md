Практика
========

## Рабработка программного обеспечения для поэтапного вывода части большой таблицы БД в WEB-интерфейсе пользователя

   ПО предназначено для отображения таблицы БД, информация из которой отображается поэтапно, по запросу пользователя следующего или предыдущего блока данных, или блока, начинающегося с определенной даты, создан поиск данных в БД по дате, сообщению и номеру телефона.

Разработка велась с использованием CMF Laravel, на языках программирования PHP 7.3, HTML, CSS.

Таблица содержит столбцы: "Номер телефона", "Дата", "Время", "Текст сообщения".

## Инструкция

* Установка Composer

Composer неободим для предоставления средств по управлению зависимостями в PHP-приложении.

    sudo apt install composer
    
* Установка Laravel с помощью Composer

```
composer global require laravel/installer
```

Изменяем переменную PATH:

    export PATH="$HOME/.config/composer/vendor/bin:$PATH"
   
* Создание проекта Laravel:
```
laravel new new_laravel
```
где new_laravel - это имя проекта.

Можно проверить работу проекта, запустив сервер командой:

    php artisan serve

Если увидела стартовую страницу Laravel - все в порядке!

* Установка PostgreSQL
```
sudo apt-get update
sudo apt-get install postgresql-10.4
```

* Создание базы данных
```
sudo -u postgres psql -c "CREATE DATABASE db;"
```
где db - название базы данных.

Запустить и отключить сервер PostgreSQL можно командами:

    sudo service postgresql start
    sudo service postgresql stop

* Подключение проекта к БД

В файле проекта .env заменяются следующие строчки:

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=ann
    DB_USERNAME=ann
    DB_PASSWORD=789

DB_DATABASE, DB_USERNAME, DB_PASSWORD меняем в зависимости от созданных нами БД, пользователя и пароля.

В файле config/database.php заменяем:

    'default' => env('DB_CONNECTION', 'pgsql'),
    
Перезагружаем сервер БД, и наш проект должен быть подключен к БД!

* Генерация тестовых данных

С помощью миграций создаем таблицу с данными, в моем случае - books.

    php artisan make:migration books
    
В папке database/migrations должна появится соответствующая миграция. В ней заменяем существующую функцию up() на:

    public function up()
        {
            Schema::create('books', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('Phone');
                $table->text('Text');
                $table->date('Date');
                $table->timestamps();
            });
        }

В папке database/factories создаем файл BookModelFactory.php, с содержанием:

    <?php
    
    /** @var \Illuminate\Database\Eloquent\Factory $factory */
    
    use Faker\Generator as Faker;
    $factory->define(App\Book::class, function(Faker $faker) {
        return [
            'Phone' => $faker-> phoneNumber,
            'Text' => $faker-> realText(),
            'Date' => $faker->dateTimeThisYear->format("Y-m-d"),
    
        ];
    }
    )
    ?>

Как можно заметить, тестовые данные генерируются при помощи Faker.

Создадим seeder:

    php artisan make:seeder BookTableSeeder​

Открываем этот файл(database/seeds) и вставляем:

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
            factory(App\Book::class, 7000000)->create()->each(function($book){
                $book->save();
            });
        }
    }

Где значение будет являться количеством записей таблицы.

В файле DatabaseSeeder.php функция run() имеет вид:

    public function run()
        {
            $this->call(BookTableSeeder::class);
        }

И запускаем генерацию данных командой:

    php artisan db:seed
    
* Настройка роутинга

Заходим в папку resources/routes, открываем файл web.php и прописываем методы:

    Route::get('/table', 'BookController@index');
    
    Route::get('/', 'BookController@welcome');
    
    Route::get('/search', 'BookController@search');
    
    Route::get('/sort', 'BookController@sort');
    
    // метод post для поиска по таблице
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
    
    // сортировка таблицы по дате, начиная с введенного числа
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

Методы get() сделаны с помощью контроллеров, которые описаны в файле BookController.php(app/Http/Controller.php).

    class BookController extends Controller
    {
        public function index(){
            // пагинация по 15 записей на странице
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
            // сортировка таблицы по дате
            $books = Book::orderBy('Date')->paginate(15);
            return view('/sort', compact('books'));
        }
    }

Теперь настроены все переходы между страницами.

* Описание страниц

Проект содержит несколько страниц. 

**welcome.blade.php** - главная страница, на которой находится описание задания и кнопка для начала просмотра таблицы БД.

**table.blade.php** - страница, отображающая всю таблицу БД, на ней имеются кнопки для перехода к поиску по таблице, переход к отсортированной таблице(т.к. начальная генерировалась со случайными значениями).

**search.blade.php** - страница, на которой можно задать параметры поиска по таблице - через дату, номера телефона и содержание сообщений, и увидеть результаты.

**sort.blade.php** - страница, отображающая отсортированную таблицу по дате.

**startSort.blade.php** - страница, где отображаются результаты сортировки сообщений, начичиная с конкретной даты.

Способы поиска и сортировки описаны выше в пункте с роутингом.