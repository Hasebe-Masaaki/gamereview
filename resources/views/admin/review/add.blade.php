{{-- 記事投稿画面（管理者用） --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="contain-top card mw-100 mh-20 mb-2">
            <div class="add-game-info">
                @include('components.topGame')
            </div>
        </div>
        <div class="contain-center card mw-100 mh-70 pb-2">
            @include('components.cenAdd', ['action' => action('Admin\ReviewController@update')])
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
