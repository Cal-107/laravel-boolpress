<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
class HomeController extends Controller
{
    // Admin Homepage
    public function index() {

        // Carbon
        $now = Carbon::now();
        dump($now);
        dump($now->toDateTimeString());
        dump($now->toFormattedDateString());

        // dump($now->setDateTime(1975, 5, 21, 22, 32, 5)->toDateTimeString());
        // dump($now->year(2020)->month(5)->day(21)->hour(22)->minute(32)->second(5)->microsecond(123456)->toDateTimeString());
        // dump($now->setDate(1880, 5, 21)->setTime(22, 32, 5, 123456)->toDateTimeString());
        // dump($now->setDate(2022, 5, 21)->setTimeFromTimeString('22:32:05.123456')->toDateTimeString());
        // dump($now->setDateTime(2050, 5, 21, 22, 32, 5, 123456)->toDateTimeString());

        // Yesterday
        $yesterday = Carbon::yesterday();
        dump($yesterday->toDateTimeString());

        // Tomorrow
        $tomorrow = Carbon::tomorrow();
        dump($tomorrow->format('d/m/Y'));

        return view('admin.home');
    }
}
