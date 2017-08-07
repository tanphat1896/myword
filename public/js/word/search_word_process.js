/**
 * Created by tanphat on 31/07/2017.
 */

$(function () {
    var inpSearchWord = $('#inp-search-word');
    var delay = null;
    $(inpSearchWord).keyup(function () {
        $('#search-loading').fadeIn(100);
        clearTimeout(delay);
        delay = setTimeout(function () {
            sendInputData($(inpSearchWord).val().trim());
        }, 100);
    });

    $('#inp-search-result').change(function () {
        toggleDivShowWord(false);
        getWordExplanation($(this).val());
    });
});

function sendInputData(inputString){
    $.get("?m=word&a=list&type=search&str=" + inputString,
        {},
        function (respond) {
            var result = $.parseJSON(respond);
            if (result.hasOwnProperty('success') && parseInt(result.success) === 1){
                if (result.hasOwnProperty('data'))
                    fillDataToSearchResult(result.data);
            }
        },
        "text"
    ).always(function () {
        $('#search-loading').hide();
    });
}

function fillDataToSearchResult(listWord){
    var optionHtml = "";
    $.each(listWord, function (i, word) {
        optionHtml += "<option value='" + word.keyword + "'>" + word.keyword + "</option>";
    });
    $('#inp-search-result').html(optionHtml);
}
