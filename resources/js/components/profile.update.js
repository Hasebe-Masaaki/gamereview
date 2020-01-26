$('#form-profadd').submit(function(event) {
  if (!confirm("プロフィールを更新します。よろしいですか？")) {
      event.preventDefault();
  }
});
