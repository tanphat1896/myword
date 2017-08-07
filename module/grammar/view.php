<?php
/**
 * Created by PhpStorm.
 * User: tanphat
 * Date: 06/08/2017
 * Time: 17:15
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
?>

<?php require_once MODULE_PATH . '/widget/header.php'; ?>

<div class="container">
	<div class="row">
		<div class="col-sm-10">
			<h3 class="text-danger"><?php echo $title; ?></h3>
		</div>
		<div class="col-sm-2 text-right" style="margin-top: 17px">
			<a class="btn btn-default btn-sm" href="?m=grammar" data-toggle="tooltip" title="Quay lại">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
            <?php
            if (loggedIn())
                echo '<a class="btn btn-default btn-sm" href="?m=grammar&a=edit&id=' . $id . '" data-toggle="tooltip" title="Chỉnh sửa">
				          <span class="glyphicon glyphicon-edit"></span>
			          </a>';
            ?>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-sm-12">
			<?php echo $content; ?>
		</div>
	</div>
</div>

<?php require_once MODULE_PATH . '/widget/footer.php'; ?>
