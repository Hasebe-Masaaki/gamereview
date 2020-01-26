{{-- ゲーム情報一覧表示画面 --}}
@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="contain-center card mw-100 mh-70 pb-2">
            <div class="game-info-top row no-gutters align-items-start m-2">
                <h5 class="card">ゲームタイトルが {{ $game_count }} 件ヒットしました</h5>
                <span class="d-flex justify-content ml-auto">
                    {{-- ToDo:枠線の色を変える --}}
                    {{ $games_info->links() }}
                </span>
            </div>
            @foreach($games_info as $game_info)
                <div class="game-column row no-gutters mb-2 mx-2 mx-md-0">
                    <div class="game-point-ave offset-md-1 col-6 col-md-3 row no-gutters">
                        <div class="card text-center col py-md-1">
                            <p class="my-auto">平均値</p>
                            <h2 class="my-auto">{{ $datas[$game_info->game_id]['average'] }}</h2>
                        </div>
                        <div class="card text-center col py-md-1">
                            <p class="trim_ave my-auto">トリム</p>
                            <h2 class="my-auto">{{ $datas[$game_info->game_id]['trim_ave'] }}</h2>
                        </div>
                        <div class="card text-center col py-md-1">
                            <p class="my-auto">中央値</p>
                            <h2 class="my-auto">{{ $datas[$game_info->game_id]['median'] }}</h2>
                        </div>
                    </div>
                    <div type="button" class="game-info card col-md-7" onclick="location.href='{{ action('ReviewController@info', ['game_id' => $game_info->game_id]) }}'">
                        <h5 class="m-0 mt-1 ml-1">{{ Str::limit($game_info->game_title, 35) }}</h5>
                        <div class="ml-1">
                            <span class="game-bland mr-1">{{ Str::limit($game_info->maker_name, 25) }}</span>
                            <span class="game-genre mr-1">{{ Str::limit($game_info->game_genre, 15) }}</span>
                            <span class="game-date">{{ $game_info->release_date->format('Y年n月d日') }}</span>
                        </div>
                        <div class="text-right m-0 mr-2">
                            <span class="game-date">レビュー件数: {{ $datas[$game_info->game_id]['review_count'] }} 件</span>
                        </div>
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
