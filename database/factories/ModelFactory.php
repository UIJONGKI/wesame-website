<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker){
	$date = $faker ->dateTimeThisMonth;

	return [
		'title' => $faker->sentence(),
		'content' => $faker->paragraph(),
		'created_at' => $date,
		'updated_at' => $date,
	];
});

$factory->define(App\Gallery::class, function (Faker\Generator $faker) {
	$date = $faker ->dateTimeThisMonth;

	return [
		'title' => $faker->sentence(),
		'content' => $faker->paragraph(),
		'created_at' => $date,
		'updated_at' => $date,
	];
});

$factory->define(App\Attachment::class, function (Faker\Generator $faker) {
	return [
	'filename' => sprintf("%s.%s", str_random(), $faker->randomElement(['jpg', 'jpeg', 'png', 'zip', 'tar'])
		)
	];
});

$factory->define(App\Comment::class, function(Faker\Generator $faker) {
	$articleIds = App\Article::pluck('id')->toArray();
	$userIds = App\User::pluck('id')->toArray();

	return [
		'content' => $faker->paragraph,
		'commentable_type' => App\Article::class,
		'commentable_id' => function () use ($faker, $articleIds) {
			return $faker->randomElement($articleIds);
		},
		'user_id' => function () use ($faker, $userIds){
			return $faker->randomElement($userIds);
		},
	];
});

$factory->define(App\Gcomment::class, function(Faker\Generator $faker) {
	$galleryIds = App\Gallery::pluck('id')->toArray();
	$userIds = App\User::pluck('id')->toArray();

	return [
		'content' => $faker->paragraph,
		'commentable_type' => App\Gallery::class,
		'commentable_id' => function () use ($faker, $galleryIds) {
			return $faker->randomElement($galleryIds);
		},
		'user_id' => function () use ($faker, $userIds){
			return $faker->randomElement($userIds);
		},
	];
});
