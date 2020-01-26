// 通報ボタンを押したとき
$('#report-button').on('click', function() {
    var rid = $("#reviewid-text").text();

    if (!confirm("ネタバレまたは不適切な記事として通報します。よろしいですか？")) {
      event.preventDefault();
    }
    else {
      // csrfトークンを設定
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url: '/ajax/report',
        type: 'POST',
        dataType: 'text',
        data : {
            review_id : rid
        }
      }).done(function(data){
          /* 通信成功時 */
          alert('通報を受付しました');
      }).fail(function(data){
          /* 通信失敗時 */
          alert('通報を受付できませんでした');
          //console.log("XMLHttpRequest : " + XMLHttpRequest.status);
          //console.log("textStatus     : " + textStatus);
          //console.log("errorThrown    : " + errorThrown.message);
      });
    }
});
