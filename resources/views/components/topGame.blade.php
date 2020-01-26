{{-- コンテンツトップ（ゲーム情報）--}}
<div class="game-info-top row no-gutters">
    <div class="game-title">
        {{-- ToDo:画面サイズによって文字数を変える（JavaScript）--}}
        <h5 class="card mt-2 mx-2" id="game-title">{{ Str::limit($game_info->game_title, 80)}}</h5>
    </div>
</div>
<div class="game-info-top-2 row no-gutters">
    <div class="game-bland">
        <h5 class="card mb-2 mx-2" id="maker-name">{{ Str::limit($game_info->maker_name, 30) }}</h5>
    </div>
</div>
<div class="game-info-top-2 row no-gutters">
    <div class="game-genre">
        <h5 class="card mb-2 mx-2" id="game-genre">{{ Str::limit($game_info->game_genre, 30) }}</h5>
    </div>
    <div class="game-date">
        <h5 class="card mb-2 mx-2" id="release-date">{{ isset($game_info->release_date) ? $game_info->release_date->format('Y年n月d日') : '発売日' }}</h5>
    </div>
    <div class="review-num col-8 col-md-4 ml-md-auto ml-2">
        <h5 class="card mb-2 mr-2" id="review-count">レビュー件数: {{ $datas['review_count'] }} 件</h5>
    </div>
</div>
<div class="game-info-bottom row no-gutters">
    <div class="game-summary col-md-8">
        <textarea readonly class="card mb-2 mx-2" style="min-width: 96%" rows="4" id="game-summary">{{ $game_info->game_summary }}</textarea>
    </div>
    <div class="col-md-4">
        <div class="game-point-ave row mb-2 ml-md-0 mx-2 no-gutters">
            <div class="card text-center col py-md-3">
                <p class="my-auto">平均値</p>
                <h2 class="my-auto" id="average">{{ $datas['average'] }}</h2>
            </div>
            <div class="card text-center col py-md-3">
                <p class="trim_ave my-auto">10%トリム</p>
                <h2 class="my-auto" id="trim-ave">{{ $datas['trim_ave'] }}</h2>
            </div>
            <div class="card text-center col py-md-3">
                <p class="my-auto">中央値</p>
                <h2 class="my-auto" id="median">{{ $datas['median'] }}</h2>
            </div>
        </div>
    </div>
</div>
