<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail; // <------- !!!
use Illuminate\Support\Facades\Auth;
use App\Mail\SendWelcomeEmail; // <------- !!!

class HomeController extends Controller
{
    // Admin Homepage
    public function index() {

        // Test sending mail
        // Mail::to('account@mail.it')->send(new SendWelcomeEmail());

        // Test AUTH
        // Mail::to(Auth::user()->email)->send(new SendWelcomeEmail(Auth::user()->name));

        Mail::to(Auth::user()->email)->send(new SendWelcomeEmail(Auth::user()->name));














        // Carbon
        // $now = Carbon::now();
        // dump($now);
        // dump($now->toDateTimeString());
        // dump($now->toFormattedDateString());

        // // dump($now->setDateTime(1975, 5, 21, 22, 32, 5)->toDateTimeString());
        // // dump($now->year(2020)->month(5)->day(21)->hour(22)->minute(32)->second(5)->microsecond(123456)->toDateTimeString());
        // // dump($now->setDate(1880, 5, 21)->setTime(22, 32, 5, 123456)->toDateTimeString());
        // // dump($now->setDate(2022, 5, 21)->setTimeFromTimeString('22:32:05.123456')->toDateTimeString());
        // // dump($now->setDateTime(2050, 5, 21, 22, 32, 5, 123456)->toDateTimeString());

        // // Yesterday
        // $yesterday = Carbon::yesterday();
        // dump($yesterday->toDateTimeString());

        // // Tomorrow
        // $tomorrow = Carbon::tomorrow();
        // dump($tomorrow->format('d/m/Y'));

        // // Date creation Carbon::create
        // $expire =  Carbon::create('2050/07/20');
        // dump($expire->format('m/d/Y'));

        // // Comparison
        // $first = Carbon::create('2022/02/12');
        // $second = Carbon::create('2023/02/12');
        // dump($first->lt($second));
        // dump($first->gt($second));

        // // Differences by days
        // $date = Carbon::create('2022/02/15');
        // dump($date->diffInDays());

        // dump($date->diffInDays('2022/12/31'));

        // // Translations
        // $date = Carbon::now()->locale('it');
        // dump($date->isoFormat('dddd DD/MM/YYYY'));
        // dump($date->locale());

        return view('admin.home');
    }
}
