<?php

namespace App\Helper;

class FooHelper
{
    public function __construct(protected HelperSet $parent) 
    {
        //
    }

    public function foo ()
    {
        return 'FOO';
    }
}
