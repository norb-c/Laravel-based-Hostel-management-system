<?php

use Faker\Generator as Faker;

$factory->define(App\Admin::class, function (Faker $faker) {
	return [
		'name' => $faker->name,
		'email' => 'chigoziemadubuko@gmail.com',
		'job_title' => $faker->title,
		'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', //secret
		'remember_token' => str_random(10)
	];
});