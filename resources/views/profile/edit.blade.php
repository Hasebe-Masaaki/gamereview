{{-- プロフィール編集画面 --}}
@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="contain-top card mw-100 mh-20 mb-2">
            @include('components.topProfile')
        </div>
        <div class="contain-center card mw-100 mh-70 pb-2">
            <form action="{{ action('ProfileController@update') }}" method="post" enctype="multipart/form-data" id="form-profadd">
                @csrf
                <input type="hidden" name="user_id" value="{{ $profile_info->user_id }}">
                <div class="form-point mt-2">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">ユーザ名</h5>
                    </div>
                    <div class="row no-gutters">
                        <input type="text" class="form-control ml-4 col-8 col-md-4" name="user_name"
                            value="{{ $profile_info->user_name }}" placeholder="ユーザ名を入力してください">
                    </div>
                </div>
                <div class="form-title mt-3">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">プロフィール画像</h5>
                    </div>
                    <div class="d-flex flex-column ml-4">
                        <div class="form-text text-info ml-3">
                            <img class="profile-image" src="{{ asset('storage/image/'.$profile_info->image_path) }}" alt="👤">
                            <input type="file" class="form-control-file mt-2" name="image">
                        </div>
                        <div class="form-check ml-3">
                            <label class="form-check-label my-auto">
                                <input type="checkbox" class="form-check-input" name="remove" value="true">
                                <label class="form-check-label ml-1 mt-1" for="remove">画像を削除</label>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-age mt-3">
                    <div class="row no-gutters">
                        <h5 class="card mx-2">年齢</h5>
                    </div>
                    <div class="form-checkd-flex ml-3 flex-column">
                        <div class="d-flex flex-column flex-md-row">
                            <div class="ml-4 d-flex">
                                {{-- Todo:外部定義化 --}}
                                {{ Form::radio('age', '10才未満', ($profile_info->age == '10才未満') ? true : false, array('class' => '', 'id' => 'age1')) }}
                                {{ Form::label('age', '10才未満', array('class' => 'h5')) }}
                                {{ Form::radio('age', '10~19才', ($profile_info->age == '10~19才') ? true : false, array('class' => 'ml-3', 'id' => 'age2')) }}
                                {{ Form::label('age', '10~19才', array('class' => 'h5')) }}
                            </div>
                            <div class="ml-4 d-flex">
                                {{ Form::radio('age', '20~29才', ($profile_info->age == '20~29才') ? true : false, array('class' => '', 'id' => 'age3')) }}
                                {{ Form::label('age', '20~29才', array('class' => 'h5')) }}
                                {{ Form::radio('age', '30~39才', ($profile_info->age == '30~39才') ? true : false, array('class' => 'ml-3', 'id' => 'age4')) }}
                                {{ Form::label('age', '30~39才', array('class' => 'h5')) }}
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row">
                            <div class="ml-4 d-flex">
                                {{ Form::radio('age', '40~49才', ($profile_info->age == '40~49才') ? true : false, array('class' => '', 'id' => 'age5')) }}
                                {{ Form::label('age', '40~49才', array('class' => 'h5')) }}
                                {{ Form::radio('age', '50~59才', ($profile_info->age == '50~59才') ? true : false, array('class' => 'ml-3', 'id' => 'age6')) }}
                                {{ Form::label('age', '50~59才', array('class' => 'h5')) }}
                            </div>
                            <div class="ml-4 d-flex">
                                {{ Form::radio('age', '60才以上', ($profile_info->age == '60才以上') ? true : false, array('class' => '', 'id' => 'age7')) }}
                                {{ Form::label('age', '60才以上', array('class' => 'h5')) }}
                                {{ Form::radio('age', 'ないしょ', ($profile_info->age == 'ないしょ') ? true : false, array('class' => 'ml-3', 'id' => 'age8')) }}
                                {{ Form::label('age', 'ないしょ', array('class' => 'h5')) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-gender mt-3">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">性別</h5>
                    </div>
                    <div class="ml-4 d-flex flex-row">
                        <!-- <input type="radio" name="gender" {{ ($profile_info->gender == '男性') ? 'checked="checked"' : '' }}> -->
                        <!-- <input type="radio" name="gender" {{ $profile_info->gender == '男性' ? 'checked' : '' }}> -->
                        {{ Form::radio('gender', '男性', ($profile_info->gender == '男性') ? true : false, array('class' => 'ml-3', 'id' => 'gender1')) }}
                        {{ Form::label('gender', '男性', array('class' => 'h5')) }}
                        {{ Form::radio('gender', '女性', ($profile_info->gender == '女性') ? true : false, array('class' => 'ml-3', 'id' => 'gender2')) }}
                        {{ Form::label('gender', '女性', array('class' => 'h5')) }}
                        {{ Form::radio('gender', 'ないしょ', ($profile_info->gender == 'ないしょ') ? true : false, array('class' => 'ml-3', 'id' => 'gender3')) }}
                        {{ Form::label('gender', 'ないしょ', array('class' => 'h5')) }}
                    </div>
                </div>
                <div class="form-genre mt-3">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">好きなジャンル</h5>
                    </div>
                    <div class="ml-4 d-flex flex-column">
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('favorite_genre', 'ＲＰＧ', ($profile_info->favorite_genre == 'ＲＰＧ') ? true : false, array('class' => '', 'id' => 'genre1')) }}
                            {{ Form::label('favorite_genre', 'ＲＰＧ', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('favorite_genre', 'アクション', ($profile_info->favorite_genre == 'アクション') ? true : false, array('class' => '', 'id' => 'genre2')) }}
                            {{ Form::label('favorite_genre', 'アクション', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('favorite_genre', 'アドベンチャー', ($profile_info->favorite_genre == 'アドベンチャー') ? true : false, array('class' => '', 'id' => 'genre3')) }}
                            {{ Form::label('favorite_genre', 'アドベンチャー', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('favorite_genre', 'シューティング', ($profile_info->favorite_genre == 'シューティング') ? true : false, array('class' => '', 'id' => 'genre4')) }}
                            {{ Form::label('favorite_genre', 'シューティング', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('favorite_genre', 'シミュレーション', ($profile_info->favorite_genre == 'シミュレーション') ? true : false, array('class' => '', 'id' => 'genre5')) }}
                            {{ Form::label('favorite_genre', 'シミュレーション', array('class' => 'h5')) }}
                        </div>
                        <div class="ml-3 d-flex flex-row">
                            {{ Form::radio('favorite_genre', 'スポーツ', ($profile_info->favorite_genre == 'スポーツ') ? true : false, array('class' => '', 'id' => 'genre6')) }}
                            {{ Form::label('favorite_genre', 'スポーツ', array('class' => 'h5')) }}
                        </div>
                    </div>
                </div>
                <div class="form-summary mt-3">
                    <div class="row no-gutters">
                        <h5 class="card mt-2 mx-2">自己紹介</h5>
                    </div>
                    <div class="row no-gutters">
                        <textarea type="text" class="form-control mx-2 mx-md-4" rows="10" name="introduction"
                            placeholder="自己紹介を入力してください">{{ $profile_info->introduction }}</textarea>
                    </div>
                </div>
                <div class="form-submit text-right mt-3">
                    <input type="submit" class="p-2 mx-2 mr-md-4" id="profile-submit" value="プロフィールを更新">
                </div>
            </form>
        </div>
        <div class="contain-bottom card text-center mw-100 mh-10">
            @include('components.bottom')
        </div>
    </div>
@endsection
