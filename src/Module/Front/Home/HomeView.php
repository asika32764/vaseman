<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Module\Front\Home;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\View\View;
use Windwalker\Core\View\ViewModelInterface;
use Windwalker\ORM\ORM;

/**
 * The HomeView class.
 */
#[ViewModel(
    layout: 'home',
    css: 'home.scss',
    js: 'home.js',
)]
class HomeView implements ViewModelInterface
{
    /**
     * HomeView constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * Prepare
     *
     * @param  AppContext  $app
     * @param  View        $view
     *
     * @return  mixed
     */
    public function prepare(AppContext $app, View $view): array
    {
        return [];
    }
}
