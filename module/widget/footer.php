<?php
/**
 * Created by PhpStorm.
 * User: ngtanphat
 * Date: 31/7/2017
 * Time: 4:59 PM
 */
if (!defined('SYSTEM_PATH'))
	die('Bad request!');

$baseUrl = $GLOBALS['baseUrl'];

?>

<script src="<?php echo $baseUrl; ?>/public/js/common.js"></script>
<script src="<?php echo $baseUrl; ?>/public/js/word/word_process.js"></script>
<script src="<?php echo $baseUrl; ?>/public/js/word/search_word_process.js"></script>
<script src="<?php echo $baseUrl; ?>/public/js/word/load_more_word_process.js"></script>
<script src="<?php echo $baseUrl; ?>/public/js/grammar/grammar_process.js"></script>
</div>

<div class="modal fade" id="modal-login">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="?m=common&a=login" method="post">
                <div class="modal-header">
                    <span class="modal-title">Đăng nhập</span>
                </div>
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon">User</span>
                        <input class="form-control" name="username">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Pass</span>
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary btn-sm">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
