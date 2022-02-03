<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\View;

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

use function Windwalker\with;

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext     Global Application
 * @var $view      ViewModel      Some information of this view.
 * @var $uri       SystemUri      Uri information, example: $uri->path
 * @var $chronos   ChronosService PHP DateTime object of current time.
 * @var $nav       Navigator      Router object.
 * @var $asset     AssetService   The Asset manager.
 * @var $lang      LangService    The language.
 */

$app     = with(AppContext::class);
$view    = with(ViewModel::class);
$uri     = with(SystemUri::class);
$chronos = with(ChronosService::class);
$nav     = with(Navigator::class);
$asset   = with(AssetService::class);
$lang    = with(LangService::class);
