<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin\AdminRole::class, function (Faker $faker) {
    return [
        'admin_id' => function () {
            return factory(App\Models\Admin\Admin::class)->create()->id;
        },
        'role_id' => function () {
            return factory(App\Models\Role::class)->create()->id;
        },
    ];
});
