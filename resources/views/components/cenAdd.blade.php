{{-- コンテンツセンター（レビュー投稿）--}}
<form action="{{ $action }}" method="post" id="form-add">
    @csrf
    <input type="hidden" id="review-id" name="review_id" value="{{ $review_info->review_id }}">
    <input type="hidden" id="game-id" name="game_id" value="{{ $game_info->game_id }}">
    <div class="form-point mt-2">
        <div class="row no-gutters">
            <h5 class="card mt-2 mx-2">点数</h5>
        </div>
        <div class="row no-gutters">
            <input type="text" class="form-control mx-2 ml-md-4 col-2 col-md-1" id="review-point" name="review_point"
                value="{{ isset($review_info->review_point) ? $review_info->review_point : old('review_point') }}" placeholder="0~100">
        </div>
    </div>
    <div class="form-title mt-3">
        <div class="row no-gutters">
            <h5 class="card mt-2 mx-2">レビュータイトル</h5>
        </div>
        <div class="row no-gutters">
            <input type="text" class="form-control mx-2 ml-md-4 col-md-8" id="review-title" name="review_title"
                value="{{ isset($review_info->review_title) ? $review_info->review_title : old('review_title') }}" placeholder="レビュータイトルを入力してください">
        </div>
    </div>
    <div class="form-summary mt-3">
        <div class="row no-gutters">
            <h5 class="card mt-2 mx-2">レビュー内容</h5>
        </div>
        <div class="row no-gutters">
            <textarea type="text" class="form-control mx-2 mx-md-4" rows="10" id="review-content" name="review_content"
                placeholder="レビュー内容を入力してください">{{ isset($review_info->review_content) ? $review_info->review_content : old('review_content') }}</textarea>
        </div>
    </div>
    <div class="form-spoiler mt-3">
        <div class="row no-gutters">
            <h5 class="card mt-2 mx-2">ネタバレチェック</h5>
        </div>
        <div class="form-check mx-2 ml-md-4">
          <input class="form-check-input" type="checkbox" id="spoiler-flg" name="spoiler_flg"
            value="1" {{ $review_info->spoiler_flg ? 'checked="checked"' : '' }}>
          <label class="form-check-label ml-1 mt-1 text-danger font-weight-bold" for="spoiler-flg">※ネタバレを含む場合にチェックしてください</label>
        </div>
    </div>
    <div class="form-submit text-right mt-3 mt-md-0">
        <input type="submit" class="p-2 mx-2 mr-md-4" id="review-submit"
            value="{{ isset($review_info->review_id) ? 'レビュー内容を更新' : 'レビューを投稿' }}">
    </div>
</form>
