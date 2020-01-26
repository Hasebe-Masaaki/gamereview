{{-- トップ画面 --}}
@extends('layouts.front')

@section('content')
    <div class="container">
        @auth
            <div class="contain-top card mw-100 mh-20 mb-2">
                @include('components.topProfile')
            </div>
        @endauth
        <div class="contain-center card mw-100 mh-70 pb-2">
            @include('components.cenReview', ['admin_flg' => 0, 'review_count' => $datas['review_count']])
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
