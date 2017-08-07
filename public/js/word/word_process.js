/**
 * Created by ngtanphat on 31/7/2017.
 */
$(function () {

    var divShowAllWord = $('#div-show-all-word');
    var nav = $('.navigator');
    $('[data-toggle="tooltip"]').tooltip();
    $('#div-word-meaning').css(
        'height', $(window).height() - $(nav).outerHeight() - $('#div-word').outerHeight() - 100)
    $(divShowAllWord).css('height', $(window).height() - $(nav).outerHeight() - 20)
    $('#link-hide-div-show-word').click(function () {
        toggleDivShowWord(false);
        toggleDivShowAllWord(true);
        return false;
    });

    // $(divShowAllWord).find('a').on('click', function (e) {
    //     e.preventDefault();
    //     $('#div-show-word').show(300);
    //     $(divShowAllWord).hide(0);
    // });

    $(window).resize(function () {
        if ($(window).width() <= 768){
            $('#inp-search-result').removeAttr('size');
        } else {
            $('#inp-search-result').attr('size', '25');
        }
    });

    addEventToWord();

    $('#link-speak-word').click(function (e) {
        e.preventDefault();
        var word = $('#keyword').text();
        responsiveVoice.speak(word, "US English Female");
    });
});

function addEventToWord() {
    $('.word-start-with-char a').on('click', function (e) {
        e.preventDefault();
        var keyword = $(this).text();
        // alert(keyword);
        getWordExplanation(keyword);
    });
}

function getWordExplanation(keyword){
    toggleDivShowAllWord(false);
    toggleDivWordLoading(true);
    $.get(
        "?m=word&a=retrieve&key=" + keyword,
        {}, function (respond) {
            // console.log(respond);
            var result = $.parseJSON(respond);
            if (result.hasOwnProperty('success') && parseInt(result.success) === 1){
                if (result.hasOwnProperty('data') && result.data !== "false"){
                    generateHTMLData(result.keyword, result.data);
                } else {
                    generateHTMLData(false);
                }
            }
        }, 'text'
    ).always(function () {
        toggleDivShowWord(true);
    });
}

function generateHTMLData(keyword, plainExplanation){
    $('#keyword').text(keyword);
    var divWordMeaning = $('#div-word-meaning');
    if (!plainExplanation){
        $('#pronunciation').html('');
        $(divWordMeaning).html("Chưa cập nhật");
        return true;
    }
    var pronunciation = plainExplanation.pronunciation;
    $('#pronunciation').text(pronunciation);
    var explanation = $.parseJSON(plainExplanation.explanation);
    // console.log(explanation);
    var meaningHtml = "";
    // lướt qua danh sách từ loại
    $.each(explanation, function (i, exp) {
        meaningHtml += '<div class="div-word-type">' +
            '<p class="word-type">' + exp.type + '</p>' +
            '<div class="div-word-mean">';
        // lướt qua danh sách nghĩa của từ loại đó
        var meaningList = exp.meaninglist;
        $.each(meaningList, function (i, meaning) {
            meaningHtml += '<p class="word-mean">' + meaning.meaning + '</p>';
            if (typeof meaning.ex !== "undefined"){
                meaningHtml += '<p class="word-example">' + meaning.ex;
                if (typeof meaning.trans !== "undefined")
                    meaningHtml += '<span>' + meaning.trans + '</span></p>';
            }
        });
        meaningHtml += "</div></div";
    });
    $(divWordMeaning).html(meaningHtml);
}


function toggleDivShowWord(isVisible){
    var divShowWord = $('#div-show-word');
    if (!isVisible){
        $(divShowWord).hide();
    } else {
        toggleDivWordLoading(false);
        $(divShowWord).fadeIn(200);
    }
}

function toggleDivWordLoading(isVisible){
    var divWordLoading = $('#div-word-loading');
    if (!isVisible){
        $(divWordLoading).hide();
    } else {
        $(divWordLoading).fadeIn(200);
    }
}

function toggleDivShowAllWord(isVisible){
    var divShowAllWord = $('#div-show-all-word');
    if (!isVisible){
        $(divShowAllWord).hide();
    } else {
        toggleDivWordLoading(false);
        $(divShowAllWord).fadeIn(200);
    }
}