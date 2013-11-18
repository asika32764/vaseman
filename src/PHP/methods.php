<?php

/**
 * Print Array or Object as tree node. If send multiple params in this method, will batch print it.
 * 
 * @param    mixed    $data    Array or Object to print.
 */
function show($data)
{
    $args   = func_get_args();
    
    // Print Multiple values
    if(count($args) > 1) {    
        $prints = array();
        
        $i = 1 ;
        foreach( $args as $arg ):
            $prints[] = "[Value " . $i . "]\n" . print_r($arg, 1);
            $i++ ;
        endforeach;
        
        echo '<pre>'.implode("\n\n", $prints).'</pre>' ;
    }else{
        // Print one value.
        echo '<pre>'.print_r($data, 1).'</pre>' ;
    }        
}