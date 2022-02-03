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

?>
<aside id="admin-toolbar" class="navbar-expand-lg">
    <button class="navbar-toggler w-100 mb-3" type="button" data-bs-toggle="collapse"
        data-bs-target="#admin-toolbar-content"
        aria-controls="admin-toolbar-content"
        aria-expanded="false" aria-label="Toggle navigation"
    >
        <span class="fa fa-tools"></span>
        Toggle Toolbar
    </button>
    <div id="admin-toolbar-content" class="admin-toolbar-buttons collapse navbar-collapse">
        @yield('toolbar-buttons')
    </div>
</aside>
