<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
              //retrieve visitors and pageview data for the current day and the last seven days
        $data['analyticsData'] = Analytics::fetchVisitorsAndPageViews(Period::days(7));

        return view('home')->with($data);
    }
}
