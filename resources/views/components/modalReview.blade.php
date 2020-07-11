{{-- ToDo:画面サイズによって文字サイズを変える--}}
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <!--以下modal-dialogのCSSの部分で modal-lgやmodal-smを追加するとモーダルのサイズを変更することができる-->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="reviewid-text">
            <div class="modal-header my-0 pb-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-0">
                <div class="row no-gutters mt-0 mb-2 mx-0">
                    <div class="game-point card text-center col-3 col-md-2 mb-2 mb-md-0">
                        <span class="align-middle my-auto">
                            <h1 id="point-text"></h1>
                        </span>
                    </div>
                    <div class="game-info-top">
                        <div class="game-title row no-gutters">
                            {{-- ToDo:画面サイズによって文字数を変える（JavaScript）--}}
                            <a class="card h5 mb-1 mx-1" id="gametitle-text" href=""></a>
                        </div>
                        <div class="game-info-top-2 row no-gutters">
                            <div class="game-bland">
                                <h5 class="card mb-1 mx-1" id="maker-text"></h5>
                            </div>
                        </div>
                        <div class="game-info-top-2 row no-gutters">
                            <div class="game-genre">
                                <h5 class="card mb-0 mx-1" id="genre-text"></h5>
                            </div>
                            <div class="game-date">
                                <h5 class="card mb-0" id="date-text"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="review-title row no-gutters">
                    <h5 class="card mb-1" id="reviewtitle-text"></h5>
                </div>
                <div class="review-content row no-gutters">
                    <textarea readonly class="card col col-md mb-2" id="content-text" rows="10"></textarea>
                </div>
                <div class="user-info row no-gutters">
                    <div class="card mr-1 mb-1 mb-xs-0 d-inline">
                        <img class="card-image d-inline" id="image" src="" alt="👤">
                        <a class="h5 my-auto d-inline" id="user-text" hrer=""></a>
                    </div>
                    <div class="card d-inline">
                        <h5 class="d-inline">このレビューの評価</h5>
                        <h5 class="review_eval d-inline" id="eval-text"></h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer my-0 pt-0 row no-gutters">
            {{-- Todo:自分以外でログインしていたら評価と通報ボタンを表示 --}}
            @can('user')
                <div class="card mr-auto pr-1 mb-3 mb-md-0 d-flex align-items-center">
                    <div class="text-left">
                        <span class="h5 pr-0">あなたの評価:</span>
                        <span class="ml-0" id="reteit-value"></span>
                        <span class="pt-1" id="rateit" data-rateit-starwidth="19" data-rateit-starheight="19"></span>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" id="report-button">通報する</button>
            @endcan
                <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
