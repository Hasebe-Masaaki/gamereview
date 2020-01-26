<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Profile;
use App\Review;

use Auth;
use Storage;

use App\Traits\Calpoint;

class ProfileController extends Controller
{
    use Calpoint;

    public function info(Request $request)
    {
        //特定のユーザのレコードを取得
        $user_id = $request->user_id;
        $profile_info = Profile::where('user_id', $user_id)->first();
        $reviews = Review::with('game', 'profile', 'evaluations')->where('user_id', $user_id);

        // // 空であれば初期値を埋める
        // if (empty($profile_info)) {
        //     $profile_info = new Profile;
        //     $profile_info->user_id = $user_id;
        //     $profile_info->user_name = "名もなきレビュアー";
        //     $profile_info->age= "-";
        //     $profile_info->gender= "-";
        //     $profile_info->favorite_genre = "-";
        //     $profile_info->introduction = "よろしくお願いします";
        // }

        // レビュー件数、評価件数、平均を取得
        $datas = $this->profilePoint($reviews);

        // ページネーションを取得
        $reviews_info = $reviews->orderBy('updated_at', 'desc')->paginate(20);
        $append = ['user_id' => $user_id];

        return view('profile.info', ['profile_info' => $profile_info, 'reviews_info' => $reviews_info, 'datas' => $datas, 'append' => $append]);
    }

    public function edit(Request $request)
    {
        //ユーザIDを取得
        $user_id = $request->user_id;

        //ログインユーザでなければエラーを返す
        if($user_id != Auth::id()) {
            return redirect('/')->withErrors("プロフィールを更新できません");
        }

        //特定のユーザのレコードを取得
        $profile_info = Profile::where('user_id', $user_id)->first();

        // レビュー件数、評価件数、平均を取得
        $reviews = Review::with('evaluations')->where('user_id', $user_id);
        $datas = $this->profilePoint($reviews);

        return view('profile.edit', ['profile_info' => $profile_info, 'datas' => $datas]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);

        $profile = Profile::where('user_id', $request->user_id)->first();
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            // $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
            $profile->image_path = basename($path);
            // $profile->image_path = Storage::disk('s3')->url($path);
        } elseif (0 == strcmp($request->remove, 'true')) {
            $profile->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);
        unset($form['remove']);

        // データベースに保存する
        $profile->fill($form);
        $profile->save();

        return redirect()->route('profile.info', ['user_id' => $request->user_id]);
    }
}
