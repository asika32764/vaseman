<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $view      ViewModel       The view modal object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\Attributes\ViewModel;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

$htmlFrame = $app->service(\Windwalker\Core\Html\HtmlFrame::class);

?>
<section class="admin-header bg-light py-3 position-sticky" style="top: 0; z-index: 5">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center px-3">
        <div class="mb-3 mb-lg-0">
            <h1 class="h3 m-0">{{ $htmlFrame->getTitle() }}</h1>
        </div>

        <div>
            @section('admin-toolbar')
                @include('admin.global.layout.toolbar')
            @show
        </div>
    </div>
</section>
