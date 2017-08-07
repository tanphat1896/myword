/**
 * Created by tanphat on 01/08/2017.
 */
$(function () {
    addActionAfter();

    generateIPASpecialChar();

    $('#link-add-word').click(function (e) {
        $('.nav-btn').find('a').removeClass('active');
    });

    $('#btn-add-new-word-type').click(function (e) {
        e.preventDefault();
        var htmlExplanation = '<div class="row explanation">\n' +
            '<div class="col-sm-12 form-group" >\n' +
            '<label>Word Type</label>\n' +
            '<select name="word-type" class="form-control">\n' +
            '<option value="">Cụm từ</option>\n' +
            '<option value="">Danh từ</option>\n' +
            '<option value="">Động từ</option>\n' +
            '<option value="">Nội động từ</option>\n' +
            '<option value="">Ngoại động từ</option>\n' +
            '<option value="">Giới từ</option>\n' +
            '<option value="">Liên từ</option>\n' +
            '<option value="">Tính từ</option>\n' +
            '<option value="">Phó từ</option>\n' +
            '<option value="">Thán từ</option>\n' +
            '</select>\n' +
            '</div>\n' +
            '<div class="meaning-list">\n' +
            '<div class="meaning-and-example">\n' +
            '<div class="col-sm-6">\n' +
            '<input type="text" name="meaning" placeholder="Meaning" required class="form-control">\n' +
            '</div>\n' +
            '<div class="col-sm-6">\n' +
            '<input type="text" name="ex" placeholder="Example" class="form-control example">\n' +
            '</div>\n' +
            '</div>\n' +
            '</div>\n' +
            '<div class="col-sm-12">\n' +
            '<button class="btn btn-danger btn-sm btn-add-example" data-toggle="tooltip" title="Add meaning">\n' +
            '<span class="glyphicon glyphicon-plus-sign"></span> Add Meaning\n' +
            '</button>\n' +
            '</div>\n' +
            '</div>';
        if ($('#div-add-new-word').find('form').append(htmlExplanation).find('.explanation').length >= 4)
            $(this).hide();
        $('body').scrollTop($('body').height());
        addActionAfter();
    });

    $('.btn-ipa-spec-char').on('click', function (e) {
        e.preventDefault();
        var pronunc = $('#pronunciation');
        $(pronunc).val($(pronunc).val() + $(this).text());
        $(pronunc).focus();
    });

    $('#btn-save-word').click(function () {
        $('#frm-add-new-word').submit();
    });

    $('#frm-add-new-word').submit(function (e) {
        var keyword = $('#keyword').val().trim();
        if (keyword.length < 0){
            alert("Nhập key word");
            return false;
        }
        var pronunciation = $('#pronunciation').val().trim();
        if (pronunciation.length > 0)
            pronunciation = "/" + pronunciation + "/";
        e.preventDefault();
        var explanationJSON = "[";
        var explainList = $('.explanation');
        $.each(explainList, function (i, explain) {
            var wordType = $(explain).find('[name="word-type"]').find('option:selected').text();
            explanationJSON += '{"type": "' + wordType + '",';
            var meaningList = $(explain).find('.meaning-and-example');
            explanationJSON += '"meaninglist": [';
            $.each(meaningList, function (i, mae) {
                var meaning = $(mae).find('[name="meaning"]').val();
                var ex = $(mae).find('[name="ex"]').val();
                if (meaning.trim().length > 0)
                    if (ex.trim().length > 0)
                        explanationJSON += '{"meaning":"' + meaning + '", "ex":"' + ex + '"},';
                    else explanationJSON += '{"meaning":"' + meaning + '"},';
            });
            if (explanationJSON.charAt(explanationJSON.length-1) === ",")
                explanationJSON = explanationJSON.substring(0, explanationJSON.length - 1);
            explanationJSON += ']},';
        });

        if (explanationJSON.charAt(explanationJSON.length-1) === ",")
            explanationJSON = explanationJSON.substring(0, explanationJSON.length - 1);
        explanationJSON += "]";
        sendRequestAddNewWord(keyword, pronunciation, explanationJSON);
    });
});

function generateIPASpecialChar(){
    var specChar = ['θ', 'ð', 'ŋ', 'æ', 'ʌ', 'ʒ', 'ʧ', 'ɔ', 'ɒ', 'ɜ', 'ə', 'ʊ', 'ʤ', 'ʃ'];
    var html = "<div class='btn-group btn-group-sm'>";
    for (var i = 0; i < specChar.length; i++){
        html += "<button class='btn btn-default btn-ipa-spec-char'>" + specChar[i] + "</button>";
    }
    html += "</div>";
    $('#div-ipa-char').html(html);
}

function addActionAfter() {
    $('.btn-add-example').not('.added').on('click', function (e) {
        e.preventDefault();
        var htmlMeaningEx = '<div class="meaning-and-example">\n' +
            '<div class="col-sm-6">\n' +
            '<input type="text" name="meaning" placeholder="Meaning" required class="form-control">\n' +
            '</div>\n' +
            '<div class="col-sm-6">\n' +
            '<input type="text" name="ex" placeholder="Example" class="form-control example">\n' +
            '</div>\n' +
            '</div>';
        $(this).parent().parent().children('.meaning-list').append(htmlMeaningEx);
        // console.log($(this).parent().parent());
        if ($(this).parent().parent().find('.meaning-list').children().length >= 3)
            $(this).hide();
        // console.log(this);
    });
}

function sendRequestAddNewWord(keyword, pronunciation, explanationJSON) {
    $.post(
        "?m=word&a=add",
        {
            keyword: keyword,
            pronunciation: pronunciation,
            expJSON: explanationJSON
        },
        function (respond) {
            var result = $.parseJSON(respond);
            if (result.hasOwnProperty('success') && parseInt(result.success) === 1)
                alert("Thêm thành công");
            else alert("Thêm thất bại");
            window.location.reload();
        },
        "text"
    );
}
