<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Game;
use App\Review;
use App\Profile;

use Auth;
use Carbon\Carbon;

use App\Traits\Calpoint;

class ReviewController extends Controller
{
    use Calpoint;

    public function index(Request $request)
    {
        // ログインIDを取得
        $user_id = Auth::id();

        // 最近20件のレビューレコードを取得
        $reviews_info = Review::with('game', 'profile', 'evaluations')->orderBy('updated_at', 'desc')->take(20)->get();
        $profile_info = Profile::where('user_id', $user_id)->first();
        $reviews_user = Review::with('evaluations')->where('user_id', $user_id);

        // レビュー件数を取得
        $datas = $this->profilePoint($reviews_user);
        $datas = array_merge($datas, array('review_count' => $reviews_info->count()));

        return view('index', ['reviews_info' => $reviews_info, 'profile_info' => $profile_info, 'datas' => $datas]);
    }

    public function search(Request $request)
    {
        // POSTであればValidationをかける
        if($request->isMethod('POST')) {
            $this->validate($request, Game::$rules_search);
        }

        //特定の文字列が含まれるゲームタイトルのレコードを取得
        //$game_keyword = "マリオ"; //ダミー
        $game_keyword = $request->game_keyword;
        //\Debugbar::info($game_keyword);

        $games = Game::with('reviews')->where('game_title', 'like', "%{$game_keyword}%");
        //\Debugbar::info($games);

        // ゲーム情報件数を取得
        $game_count = $games->count();

        $datas = array();
        // 計算結果を配列に格納
        foreach ($games->get() as $game) {
            $data = $this->reviewPoint($game->reviews);
            $datas["$game->game_id"] = $data;
        }
        //\Debugbar::info($datas);

        // ページネーションを取得
        $games_info = $games->orderBy('release_date', 'desc')->paginate(20);

        return view('review.search', ['games_info' => $games_info, 'game_count' => $game_count, 'datas' => $datas]);
    }

    public function info(Request $request)
    {
        // Validationをかける
        $this->validate($request, Game::$rules);

        //特定のゲームタイトルのレコードを取得
        $game_id = $request->game_id;
        $game_info = Game::where('game_id', $game_id)->first();
        $reviews = Review::with('game', 'profile', 'evaluations')->where('game_id', $game_id);
        //\Debugbar::info($game_info);

        // 計算結果を配列に格納
        $datas = $this->reviewPoint($reviews);

        // ページネーションを取得
        $reviews_info = $reviews->orderBy('updated_at', 'desc')->paginate(20);
        $append = ['game_id' => $game_id];

        return view('review.info', ['game_info' => $game_info, 'reviews_info' => $reviews_info, 'datas' => $datas, 'append' => $append]);
    }

    public function add(Request $request)
    {
        //特定のゲームタイトルのレコードを取得
        $game_id = $request->game_id;
        $game_info = Game::where('game_id', $game_id)->first();
        $reviews = Review::with('game', 'profile', 'evaluations')->where('game_id', $game_id);

        // 空であれば初期値を埋める
        if (empty($game_info)) {
            $game_info = new Game;
            $game_info->game_title = "ゲームタイトル";
            $game_info->maker_name = "メーカー名";
            $game_info->game_genre = "ジャンル";
            //$game_info->release_date = "発売日";
            $game_info->game_summary = "…".str_repeat("　",90);
        }

        // 計算結果を配列に格納
        $datas = $this->reviewPoint($reviews);

        //レビュー済であればレコードを取得
        if (isset($request->review_id)) {
            $review_info = $reviews->where('review_id', $request->review_id)->first();
        }
        else {
            $review_info = $reviews->where('user_id', Auth::id())->first();
            if (empty($review_info)) {
                $review_info = new Review;
            }
        }

        return view('review.add', ['game_info' => $game_info, 'review_info' => $review_info, 'datas' => $datas]);
    }

    // public function edit(Request $request)
    // {
    //     // Validationをかける
    //     $this->validate($request, Review::$rules);
    //
    //     //特定のゲームタイトルのレコードを取得
    //     $review_id = $request->review_id;
    //     $reviews = Review::with('game', 'profile', 'evaluations')->where('review_id', $review_id)->first();
    //     $game_info = Game::where('game_id', $game_id)->first();
    //
    //     // 計算結果を配列に格納
    //     $datas = $this::calpoint($reviews);
    //
    //     //レビュー済であればレコードを取得
    //     $review_info = $reviews->where('user_id', Auth::id())->first();
    //     if (empty($review_info)) {
    //         $review_info = new Review;
    //     }
    //     //\Debugbar::info($game_info);
    //
    //     return view('review.add', ['game_info' => $game_info, 'review_info' => $review_info, 'datas' => $datas]);
    // }

    public function create(Request $request)
    {
        // Todo:fillで更新

        // Validationをかける
        $this->validate($request, Review::$rules);

        // // フォームから送信されてきた_tokenを削除する
        // $form = $request->all();
        // unset($form['_token']);
        //
        // // Review Modelからデータを取得する
        // $review = new Review;
        // $review->fill($form);
        // \Debugbar::info($review);

        // Review Modelからデータを取得する
        $review = new Review;
        // $review->review_id = $request->review_id;
        //\Debugbar::info($review);

        // 既存レコードがなければ新規登録、あれば更新
        $review_record = Review::where('review_id', $request->review_id)->first();

        if(empty($review_record)) {
            // ログインユーザのIDを取得
            $review->user_id = Auth::id();
            $review->game_id = $request->game_id;
            $review->created_at = Carbon::now();
        }
        else {
            $review = $review_record;
        }
        $review->review_point = $request->review_point;
        $review->review_title = $request->review_title;
        $review->review_content = $request->review_content;
        $review->spoiler_flg = isset($request->spoiler_flg) ? $request->spoiler_flg : 0;
        $review->updated_at = Carbon::now();

        // 該当するデータを上書きして保存する
        //\Debugbar::info($review);
        $review->save();

        return redirect('/');
    }

    public function delete(Request $request)
    {
        // Validationをかける
        $this->validate($request, Review::$rules_update);

        // レビュー記事を削除する
        Review::where('review_id', $request->review_id)->delete();

        return redirect(url()->previous());
    }
}
