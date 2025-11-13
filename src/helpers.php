<?php

if(!function_exists('ping'))
{
    function ping($payload){
        \LaravelPing\Events\DebugTriggered::dispatch($payload);
    }
}



if(!function_exists('p'))
{
    function p($payload){
        \LaravelPing\Events\DebugTriggered::dispatch($payload);
    }
}
