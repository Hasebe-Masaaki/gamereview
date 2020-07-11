{{-- 記事投稿画面 --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="contain-top card mw-100 mh-20 mb-2">
            <div class="row mt-2 mx-2">
                <h5 class="card mt-1">投稿するゲーム</h5>
                <input type="text" class="mx-2 form-control col-md-6" id="title-search"
                    value="{{ isset($game_info->game_id) ? $game_info->game_title : '' }}" placeholder="タイトルを入力してください">
            </div>
            <div class="border border-primary m-2"></div>
            <div class="add-game-info">
                @include('components.topGame')
            </div>
        </div>
        <div class="contain-center card mw-100 mh-70 pb-2">
            @include('components.cenAdd', ['action' => action('ReviewController@create')])
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
