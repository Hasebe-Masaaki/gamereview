{{-- プロフィール画面 --}}
@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="contain-top card mw-100 mh-20 mb-2">
            @include('components.topProfile')
            {{-- ログインユーザのみプロフィール編集ボタンを表示 --}}
            @if ($profile_info->user_id == Auth::id())
                <input type="button" class="review_edit mx-auto mb-2 px-5 d-block" value="プロフィールを編集"
                    onclick="location.href='{{ action('ProfileController@edit', ['user_id' => $profile_info->user_id]) }}'">
            @endif
        </div>
        <div class="contain-center card mw-100 mh-70 pb-2">
            @include('components.cenReview', ['admin_flg' => 0, 'review_count' => $datas['post_count']])
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
