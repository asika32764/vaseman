<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Seeder;

use App\Entity\Acme;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\ORM;

/**
 * Acme Seeder
 *
 * @var  Seeder          $seeder
 * @var  ORM             $orm
 * @var  DatabaseAdapter $db
 */
$seeder->import(
    static function () use ($seeder, $orm, $db) {
        $faker = $seeder->faker('en_US');
        $mapper = $orm->mapper(Acme::class);

        foreach (range(1, 15) as $i) {
            $acme = new Acme();
            $acme->setTitle($faker->sentence(2));
            $acme->setContent($faker->paragraph(5));
            $acme->setCreated($faker->dateTimeThisYear());
            $acme->setCreatedBy(1);

            $mapper->createOne($acme);

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(Acme::class);
    }
);
