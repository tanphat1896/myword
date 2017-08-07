<?php
/**
 * Created by PhpStorm.
 * User: tanphat
 * Date: 06/08/2017
 * Time: 15:54
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');


require_once SYSTEM_PATH . '/db/GrammarDataProvider.php';
$baseUrl = $GLOBALS['baseUrl'];

$grammarDP = GrammarDataProvider::getInstance();

$listArticle = $grammarDP->getListArticleTitle();
?>

<?php require_once MODULE_PATH . '/widget/header.php'; ?>

<div class="container div-article">
	<h3 class="text-danger">Danh sách bài viết
    <?php
    if (loggedIn()){
        echo "<a class='close' href='?m=grammar&a=add' data-toggle='tooltip' title='Thêm mới'><span class='glyphicon glyphicon-plus'></span></a>";
    }
    ?>
    </h3>
	<hr>
	<?php
	foreach ($listArticle as $article){
	?>
		<div class="col-sm-6 article">
			<a href="?m=grammar&a=view&id=<?php echo $article['id']; ?>" class="article-title">
				<?php echo $article['title']; ?>
			</a>
		</div>
	<?php } ?>
</div>
<?php require_once MODULE_PATH . '/widget/footer.php'; ?>
