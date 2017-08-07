<?php
/**
 * Created by PhpStorm.
 * User: tanphat
 * Date: 06/08/2017
 * Time: 18:39
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

$id = getGETValue('id');
if (empty($id))
    redirect("?m=grammar");

require_once SYSTEM_PATH . '/db/GrammarDataProvider.php';
$grammarDP = GrammarDataProvider::getInstance();

$title = $grammarDP->getArticleTitle($id);
$content = $grammarDP->getArticleContent($id);
if (isSubmit('save')){
	$title = getPOSTValue('title');
	$content = getPOSTValue('content');
	if ($grammarDP->updateArticle($id, $title, $content))
		redirect("?m=grammar&a=view&id=$id");
	echo "<script>alert('Lưu thất bại');</script>";
}

?>

<?php require_once MODULE_PATH . '/widget/header.php'; ?>
<script src="<?php echo $GLOBALS['baseUrl']; ?>/public/js/nicEdit.js"></script>
<script>
    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>

<div class="container" id="div-edit-article">
    <div class="row">
        <div class="col-sm-11"><h3 class="text-danger">Sửa bài</h3></div>
        <div class="col-sm-1">
            <a href="?m=grammar" style="margin-top: 17px" class="btn btn-default btn-sm">
                <i class="glyphicon glyphicon-chevron-left"></i>
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <form method="post" id="frm-edit-article">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control" required name="title" value="<?php echo $title; ?>">
                </div>
                <div class="form-group">
                    <label for="">Nội dung </label>
                    <input type="hidden" value="" name="content">
                    <textarea name="" id="" rows="20" class="form-control"><?php echo $content; ?></textarea>
                </div>
                <div class="form-group text-right">
                    <input type="hidden" value="save" name="request_name">
                    <button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-ok"></span> Lưu lại</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once MODULE_PATH . '/widget/footer.php'; ?>
