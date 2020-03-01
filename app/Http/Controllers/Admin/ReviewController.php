<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Report;
use App\Review;
use App\Game;

use App\Traits\Calpoint;

class ReviewController extends Controller
{
    use Calpoint;

    public function index(Request $request)
    {
        //通報記事のレコードを取得
        $reports = Report::with('profile', 'review', 'review.game', 'review.profile', 'review.evaluations');
        //\Debugbar::info($game_info);

        //通報件数を取得
        $datas = array('report_count' => $reports->count());

        // ページネーションを取得
        $reports_info = $reports->orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.index', ['reports_info' => $reports_info, 'datas' => $datas]);
    }

    public function add(Request $request)
    {
        // Validationをかける
        $this->validate($request, Review::$rules_update);

        //レビューレコードを取得
        $review_id = $request->review_id;
        $review_info = Review::where('review_id', $review_id)->first();
        if (empty($review_info)) {
            abort(400);
        }
        //\Debugbar::info($game_info);

        //特定のゲームタイトルのレコードを取得
        $game_info = Game::where('game_id', $review_info->game_id)->first();
        // 空であればエラー
        if (empty($game_info)) {
            abort(400);
        }
        $reviews = Review::with('game', 'profile', 'evaluations')->where('game_id', $review_info->game_id);

        // 計算結果を配列に格納
        $datas = $this->reviewPoint($reviews);

        return view('admin.review.add', ['game_info' => $game_info, 'review_info' => $review_info, 'datas' => $datas]);
    }

    public function update(Request $request)
    {
        // レビュー記事を更新する
        $called = app()->make('App\Http\Controllers\ReviewController');
        $redirect = $called->create($request);

        // 通報記事を削除する
        Report::where('review_id', $request->review_id)->delete();

        return redirect('/admin');
    }

    public function delete(Request $request)
    {
        // レビュー記事を削除する
        $called = app()->make('App\Http\Controllers\ReviewController');
        $redirect = $called->delete($request);

        // 通報記事を削除する
        Report::where('review_id', $request->review_id)->delete();

        return $redirect;
    }

    public function info(Request $request)
    {
        //レビューレコードを取得
        $reviews = Review::with('game', 'profile', 'evaluations');
        //\Debugbar::info($game_info);

        // 計算結果を配列に格納
        $datas = $this->reviewPoint($reviews);

        // ページネーションを取得
        $reviews_info = $reviews->orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.review.info', ['reviews_info' => $reviews_info, 'datas' => $datas, 'append' => array()]);
    }
}
