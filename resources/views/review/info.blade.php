{{-- ゲーム記事一覧表示画面 --}}
@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="contain-top card mw-100 mh-20 mb-2">
            @include('components.topGame')

            <div class="review-submit mb-2">
                {{-- ToDo:ボタンの色を変える --}}
                <input type="button" class="review_edit mx-auto px-5 d-block" value="このゲームのレビューを投稿"
                    onclick="location.href='{{ action('ReviewController@add', ['game_id' => $game_info->game_id]) }}'">
            </div>
        </div>
        <div class="contain-center card mw-100 mh-70 pb-2">
            @include('components.cenReview', ['admin_flg' => 0, 'review_count' => $datas['review_count']])
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
