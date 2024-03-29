<?php

/**
 * Part of vaseman4 project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Edge;

use Windwalker\Edge\Extension\DirectivesExtensionInterface;

/**
 * The VasemanExtension class.
 */
class VasemanExtension implements DirectivesExtensionInterface
{
    public function getDirectives(): array
    {
        return [
            'markdown' => [$this, 'markdown'],
            'endmarkdown' => [$this, 'endmarkdown'],
            'dump' => function ($expression) {
                $expression = trim($expression, '()');
                return "<?php echo print_r({$expression}, true); ?>";
            },
            'shown' => function ($expression) {
                return "<?php echo \App\Debug\Dumper::show{$expression} ?>";
            }
        ];
    }

    public static function markdown(): string
    {
        return "<?php \App\Renderer\MarkdownRenderer::start(); ?>";
    }

    public static function endmarkdown(): string
    {
        return "<?php echo \App\Renderer\MarkdownRenderer::end(); ?>";
    }

    public function getName(): string
    {
        return 'vaseman';
    }
}
