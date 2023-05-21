<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AiGraphController extends Controller
{
    public function index()
    {
        $oneYearAgo = now()->subYear();
        $graphData = DB::table('ai_order_graph')
            ->where('date', '>', $oneYearAgo)
            ->orderBy('date')
            ->get(['date', 'ordercount']);

        $dates = $graphData->pluck('date');
        $ordercount = $graphData->pluck('ordercount');

        return view('ai-graph', [
            'dates' => $dates,
            'ordercount' => $ordercount,
        ]);
    }
}
