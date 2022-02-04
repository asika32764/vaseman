<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Helper;

use App\Data\Template;
use App\Web\AssetService;
use App\Web\SystemUri;
use Windwalker\Core\Application\ApplicationInterface;
use Windwalker\Utilities\Cache\InstanceCacheTrait;
use Windwalker\Utilities\StrNormalize;

/**
 * The HelperSet class.
 */
class HelperSet
{
    use InstanceCacheTrait;

    public function __construct(
        protected ApplicationInterface $app,
        public Template $template,
        public SystemUri $uri,
        public AssetService $asset
    ) {
    }

    public function __get(string $name)
    {
        $name = StrNormalize::toPascalCase($name);

        return $this->once(
            'helper.' . $name,
            function () use ($name) {
                $className = sprintf(
                    '%s\%sHelper',
                    __NAMESPACE__,
                    $name
                );

                return $this->app->make(
                    $className,
                    [
                        HelperSet::class => $this,
                        Template::class => $this->template,
                        SystemUri::class => $this->uri,
                        AssetService::class => $this->asset,
                    ]
                );
            }
        );
    }
}
