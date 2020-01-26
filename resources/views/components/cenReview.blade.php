{{-- コンテンツセンター（レビュー一覧）--}}
<?php $action_game = $admin_flg ? 'Admin\GameController@edit' : 'ReviewController@info'; ?>
<?php $action_profile = $admin_flg ? 'Admin\ProfileController@info' : 'ProfileController@info'; ?>
<div class="game-info-top row no-gutters align-items-start m-2">
    <h5 class="card">{{ $review_count ? '最近のレビュー' : 'レビューが投稿されていません' }}</h5>
    <span class="d-flex justify-content ml-auto">
        {{-- ToDo:枠線の色を変える --}}
    @if ($review_count > 20)
        {{ $reviews_info->appends($append)->links() }}
    @endif
    </span>
</div>
@foreach($reviews_info as $review_info)
    <?php $eval = number_format(round($review_info->evaluations->avg('review_eval'), 1), 1); ?>
    @if ($admin_flg)
        <div class="row no-gutters mx-2 mx-md-0">
            <div class="offset-md-1">{{ $review_info->updated_at }}</div>
        </div>
    @endif
    <div class="review-column row no-gutters mb-2 mx-2 mx-md-0">
        <div class="game-point card text-center col-2 offset-md-1 col-md-1">
            <span class="align-middle my-auto">
                <h3>{{ $review_info->review_point }}</h3>
            </span>
        </div>
        <div type="button" class="game-review card col-md-9" id="Modal-button"
            data-reviewid="{{ $review_info->review_id }}"
            data-point="{{ $review_info->review_point }}"
            data-gamelink="{{ action($action_game, ['game_id' => $review_info->game->game_id]) }}"
            data-gametitle="{{ $review_info->game->game_title }}"
            data-maker="{{ $review_info->game->maker_name }}"
            data-genre="{{ $review_info->game->game_genre }}"
            data-date="{{ $review_info->game->release_date->format('Y年n月d日') }}"
            data-reviewtitle="{{ $review_info->review_title }}"
            data-content="{{ $review_info->review_content }}"
            data-image="{{ isset($review_info->profile->image_path) ? asset('storage/image/'.$review_info->profile->image_path) : '' }}"
            data-userlink="{{ action($action_profile, ['user_id' => $review_info->profile->user_id]) }}"
            data-user="{{ isset($review_info->profile->user_name) ? $review_info->profile->user_name : '名もなきレビュアー'}}"
            data-eval="{{ $eval }}"
            data-loginid="{{ Auth::id() }}"
            data-toggle="modal" data-target="#Modal">
                <h5 class="m-0 mt-1 ml-1">{{ Str::limit($review_info->game->game_title, 40) }}</h5>
                @if ($review_info->spoiler_flg)
                    <p class="text-danger m-0 ml-1">※このレビューはネタバレを含んでいます</p>
                @else
                    <p class="review-title m-0 ml-1">
                        {{ Str::limit($review_info->review_title, 50) }}
                    </p>
                @endif
                <div class="text-right m-0 mr-2">
                    <img class="card-image mb-1" src="{{ isset($review_info->profile->image_path) ? asset('storage/image/'.$review_info->profile->image_path) : '' }}" alt="👤">
                    <span class="mr-2">{{ isset($review_info->profile->user_name) ? $review_info->profile->user_name : '名もなきレビュアー' }}</span>
                    <span>このレビューの評価</span>
                    <span class="review_eval">☆{{ $eval }}</span>
                </div>
        </div>
        {{-- ログインユーザのみ編集、削除ボタンを表示 --}}
        @if ($review_info->profile->user_id == Auth::id() || $admin_flg)
            <div class="col-md-1 my-auto text-center">
                    <!-- <input type="button" class="review_edit mx-auto d-block" value="編集"
                        onclick="location.href='{{ action('ReviewController@edit', ['review_id' => $review_info->review_id]) }}'"> -->
                    <a class="btn btn-primary review_delete mb-2 px-1 py-0"
                        href="{{ action('ReviewController@add', ['game_id' => $review_info->game->game_id]) }}">編集</a>
                    <a class="btn btn-primary review_delete px-1 py-0" onclick="return confirm('レビュー内容を削除します。よろしいですか？')"
                        href="{{ action('ReviewController@delete', ['review_id' => $review_info->review_id]) }}">削除</a>
            </div>
        @endif

        @include('components.modalReview')
    </div>
@endforeach
<div class="game-info-bottom row no-gutters align-items-start m-2">
    <span class="d-flex justify-content-center ml-auto">
        {{-- ToDo:枠線の色を変える --}}
        @if ($review_count > 20)
            {{ $reviews_info->appends($append)->links() }}
        @endif
    </span>
</div>
