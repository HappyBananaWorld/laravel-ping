<?php

namespace App\Http\Controllers;

use App\Events\DebugCalled;
use App\Models\User;
use App\Services\Ping;
use Illuminate\Http\Request;

class TestingController extends Controller
{
        public function __construct(
            public Ping $ping
        )
        {
        }

    public function index()
    {
        $arr = User::factory()->make();
        DebugCalled::dispatch($arr);

        DebugCalled::dispatch('here i tested security');

        DebugCalled::dispatch('list on users');
        $arr = User::factory()->count(20)->make();
        DebugCalled::dispatch($arr);
//$this->ping->pd();
    }
}
