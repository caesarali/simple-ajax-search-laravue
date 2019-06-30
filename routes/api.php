<?php

use Illuminate\Http\Request;
use App\Models\Transaction;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/transactions', function (Request $request) {
    $keyword = $request->q;

    $transactions = Transaction::when($keyword, function ($query, $keyword) {
        $query->where('code', $keyword)
            ->orWhereHas('customer', function ($query) use ($keyword) {
                $query->where('name', 'like', "%$keyword%");
            });
    })->with(['details.type', 'customer', 'user'])->get();

    return response()->json($transactions);
});
