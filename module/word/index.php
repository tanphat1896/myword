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

$listWord = $wordDP->getListWord(0, 50);


require_once MODULE_PATH . '/widget/header.php';
?>

<!--phần nội dung-->
<div class="container-fluid" id="div-search-word">
    <div class="col-sm-3" id="div-search-engine">
        <form id="frm-search-word">
            <div class="form-group">
                <label>Look up:</label>
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
                <!-- <a href="#" data-toggle="tooltip" title="Trở về" class="close" id="link-hide-div-show-word">
					<span class="glyphicon glyphicon-remove"></span>
				</a> -->

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
<!--            <div class="div-word-type">-->
<!--                <p class="word-type">Ngoại động từ</p>-->
<!--                <div class="div-word-mean">-->
<!--                    <p class="word-mean">phát biểu, nói lên</p>-->
<!--                    <p class="word-example">word an idea <span class="translate">phát biểu 1 ý kiến</span></p>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>

<!--    phần hiển thị danh sách 50 từ đầu tiên-->
    <div class="col-sm-9" id="div-show-all-word">
        <h3 class="text-success">Danh sách từ: <span class="text-danger" id="total-word"><?php echo $total; ?></span>
            <a href="" id="link-add-word" data-toggle="tooltip" class="close" title="Thêm mới" data-placement="bottom">
                <span class="glyphicon glyphicon-plus-sign" ></span>
            </a>
        </h3>
        <?php
        foreach ($listWord as $word){?>
            <div class="col-sm-4 word-start-with-char">
                <a href=""><?php echo $word['keyword']; ?></a>
            </div>
        <?php
        }
        ?>
<!--        <div class="col-sm-4 word-start-with-char">-->
<!--            <a href="">absent</a>-->
<!--        </div>-->
<!--        <div class="col-sm-4 word-start-with-char">-->
<!--            <a href="">accompany</a>-->
<!--        </div>-->
<!--        <div class="col-sm-4 word-start-with-char">-->
<!--            <a href="">accommodation</a>-->
<!--        </div>-->
    </div>
</div>

<?php require_once MODULE_PATH . '/widget/footer.php'; ?>
