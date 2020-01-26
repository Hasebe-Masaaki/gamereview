$('#form-gameadd').submit(function(event) {
  if (!confirm("ゲーム情報を更新します。よろしいですか？")) {
      event.preventDefault();
  }
});
