<?php

/**
 * Part of vaseman project.
 *
 * @copyright  Copyright (C) 2022 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Debug;

use Windwalker\Utilities\Dumper\VarDumper;

/**
 * The Dumper class.
 */
class Dumper
{
    public static function show(...$args): string
    {
        $output = '';

        if (VarDumper::isSupported()) {
            $dumper = [VarDumper::class, 'dump'];
        } else {
            $dumper = [static::class, 'dump'];
        }

        $level = 5;

        if (count($args) > 1) {
            $last = array_pop($args);

            if (is_int($last)) {
                $level = $last;
            } else {
                $args[] = $last;
            }
        }

        $output .= "\n\n";
        $output .= '<pre>';

        // Dump Multiple values
        if (count($args) > 1) {
            $prints = [];

            $i = 1;

            foreach ($args as $arg) {
                $prints[] = '[Value ' . $i . "]\n" . $dumper($arg, $level);
                $i++;
            }

            $output .= implode("\n\n", $prints);
        } else {
            // Dump one value.
            $output .= $dumper($args[0], $level);
        }

        $output .= '</pre>';

        return $output;
    }
}
