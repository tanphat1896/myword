/**
 * Created by tanphat on 06/08/2017.
 */
$(function () {
    $('#frm-add-article, #frm-edit-article').submit(function () {
        var content = $('.nicEdit-main').html();
        $('[name="content"]').val(content);
        return true;
    });
});
