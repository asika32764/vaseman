<?php

/**
 * Part of Windwalker project.
 *
 * @copyright    Copyright (C) 2021.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

use App\Entity\Acme;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Core\Migration\Migration;
use Windwalker\Database\Schema\Schema;

/**
 * Migration UP: 20210619155333_AcmeInit.
 *
 * @var  Migration          $mig
 * @var  ConsoleApplication $app
 */
$mig->up(
    static function () use ($mig) {
        $mig->createTable(Acme::class, function (Schema $schema) {
            $schema->primary('id');
            $schema->varchar('title');
            $schema->text('content');
            $schema->integer('created_by');
            $schema->datetime('created');

            $schema->addIndex('created_by');
        });
    }
);

/**
 * Migration DOWN.
 */
$mig->down(
    static function () use ($mig) {
        $mig->dropTables(Acme::class);
    }
);
