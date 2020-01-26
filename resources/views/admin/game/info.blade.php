{{-- ゲーム情報一覧表示画面 --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="contain-center card mw-100 mh-70 pb-2">
            <div class="game-info-top row no-gutters align-items-start m-2">
                <form class="row mb-2 mx-1" action="{{ action('Admin\GameController@search') }}" method="post">
                    @csrf
                    <input type="text" class="nav-search form-control mb-2 mb-md-0 pr-md-0 col-8 col-sm-6" name="game_keyword" placeholder="ゲームを検索">
                    <button class="nav-search-btn btn mb-2 mb-md-0 col-2 col-sm-1 col-md-2" type="submit">
                        <span class="oi oi-magnifying-glass p-0"></span>
                    </button>
                    {{-- ToDo:ボタンの色を変える --}}
                    <input type="button" class="review_edit my-1 mr-1 ml-3 px-md-1 col-md d-block" value="新規登録"
                        onclick="location.href='{{ action('Admin\GameController@edit') }}'">
                </form>
            </div>
            <div class="row no-gutters align-items-start mx-2">
                <h5 class="card">ゲームタイトル {{ $game_count }} 件</h5>
                <span class="d-flex justify-content ml-auto">
                    {{-- ToDo:枠線の色を変える --}}
                    {{ $games_info->links() }}
                </span>
            </div>
            @foreach($games_info as $game_info)
                <div class="row no-gutters">
                    <div class="offset-md-1 col-md-10">
                        <div class="row no-gutters ml-2">
                            <span>ID:{{ $game_info->game_id }}</span>
                            <span class="ml-2">{{ $game_info->updated_at }}</span>
                        </div>
                        <div class="game-info-top row no-gutters">
                            <div class="game-title">
                                {{-- ToDo:画面サイズによって文字数を変える（JavaScript）--}}
                                <h5 class="card mx-2" id="game-title">{{ Str::limit($game_info->game_title, 80)}}</h5>
                            </div>
                        </div>
                        <div class="game-info-top-2 row no-gutters">
                            <div class="game-bland">
                                <h5 class="card mb-2 mx-2" id="maker-name">{{ Str::limit($game_info->maker_name, 30) }}</h5>
                            </div>
                            <div class="game-genre">
                                <h5 class="card mb-2 mx-2" id="game-genre">{{ Str::limit($game_info->game_genre, 30) }}</h5>
                            </div>
                            <div class="game-date">
                                <h5 class="card mb-2 mx-2" id="release-date">{{ isset($game_info->release_date) ? $game_info->release_date->format('Y年n月d日') : '発売日' }}</h5>
                            </div>
                        </div>
                        <div class="game-info-bottom row no-gutters">
                            <div class="game-summary col">
                                <textarea readonly class="card mb-4 mx-2" style="min-width: 96%" rows="4" id="game-summary">{{ $game_info->game_summary }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 my-auto text-center">
                        <a class="btn btn-primary review_delete mb-2 px-1 py-0"
                            href="{{ action('Admin\GameController@edit', ['game_id' => $game_info->game_id]) }}">編集</a>
                        <a class="btn btn-primary review_delete px-1 py-0" onclick="return confirm('レビュー内容を削除します。よろしいですか？')"
                            href="{{ action('Admin\GameController@delete', ['game_id' => $game_info->game_id]) }}">削除</a>
                    </div>
                </div>
            @endforeach
            <div class="game-info-bottom row no-gutters align-items-start m-2">
                <span class="d-flex justify-content-center ml-auto">
                    {{-- ToDo:枠線の色を変える --}}
                    {{ $games_info->links() }}
                </span>
            </div>
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
