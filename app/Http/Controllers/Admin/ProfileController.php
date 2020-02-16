<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function info(Request $request)
    {
        $called = app()->make('App\Http\Controllers\ProfileController');
        $view = $called->info($request);

        // \Debugbar::info($redirect);
        return view('admin.profile.info', ['profile_info' => $view->profile_info, 'reviews_info' => $view->reviews_info, 'datas' => $view->datas, 'append' => $view->append]);
    }
}
