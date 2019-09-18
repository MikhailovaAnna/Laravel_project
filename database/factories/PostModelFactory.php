<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

/*!
Генерирует случайные тестовые данные
\return Строка из 'Phone', 'Text', 'Date' - номер телефона, текстовое сообщение, дата отправки, генерируемые с помощью Faker
*/
$factory->define(App\Book::class, function(Faker $faker) {
    return [
        'Phone' => $faker-> phoneNumber,
        'Text' => $faker-> realText(),
        'Date' => $faker->dateTimeThisYear->format("Y-m-d"),

    ];
}
)
?>