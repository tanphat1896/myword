<?php
/**
 * Created by PhpStorm.
 * User: ngtanphat
 * Date: 31/7/2017
 * Time: 4:57 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === "xmlhttprequest"){
    require_once SYSTEM_PATH . '/helper/common_helper.php';
    $keyword = getPOSTValue('keyword');
    $pronunc = getPOSTValue('pronunciation');
    $expJSON = getPOSTValue('expJSON');

    require_once SYSTEM_PATH . '/db/WordDataProvider.php';
    $wordDP = WordDataProvider::getInstance();
    if ($wordDP->addNewWord($keyword, $pronunc, $expJSON)){
        die('{"success": "1"}');
    } else
        die('{"success": "0"}');
}

$baseUrl = isset($GLOBALS['config']['baseUrl']) ? $GLOBALS['config']['baseUrl']: '';
if (empty($baseUrl))
	die("Website not found!!");
?>

<?php require_once MODULE_PATH . '/widget/header.php';?>
<script src="<?php echo $baseUrl; ?>/public/js/word/add_word_process.js"></script>
<script>
    $(function(){
        $('.nav-btn').find('a').removeClass('active');
    });
</script>
<div class="container" id="div-add-new-word">
    <h3 class="text-danger">Thêm mới</h3>
    <hr>
	<form method="post" id="frm-add-new-word">
		<div class="row">
			<div class="col-sm-4 form-group">
				<label for="keyword">Keyword</label>
				<input type="text" class="form-control" required id="keyword">
			</div>
			<div class="col-sm-4 form-group">
				<label for="pronunciation">Phát âm</label>
				<input type="text" class="form-control" required id="pronunciation">
			</div>
			<div class="col-sm-4">
				<label for="">Ký tự đặc biệt</label>
				<div id="div-ipa-char">

				</div>
			</div>
		</div>
		<h3 class="text-danger">Giải thích</h3>
		<div class="row explanation">
			<div class="col-sm-12 form-group" >
				<label>Từ loại</label>
				<select name="word-type" class="form-control">
					<option value="">Cụm từ</option>
					<option value="">Danh từ</option>
					<option value="">Động từ</option>
					<option value="">Nội động từ</option>
					<option value="">Ngoại động từ</option>
					<option value="">Giới từ</option>
					<option value="">Liên từ</option>
					<option value="">Tính từ</option>
					<option value="">Phó từ</option>
					<option value="">Thán từ</option>
				</select>
			</div>
			<div class="meaning-list">
				<div class="meaning-and-example">
					<div class="col-sm-6">
						<input type="text" name="meaning" placeholder="Meaning" required class="form-control">
					</div>
					<div class="col-sm-6">
						<input type="text" name="ex" placeholder="Example" class="form-control example">
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<button class="btn btn-danger btn-sm btn-add-example" data-toggle="tooltip" title="Add meaning">
					<span class="glyphicon glyphicon-plus-sign"></span> Thêm nghĩa
				</button>
			</div>
		</div>
	</form>

	<div class="row">
		<div class="col-sm-6">
			<button class="btn btn-danger" id="btn-add-new-word-type">Thêm từ loại</button>
		</div>
		<div class="col-sm-6 text-right">
			<button class="btn btn-success" type="submit" id="btn-save-word">
                <span class="glyphicon glyphicon-ok-sign"></span> Lưu lại
            </button>
		</div>
	</div>

</div>

<?php require_once MODULE_PATH . '/widget/footer.php';?>
