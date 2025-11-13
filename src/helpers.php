<?php

if(!function_exists('ping'))
{
    function ping($payload){
        \YourVendor\LiveDebugger\Events\DebugTriggered::dispatch($payload);
    }
}



if(!function_exists('p'))
{
    function p($payload){
        \YourVendor\LiveDebugger\Events\DebugTriggered::dispatch($payload);
    }
}
