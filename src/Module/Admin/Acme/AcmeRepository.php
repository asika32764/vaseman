<?php

/**
 * Part of starter project.
 *
 * @copyright    Copyright (C) 2021 __ORGANIZATION__.
 * @license        __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Admin\Acme;

use App\Entity\Acme;
use Windwalker\Database\DatabaseAdapter;

/**
 * The AcmeRepository class.
 */
class AcmeRepository
{
    /**
     * AcmeRepository constructor.
     */
    public function __construct(protected DatabaseAdapter $db)
    {
        //
    }

    public function getList(int $limit = 15): iterable
    {
        return $this->db->orm()
            ->mapper(Acme::class)
            ->select()
            ->limit($limit);
    }
}
