<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Game;

use Carbon\Carbon;

class GameController extends Controller
{
    public function info(Request $request)
    {
        // ゲーム情報件数を取得
        $game_count = Game::count();

        // ページネーションを取得
        $games_info = Game::orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.game.info', ['games_info' => $games_info, 'game_count' => $game_count]);
    }

    public function search(Request $request)
    {
        // POSTであればValidationをかける
        if($request->isMethod('POST')) {
            $this->validate($request, Game::$rules_search);
        }

        //特定の文字列が含まれるゲームタイトルのレコードを取得
        $game_keyword = $request->game_keyword;
        //\Debugbar::info($game_keyword);

        $games = Game::with('reviews')->where('game_title', 'like', "%{$game_keyword}%");
        //\Debugbar::info($games);

        // ゲーム情報件数を取得
        $game_count = $games->count();

        // ページネーションを取得
        $games_info = $games->orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.game.info', ['games_info' => $games_info, 'game_count' => $game_count]);
    }

    public function edit(Request $request)
    {
        //ユーザIDを取得
        $game_id = $request->game_id;

        //特定のゲームのレコードを取得
        $game_info = Game::where('game_id', $game_id)->first();
        if (empty($game_info)) {
            $game_info = new Game;
        }

        return view('admin.game.edit', ['game_info' => $game_info]);
    }

    public function update(Request $request)
    {
        // Todo:fillで更新

        // Validationをかける
        $this->validate($request, Game::$rules_update);

        // Review Modelからデータを取得する
        $game = new Game;
        $game->game_id = $request->game_id;
        //\Debugbar::info($review);

        // 既存レコードがなければ新規登録、あれば更新
        $game_record = Game::where('game_id', $game->game_id)->first();
        if(empty($game_record)) {
            $game->created_at = Carbon::now();
        }
        else {
            $game = $game_record;
        }
        $game->game_title = $request->game_title;
        $game->release_date = $request->release_date;
        $game->maker_name = $request->maker_name;
        $game->game_genre = $request->game_genre;
        $game->game_summary = $request->game_summary;
        $game->updated_at = Carbon::now();

        // 該当するデータを上書きして保存する
        //\Debugbar::info($review);
        $game->save();

        return redirect('admin/game/info');
    }

    public function delete(Request $request)
    {
        // Validationをかける
        $this->validate($request, Game::$rules);

        // レビュー記事を削除する
        Game::where('game_id', $request->game_id)->delete();

        return redirect(url()->previous());
    }
}
