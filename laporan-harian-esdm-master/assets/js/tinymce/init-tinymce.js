function init_master_tinymce(textarea_selector = "textarea.tinymce") {
  tinymce.init({
    selector: textarea_selector,
    height: 200,
    menubar: false,
    plugins: [
      "advlist autolink lists charmap preview hr pagebreak",
      "searchreplace wordcount visualblocks visualchars fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons paste textcolor"
    ],
    toolbar1: "insert | undo redo | bold italic | bullist numlist outdent indent | table",
  });
}

init_master_tinymce();