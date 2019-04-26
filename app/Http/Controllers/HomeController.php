<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = DB::select("SELECT * FROM ticket_categories");
        $counts = array();

        // Count the number of tickets in each category and add the numbers to an array
        for ($i = 1; $i <= 6; $i++)
        {
            $category = DB::select("SELECT COUNT(ticket_category_code) AS count FROM tickets WHERE ticket_category_code = '$i'");
            array_push($counts, $category);
        }
        
        return view('home')->with('counts', $counts)->with('categories', $categories);
    }
}
