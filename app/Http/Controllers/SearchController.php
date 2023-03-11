<?php

namespace App\Http\Controllers;

use App\Models\UserSearchHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }
    // public function index(Request $request)
    // {
    //     $q = $request->input('q');

    //     // Perform search query using the $q variable

    //     // Store search history
    //     $history = new UserSearchHistory();
    //     $history->keyword = $q;
    //     $history->user_id = Auth::id();
    //     $history->search_time = Carbon::now();
    //     $history->search_results = json_encode($results);
    //     $history->save();

    //     return redirect('/search-results?q=' . $q);
    // }
    public function store(Request $request)
    {
        $q = $request->input('q');



        $url = 'https://dummyjson.com/products/search?q=' . urlencode($q);

        $response = file_get_contents($url);

        $getresults = json_decode($response, false);
        $results = $getresults->products;





        $history = new UserSearchHistory;
        $history->keyword = $q;
        $history->user_id = Auth::id();
        $history->search_time = Carbon::now();
        $history->search_results = $response;
        $history->save();


        // dd($history);
        return view('search-results', compact('results'));
    }
}
