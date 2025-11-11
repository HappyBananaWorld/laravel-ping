<?php

if(!function_exists('ping'))
{
    function ping($p){
        \YourVendor\LiveDebugger\Events\DebugCalled::dispatch($p);
    }
}



if(!function_exists('p'))
{
    function p($p){
        \YourVendor\LiveDebugger\Events\DebugCalled::dispatch($p);
    }
}
