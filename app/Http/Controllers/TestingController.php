<?php

namespace App\Http\Controllers;

use App\Models\User;
use YourVendor\LiveDebugger\Events\DebugCalled;

class TestingController extends Controller
{
        public function __construct(
        )
        {
        }

    public function index()
    {

        DebugCalled::dispatch('test');
p('hi');
ping('ping called');

    }
}
