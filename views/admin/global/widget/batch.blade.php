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

$update = isset($update) ? $update : true;
$copy = isset($copy) ? $copy : true;
?>
<style>
    body.bootstrap-3 #batch-modal .close {
        position: relative;
        top: -25px;
    }
</style>
<div class="modal fade" id="batch-modal" tabindex="-1" role="dialog" aria-labelledby="batch-modal-title">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="batch-modal-title">
                    <span class="fa fa-sliders"></span> @lang('phoenix.batch.modal.title')
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>
                    @lang('phoenix.batch.modal.desc')
                </p>
                <hr />
                <div class="form-horizontal">
                    {!! $form->renderFields(null, 'batch') !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" role="button" class="btn btn-default btn-outline-secondary" data-dismiss="modal">
                    <span class="fa fa-remove fa-times"></span>
                    @lang('phoenix.core.close')
                </button>
                @if ($update)
                    <button type="button" class="btn btn-info" onclick="Phoenix.Grid.hasChecked();Phoenix.patch()">
                        <span class="fa fa-check"></span>
                        @lang('phoenix.core.update')
                    </button>
                @endif
                @if ($copy)
                    <button type="button" class="btn btn-primary" onclick="Phoenix.Grid.hasChecked();Phoenix.post()">
                        <span class="fa fa-copy"></span>
                        @lang('phoenix.core.copy')
                    </button>
                @endif
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
