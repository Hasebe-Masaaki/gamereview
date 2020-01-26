{{-- ゲーム情報編集画面 --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="contain-center card mw-100 mh-70 pb-2">
            <div class="row no-gutters">
                <h5 class="card mt-2 mx-2">ゲーム情報登録</h5>
            </div>
            <form action="{{ action('Admin\GameController@update') }}" method="post" enctype="multipart/form-data" id="form-gameadd">
                @csrf
                <input type="hidden" name="game_id" value="{{ $game_info->game_id }}">
                <div class="form-point mt-2">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">タイトル</h5>
                    </div>
                    <div class="row no-gutters">
                        <input type="text" class="form-control ml-4 mr-2 col col-md-7" name="game_title"
                            value="{{ $game_info->game_title }}" placeholder="タイトルを入力してください">
                    </div>
                </div>
                <div class="form-point mt-2">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">発売日</h5>
                    </div>
                    <div class="row no-gutters">
                        <input type="text" class="form-control ml-4 col-4 col-md-2" name="release_date"
                            value="{{ isset($game_info->game_id) ? $game_info->release_date->format('Y-n-d') : '' }}" placeholder="yyyy-mm-dd">
                    </div>
                </div>
                <div class="form-point mt-2">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">メーカー</h5>
                    </div>
                    <div class="row no-gutters">
                        <input type="text" class="form-control ml-4 col-8 col-md-4" name="maker_name"
                            value="{{ $game_info->maker_name }}" placeholder="メーカーを入力してください">
                    </div>
                </div>
                <div class="form-genre mt-3">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">ジャンル</h5>
                    </div>
                    <div class="ml-4 d-flex flex-column">
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('game_genre', 'ＲＰＧ', ($game_info->game_genre == 'ＲＰＧ') ? true : false, array('class' => '', 'id' => 'genre1')) }}
                            {{ Form::label('game_genre', 'ＲＰＧ', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('game_genre', 'アクション', ($game_info->game_genre == 'アクション') ? true : false, array('class' => '', 'id' => 'genre2')) }}
                            {{ Form::label('game_genre', 'アクション', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('game_genre', 'アドベンチャー', ($game_info->game_genre == 'アドベンチャー') ? true : false, array('class' => '', 'id' => 'genre3')) }}
                            {{ Form::label('game_genre', 'アドベンチャー', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('game_genre', 'シューティング', ($game_info->game_genre == 'シューティング') ? true : false, array('class' => '', 'id' => 'genre4')) }}
                            {{ Form::label('game_genre', 'シューティング', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('game_genre', 'シミュレーション', ($game_info->game_genre == 'シミュレーション') ? true : false, array('class' => '', 'id' => 'genre5')) }}
                            {{ Form::label('game_genre', 'シミュレーション', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('game_genre', 'スポーツ', ($game_info->game_genre == 'スポーツ') ? true : false, array('class' => '', 'id' => 'genre6')) }}
                            {{ Form::label('game_genre', 'スポーツ', array('class' => 'h5')) }}
                        </div>
                    </div>
                </div>
                <div class="form-summary mt-3">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">ゲーム概要</h5>
                    </div>
                    <div class="row no-gutters">
                        <textarea type="text" class="form-control mx-2 mx-md-4" rows="10" name="game_summary"
                            placeholder="ゲーム概要を入力してください">{{ $game_info->game_summary }}</textarea>
                    </div>
                </div>
                <div class="form-submit text-right mt-3">
                    <input type="submit" class="p-2 mx-2 mr-md-4" id="game-submit" value="ゲーム情報を更新">
                </div>
            </form>
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
