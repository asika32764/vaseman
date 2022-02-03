<?php

/**
 * Global variables
 * --------------------------------------------------------------
 * @var $app       AppContext      Application context.
 * @var $vm        object          The view model object.
 * @var $uri       SystemUri       System Uri information.
 * @var $chronos   ChronosService  The chronos datetime service.
 * @var $nav       Navigator       Navigator object to build route.
 * @var $asset     AssetService    The Asset manage service.
 * @var $lang      LangService     The language translation service.
 */

declare(strict_types=1);

use Windwalker\Core\Application\AppContext;
use Windwalker\Core\Asset\AssetService;
use Windwalker\Core\DateTime\ChronosService;
use Windwalker\Core\Language\LangService;
use Windwalker\Core\Router\Navigator;
use Windwalker\Core\Router\SystemUri;

$session = $app->service(\Windwalker\Session\Session::class);

$messageGroup = $session->getFlashBag()->all();

?>

<div class="c-messages-container">
    @foreach ($messageGroup as $type => $messages)
        <div class="alert alert-{{ $type }} alert-dismissible fade show">
            @foreach ($messages as $message)
                <div>
                    {!! $message !!}
                </div>
            @endforeach

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach

    {!! $asset->getTeleport('messages')->render() !!}
</div>

