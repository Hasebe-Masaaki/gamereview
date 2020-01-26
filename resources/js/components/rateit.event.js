$(function() {
    // RateItの設定 ...（2）
    $("#rateit").rateit();
});

// 評価値を確定した時
$("#rateit").on("rated", function(){
    var evaluation = parseFloat($("#rateit").rateit("value"));
    var rid = $("#reviewid-text").text();

    // csrfトークンを設定
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: '/ajax/rateit',
      type: 'POST',
      dataType: 'text',
      data : {
          review_id : rid,
          review_eval : evaluation
      }
    }).done(function(data){
        /* 通信成功時 */
        alert('評価を反映しました');
        $("#reteit-value").text("☆"+evaluation.toFixed(1));
    }).fail(function(data){
        /* 通信失敗時 */
        alert('評価を反映できませんでした');
        //console.log("XMLHttpRequest : " + XMLHttpRequest.status);
        //console.log("textStatus     : " + textStatus);
        //console.log("errorThrown    : " + errorThrown.message);
    });
});

// 評価値を確定する直前
$("#rateit").on("beforerated", function(event, value){
    //$("#msg3").text("event: beforerated, value= " + value);
    // confirmでキャンセルした時にはイベントをなかったことに
    if (!confirm("評価を"+ value + "に変更します。よろしいですか？")) {
        event.preventDefault();
    }
});
