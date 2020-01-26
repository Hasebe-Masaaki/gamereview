{{-- トップ画面 --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
            <div class="contain-top card mw-100 mh-20 mb-2">
                <div class="admin-top row no-gutters m-2">
                    <a class="btn btn-primary py-5 col-3" href="{{ action('Admin\GameController@info') }}">ゲーム情報編集</a>
                    <a class="btn btn-primary ml-2 py-5 col-3" href="{{ action('Admin\ReviewController@info') }}">記事編集</a>
                </div>
            </div>
        <div class="contain-center card mw-100 mh-70 pb-2">
            @include('components.cenReport', ['report_count' => $datas['report_count']])
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
