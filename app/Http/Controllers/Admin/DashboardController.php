<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
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
        $data['analyticsData'] = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $data['masvisitadas'] = Analytics::fetchMostVisitedPages(Period::days(7), $maxResults = 5);

        return view('admin/dashboard')->with($data);

    }
}
