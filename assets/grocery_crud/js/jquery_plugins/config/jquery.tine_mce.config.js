tinymce.init({
    selector: 'textarea.texteditor',
    theme: "modern",
    width: 847,
    height: 400,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking fullscreen",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code spellchecker noindex"
    ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect | spellchecker",
    toolbar2: "| link unlink anchor | image media responsivefilemanager | blockquote forecolor backcolor  | print preview code fullscreen noindex",
    image_advtab: true,
    contextmenu: "link image inserttable | cell row column deletetable",
    media_live_embeds: true,
    language: 'ru',
    theme_advanced_resize_horizontal : true,
    external_filemanager_path:"https://polahoda.cz/assets/grocery_crud/texteditor/tiny_mce/filemanager/",
    filemanager_title:"Responsive Filemanager" ,
    external_plugins: { "filemanager" : "plugins/responsivefilemanager/plugin.min.js"},
    spellchecker_languages: "Russian=ru,Ukrainian=uk,English=en",
    spellchecker_rpc_url: "http://speller.yandex.net/services/tinyspell",
    extended_valid_elements : "noindex",
});