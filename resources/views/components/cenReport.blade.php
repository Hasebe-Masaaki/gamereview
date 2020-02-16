{{-- コンテンツセンター（通報一覧）--}}
<div class="game-info-top row no-gutters align-items-start m-2">
    <h5 class="card">{{ $report_count ? '最近の通報記事' : '通報記事がありません' }}</h5>
    <span class="card h5 ml-2">通報 {{ $report_count }} 件</span>
    <span class="d-flex justify-content ml-auto">
        {{-- ToDo:枠線の色を変える --}}
    @if ($report_count > 20)
        {{ $reports_info->links() }}
    @endif
    </span>
</div>
@foreach($reports_info as $report_info)
    <?php $eval = number_format(round($report_info->review->evaluations->avg('review_eval'), 1), 1); ?>
    <div class="row no-gutters mx-2 mx-md-0">
        <div class="offset-md-1">{{ $report_info->updated_at }}</div>
        <div class="ml-2">{{ $report_info->profile->user_name }}</div>
    </div>
    <div class="review-column row no-gutters mb-2 mx-2 mx-md-0">
        <div class="game-point card text-center col-2 offset-md-1 col-md-1">
            <span class="align-middle my-auto">
                <h3>{{ $report_info->review->review_point }}</h3>
            </span>
        </div>
        <div type="button" class="game-review card col-md-9" id="Modal-button"
            data-reviewid="{{ $report_info->review->review_id }}"
            data-point="{{ $report_info->review->review_point }}"
            data-gamelink="{{ action('Admin\GameController@edit', ['game_id' => $report_info->review->game->game_id]) }}"
            data-gametitle="{{ $report_info->review->game->game_title }}"
            data-maker="{{ $report_info->review->game->maker_name }}"
            data-genre="{{ $report_info->review->game->game_genre }}"
            data-date="{{ $report_info->review->game->release_date->format('Y年n月d日') }}"
            data-reviewtitle="{{ $report_info->review->review_title }}"
            data-content="{{ $report_info->review->review_content }}"
            data-image="{{ isset($report_info->review->profile->image_path) ? asset($report_info->review->profile->image_path) : '' }}"
            data-userlink="{{ action('Admin\ProfileController@info', ['user_id' => $report_info->review->profile->user_id]) }}"
            data-user="{{ isset($report_info->review->profile->user_name) ? $report_info->review->profile->user_name : '名もなきレビュアー'}}"
            data-eval="{{ $eval }}"
            data-loginid="{{ Auth::id() }}"
            data-toggle="modal" data-target="#Modal">
                <h5 class="m-0 mt-1 ml-1">{{ Str::limit($report_info->review->game->game_title, 50) }}</h5>
                @if ($report_info->review->spoiler_flg)
                    <p class="text-danger m-0 ml-1">※このレビューはネタバレを含んでいます</p>
                @else
                    <p class="review-title m-0 ml-1">
                        {{ Str::limit($report_info->review->review_title, 60) }}
                    </p>
                @endif
                <div class="text-right m-0 mr-2">
                    <img class="card-image mb-1" src="{{ isset($report_info->review->profile->image_path) ? asset($report_info->review->profile->image_path) : '' }}" alt="👤">
                    <span class="mr-2">{{ isset($report_info->review->profile->user_name) ? $report_info->review->profile->user_name : '名もなきレビュアー' }}</span>
                    <span>このレビューの評価</span>
                    <span class="review_eval">☆{{ $eval }}</span>
                </div>
        </div>
        {{-- @if ($report_info->review->profile->user_id == Auth::id()) --}}
            <div class="col-md-1 my-auto text-center">
                    <!-- <input type="button" class="review_edit mx-auto d-block" value="編集"
                        onclick="location.href='{{ action('ReviewController@edit', ['review_id' => $report_info->review->review_id]) }}'"> -->
                    <a class="btn btn-primary review_delete mb-2 px-1 py-0"
                        href="{{ action('Admin\ReviewController@add', ['review_id' => $report_info->review->review_id]) }}">編集</a>
                    <a class="btn btn-primary review_delete px-1 py-0" onclick="return confirm('レビュー内容を削除します。よろしいですか？')"
                        href="{{ action('Admin\ReviewController@delete', ['review_id' => $report_info->review->review_id]) }}">削除</a>
            </div>
        {{-- @endif --}}

        @include('components.modalReview')
    </div>
@endforeach
<div class="game-info-bottom row no-gutters align-items-start m-2">
    <span class="d-flex justify-content-center ml-auto">
        {{-- ToDo:枠線の色を変える --}}
        @if ($report_count > 20)
            {{ $reports_info->links() }}
        @endif
    </span>
</div>
