/**
 * Created by tanphat on 31/07/2017.
 */

$(function () {
    var inpSearchWord = $('#inp-search-word');
    var delay = null;
    $(inpSearchWord).keyup(function () {
        clearTimeout(delay);
        delay = setTimeout(function () {
            sendInputData($(inpSearchWord).val().trim());
        }, 500);
    });

    $('#inp-search-result').change(function () {
        getWordExplanation($(this).val());
    });
});

function sendInputData(inputString){
    // console.log(inputString);
    $.get("?m=word&a=list&type=search&str=" + inputString,
        {},
        function (respond) {
            var result = $.parseJSON(respond);
            // console.log(result);
            if (result.hasOwnProperty('success') && parseInt(result.success) === 1){
                // console.log("ok");
                if (result.hasOwnProperty('data'))
                    fillDataToSearchResult(result.data);
            }
        },
        "text"
    );
}

function fillDataToSearchResult(listWord){
    // console.log(listWord);
    var optionHtml = "";
    $.each(listWord, function (i, word) {
        optionHtml += "<option value='" + word.keyword + "'>" + word.keyword + "</option>";
    });
    $('#inp-search-result').html(optionHtml);
    // console.log(optionHtml);
}
