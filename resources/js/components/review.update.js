$('#title-search').autocomplete({
    source: function(req, resp){

        // csrfトークンを設定
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
          url:'/ajax/autocomp',
          type:'POST',
          cache:false,
          dataType:'json',
          data:{
              str:req.term
          }
        }).done(function(o){
            /* 通信成功時 */
            resp(o.data);
        }).fail(function(o){
            /* 通信失敗時 */
            resp(['']);
        });
    },
    select: function( event, ui ){

      // csrfトークンを設定
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url:'/ajax/select',
        type:'POST',
        dataType:'json',
        data:{
            str:ui.item
        }
      }).done(function(data){
          /* 通信成功時 */
          $("#game-id").val(data.game_id);
          $("#game-title").text(data.game_title);
          $("#maker-name").text(data.maker_name);
          $("#game-genre").text(data.game_genre);
          $("#release-date").text(data.release_date);
          $("#review-count").text("レビュー件数: "+data.review_count+" 件");
          $("#game-summary").text(data.game_summary);
          $("#average").text(data.average);
          $("#trim-ave").text(data.trim_ave);
          $("#median").text(data.median);
          $("#review-id").val(data.review_id);
          $("#review-point").val(data.review_point);
          $("#review-title").val(data.review_title);
          $("#review-content").val(data.review_content);
          $("#spoiler-flg").prop('checked', data.spoiler_flg);
          if(data.submit_flg) {
            $("#review-submit").val('レビュー内容を更新');
          }
      }).fail(function(data){
          /* 通信失敗時 */
      });
    },
    //ここにAutocompleteのオプションを設定
    delay: 0,
});

$('#form-add').submit(function(event) {
  if (!confirm("レビュー内容を登録します。よろしいですか？")) {
      event.preventDefault();
  }
});

// $('.review_delete').on('click', function(event) {
//   if (!confirm("レビュー内容を削除します。よろしいですか？")) {
//       return false;
//   }
// });
