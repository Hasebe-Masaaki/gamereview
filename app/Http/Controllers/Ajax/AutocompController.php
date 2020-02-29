<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Game;
use App\Review;

use Auth;
use App\Traits\Calpoint;

class AutocompController extends Controller
{
    use Calpoint;

    public function autocomp(Request $request)
    {
        $game_keyword = $request->str;
        // \Debugbar::info($game_keyword);

        //コールバックで返す用の変数(配列)
        $d_arr = array();

        $data = Game::where('game_title', 'LIKE','%'.$game_keyword.'%')->get();

        if($data){
            foreach($data as $d){
                array_push($d_arr, $d->game_title);
            }
        }

        // \Debugbar::info($d_arr);
        return response()->json(array('data' => $d_arr));
    }

    public function select(Request $request)
    {
        //特定のゲームタイトルのレコードを取得
        $game_title = $request->str;
        $game_info = Game::where('game_title', $game_title)->first();
        $reviews = Review::where('game_id', $game_info->game_id);
        //\Debugbar::info($game_info);

        // 計算結果を配列に格納
        $datas = $this->reviewPoint($reviews);
        // $datas = array_merge($datas, array('game_id' => $game_info->game_id,
        //                         'game_title' => $game_info->game_title,
        //                         'maker_name' => $game_info->maker_name,
        //                         'game_genre' => $game_info->game_genre,
        //                         'release_date' => $game_info->release_date->format('Y年n月d日'),
        //                         'game_summary' => $game_info->game_summary));
        if(isset($game_info)) {
            $datas = array_merge($datas, $game_info->toArray());
            $datas['release_date'] = $game_info->release_date->format('Y年n月d日');
        }

        //レビュー済であればレコードを取得
        $review_info = $reviews->where('user_id', Auth::id())->first();
        if(isset($review_info)) {
            $datas = array_merge($datas, $review_info->toArray(), array('submit_flg' => $review_info->count()));
        }

        return response()->json($datas);
    }
}
