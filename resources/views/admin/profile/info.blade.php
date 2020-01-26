{{-- プロフィール画面 --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="contain-top card mw-100 mh-20 mb-2">
            @include('components.topProfile')
        </div>
        <div class="contain-center card mw-100 mh-70 pb-2">
            @include('components.cenReview', ['admin_flg' => 1, 'review_count' => $datas['post_count']])
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
