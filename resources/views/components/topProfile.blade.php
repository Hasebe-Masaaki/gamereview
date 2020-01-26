{{-- コンテンツトップ（プロフィール情報）--}}
<div class="row no-gutters mt-2">
    <div class="mx-2 row no-gutters">
        <h5 class="card">{{ $profile_info->user_name }} さん</h5>
        <div class="reviews-count ml-4">
            <h5 class="card">レビュー投稿: {{ $datas['post_count'] }} 件</h5>
        </div>
        <div class="eval-reviews mx-2">
            <h5 class="card d-inline">総合評価:<a class="review_eval">{{ $datas['eval_ave'] }}</a> [{{ $datas['eval_count'] }}件]</h5>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row no-gutters">
            <div class="col-4 col-md-5">
                <div class="mx-auto my-auto ml-md-3">
                    <img class="profile-image" src="{{ asset('storage/image/'.$profile_info->image_path) }}" alt="👤">
                </div>
            </div>
            <div class="col-8 col-md-7">
                <div class="mx-2 mx-md-0 my-2">
                    <h5 class="card text-center">年齢:{{ $profile_info->age }}</h5>
                </div>
                <div class="mx-2 mx-md-0 my-2">
                    <h5 class="card text-center">性別:{{ $profile_info->gender }}</h5>
                </div>
                <div class="mx-2 mx-md-0 my-2">
                    <h5 class="card text-center">好きなジャンル:<a class="text-center">{{ $profile_info->favorite_genre }}</a></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mt-2 ml-2 row no-gutters">
            <h5 class="card">自己紹介</h5>
        </div>
        <textarea readonly class="card mb-2 mx-2" style="min-width: 95%" rows="3" id="game-summary">{{ Str::limit($profile_info->introduction, 300) }}</textarea>
    </div>
</div>
