<?php

namespace App\Http\Controllers;

use App\Models\UserSearchHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchHistoryController extends Controller
{
    public function index(Request $request)
    {
        $searches = UserSearchHistory::query();

        // Apply keyword filter if selected
        if ($request->has('keywords')) {
            $keywords = $request->keywords;
            $searches->whereIn('keyword', $keywords);
        }

        // Apply user filter if selected
        if ($request->has('users')) {
            $users = $request->users;
            $searches->whereIn('user_id', $users);
        }

        // Apply time range filter if selected
        if ($request->has('time_range')) {
            $timeRange = $request->time_range;

            switch ($timeRange) {
                case 'yesterday':
                    $searches->whereBetween('search_time', [Carbon::now()->subDay(), Carbon::now()]);
                    break;
                case 'last_week':
                    $searches->whereBetween('search_time', [Carbon::now()->subWeek(), Carbon::now()]);
                    break;
                case 'last_month':
                    $searches->whereBetween('search_time', [Carbon::now()->subMonth(), Carbon::now()]);
                    break;
            }
        }

        // Apply date range filter if selected
        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $searches->whereBetween('search_time', [$startDate, $endDate]);
        }

        $searches = $searches->orderByDesc('search_time')->paginate(10);

        return view('search-history', compact('searches'));
    }


    public function show(UserSearchHistory $searchHistory)
    {
        // Display a single search history item
        return view('search-history', [
            'searchHistory' => $searchHistory
        ]);
    }

    
}
