$('#Modal').on('show.bs.modal', function (event) {
    // ボタンを取得
    var button = $(event.relatedTarget);

    // data-***の部分を取得
    var reviewId = button.data('reviewid');
    var point = button.data('point');
    var gameTitle = button.data('gametitle');
    var gameLink = button.data('gamelink');
    var maker = button.data('maker');
    var genre = button.data('genre');
    var date = button.data('date');
    var reviewTitle = button.data('reviewtitle');
    var content = button.data('content');
    var image = button.data('image');
    var user = button.data('user');
    var userLink = button.data('userlink');
    var reviewEval = button.data('eval');
    var loginid = button.data('loginid');
    var modal = $(this);

    // 評価値の初期化
    $("#reteit-value").text("-");
    $("#rateit").rateit("reset");

    // csrfトークンを設定
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: '/ajax/getrate',
      type: 'GET',
      dataType: 'text',
      data : {
          review_id : reviewId,
          login_id : loginid
      },
    }).done(function(data){
        /* 通信成功時 */
        $("#reteit-value").text(data);
    }).fail(function(data){
        /* 通信失敗時 */
        // alert('評価を取得できませんでした');
        //console.log("XMLHttpRequest : " + XMLHttpRequest.status);
        //console.log("textStatus     : " + textStatus);
        //console.log("errorThrown    : " + errorThrown.message);
    });
    // モーダルに取得したパラメータを表示
    // 以下ではモーダルのクラス名を取得している
    modal.find('#reviewid-text').text(reviewId);
    modal.find('#point-text').text(point);
    modal.find('#gametitle-text').text(gameTitle);
    modal.find('#gametitle-text').attr('href', gameLink);
    modal.find('#maker-text').text(maker);
    modal.find('#genre-text').text(genre);
    modal.find('#date-text').text(date);
    modal.find('#reviewtitle-text').text(reviewTitle);
    modal.find('#content-text').text(content);
    modal.find('#image').attr('src', image);
    modal.find('#user-text').text(user);
    modal.find('#user-text').attr('href', userLink);
    modal.find('#eval-text').text("☆"+reviewEval);
})
