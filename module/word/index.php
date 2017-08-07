<?php
/**
 * Created by PhpStorm.
 * User: ngtanphat
 * Date: 31/7/2017
 * Time: 4:16 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

require_once SYSTEM_PATH . '/db/WordDataProvider.php';
$wordDP = WordDataProvider::getInstance();

$total = $wordDP->getTotalWord();

$pagerConfig = isset($GLOBALS['glConfig']['pagination']) ? $GLOBALS['glConfig']['pagination']: false;

if (empty($pagerConfig))
    $listWord = $wordDP->getListWord();
else {
    $limit = isset($pagerConfig['limit']) ? (int)$pagerConfig['limit']: 0;
    $listWord = $wordDP->getListWord(0, $limit + 1);
}

$size = count($listWord);
$haveLoadAll = $size <= $limit;

unset($listWord[$size-1]);

require_once MODULE_PATH . '/widget/header.php';
?>
<script src="<?php echo $baseUrl; ?>/public/js/responsivevoice.js"></script>
<!--phần nội dung-->
<div class="container-fluid" id="div-search-word">
    <div class="col-sm-3" id="div-search-engine">
        <form id="frm-search-word">
            <div class="form-group">
                <label>Look up: </label><span id="search-loading" class="text-danger" style="display: none; font-size: 13px;">
                    <img src="<?php echo $baseUrl; ?>/public/loading-mini.gif" alt="Đang tải" height="25px">
                </span>
                <input type="text" id="inp-search-word" class="form-control">
            </div>
            <div class="form-group">
                <select id="inp-search-result" size="25" class="form-control">
                </select>
            </div>
        </form>
    </div>

    <!--        phần giải thích-->
    <div class="col-sm-9" style="display: none;" id="div-show-word">
        <div id="div-word">
            <h3>
                <a href="#" data-toggle="tooltip" title="Trở về" class="" id="link-hide-div-show-word">
                    &laquo;<!-- <span class="glyphicon glyphicon-chevron-left"></span> -->
                </a> &nbsp;
                <span class="text-primary" id="keyword">word</span>
                <span class="text-danger" id="pronunciation">/ə,kɔmə'dei∫n/</span>
                <a href="" id="link-speak-word">
                    <span class="glyphicon glyphicon-volume-up"></span></a>
            </h3>
            <hr>
        </div>
        <div id="div-word-meaning">
<!--            <div class="div-word-type">-->
<!--                <p class="word-type">Danh từ</p>-->
<!--                <div class="div-word-mean">-->
<!--                    <p class="word-mean">từ</p>-->
<!--                    <p class="word-example">translate word to word</p>-->
<!--                </div>-->
<!--                <div class="div-word-mean">-->
<!--                    <p class="word-mean">lời nói</p>-->
<!--                    <p class="word-example">a man with a few words</p>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>

<!--    loading-->
    <div class="col-sm-9 text-center text-danger" style="display: none;" id="div-word-loading">
        <br><br><br>
        <img src="<?php echo $baseUrl; ?>/public/loading-mini.gif" alt="Đang tải">
    </div>



<!--    phần hiển thị danh sách 50 từ đầu tiên-->
    <div class="col-sm-9" id="div-show-all-word">
        <h3 class="text-primary">Tổng số từ, cụm từ: <span class="text-danger" id="total-word"><?php echo $total; ?></span>
            <?php if (loggedIn()){ ?>
                <a href="?m=word&a=add" id="link-add-word" data-toggle="tooltip" class="close" title="Thêm mới" data-placement="bottom">
                    <span class="glyphicon glyphicon-plus-sign" ></span>
                </a>
            <?php } ?>
        </h3>
        <div id="div-store-all-word">
			<?php
			foreach ($listWord as $word){?>
                <div class="col-sm-4 word-start-with-char">
                    <a href=""><?php echo $word['keyword']; ?></a>
                </div>
				<?php
			}
			?>
        </div>
        <div class="col-sm-12 text-center">
            <img id="img-load-more-word-loading" style="display: none;"
                 src="<?php echo $baseUrl; ?>/public/loading-mini.gif" alt="Đang tải...">
            <input type="hidden" id="load-more-current-page" value="1">
            <?php 
            if (!$haveLoadAll){ ?>
            <button class="btn btn-primary btn-sm" id="btn-load-more-word">
                <span class="glyphicon glyphicon-menu-down"></span> Tải thêm
            </button>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once MODULE_PATH . '/widget/footer.php'; ?>
