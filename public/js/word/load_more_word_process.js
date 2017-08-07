$(function () {
    $('#btn-load-more-word').click(function (e) {
        e.preventDefault();
        $('#btn-load-more-word').hide();
        $('#img-load-more-word-loading').show();
        getMoreWord();
    });
});

function getMoreWord() {
    var currentPage = $('#load-more-current-page').val();
    var url = "?m=word&a=list&type=norm&p=" + currentPage;
    $.get(
        url,
        function (respond) {
            var result = $.parseJSON(respond);
            // console.log(result);
            if (result.hasOwnProperty('success') && parseInt(result.success) === 1){
                if (result.hasOwnProperty('data') && result.hasOwnProperty('page'))
                    updateNewWord(result.data, result.page);
            }
        },
        "text"
    ).always(function () {
        $('#img-load-more-word-loading').hide();
        addEventToWord();
    });
}

function updateNewWord(listWord, page){
    var html = "";
    $.each(listWord, function (i, word) {
        html += "<div class=\"col-sm-4 word-start-with-char\"><a href=\"\">" + word.keyword +  "</a></div>";
    });
    $('#div-store-all-word').append(html);

    if (parseInt(page) === -1){
        $('#btn-load-more-word').hide();
        return true;
    }
    $('#load-more-current-page').val(page);
    $('#btn-load-more-word').show();
}