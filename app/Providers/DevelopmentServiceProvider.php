<?php

declare(strict_types=1);

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Tests\Faker\Block;
use Tests\Faker\Transaction;
use Tests\Faker\Wallet;

final class DevelopmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if (App::environment(['local', 'testing']) === true) {
            $faker = Factory::create();
            $faker->addProvider(new Wallet($faker));
            $faker->addProvider(new Transaction($faker));
            $faker->addProvider(new Block($faker));

            $this->app->instance(Generator::class, $faker);
        }
    }
}
