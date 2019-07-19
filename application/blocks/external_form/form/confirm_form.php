<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$form = Core::make('helper/form');
$formDate = Core::make('helper/form/date_time');
?>

<?php
// フォーム表示部分
if ($section == "edit") { ?>
    <?php if ($isvalid == false) {?>
        <span style="color:red;font-weight:bold;">エラー: 必須項目に空欄があります。</span>
    <?php }?>
    <form method="post" id="form_edit" action="<?=$view->action('confirm')?>#form">
        <?php Core::make('helper/validation/token')->output('confirm_form');?>
        <div class="fields">
            <div class="form-group field field-text">
                <label class="control-label">お名前 <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
                <?php echo(isset($error['p_name']) ? '<span style="color:red">'.$error['p_name'].'</span>' : ''); ?>
                <?php echo $form->text('p_name')?>
            </div>
            <div class="form-group field field-text">
                <label class="control-label">ふりがな <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
                <?php echo(isset($error['p_name_yomi']) ? '<span style="color:red">'.$error['p_name_yomi'].'</span>' : ''); ?>
                <?php echo $form->text('p_name_yomi')?>
            </div>

            <div class="orm-group field field-email">
                <label class="control-label">メールアドレス <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
                <?php echo(isset($error['p_email']) ? '<span style="color:red">'.$error['p_email'].'</span>' : ''); ?>
                <?php echo $form->email('p_email')?>
            </div>

            <div class="form-group field field-text">
                <label class="control-label">電話番号 <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
                <?php echo(isset($error['p_tel']) ? '<span style="color:red">'.$error['p_tel'].'</span>' : ''); ?>
                <?php echo $form->text('p_tel')?>
            </div>

            <div class="form-group field field-textarea">
                <label class="control-label">コメント <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
                <?php echo $form->textarea('p_message','',['style' => 'display:block;','col' => '50', 'rows' => '10'])?>
                <?php echo(isset($error['p_message']) ? '<span style="color:red">'.$error['p_message'].'</span>' : ''); ?>
            </div>

            <div class="form-actions">
                <?php echo $form->submit('confirm', '送信内容を確認', array('style' => ''), 'btn btn-primary');?>
            </div>
        </div>
    </form>
    <?php
// 確認画面表示部分
} else if ($section == "confirm") { ?>
    <div class="fields">
        <div class="form-group field field-text">
            <label class="control-label">お名前 <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
            <div><?=$input['p_name'];?></div>
        </div>
        <div class="form-group field field-text">
            <label class="control-label">ふりがな <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
            <div><?=$input['p_name_yomi'];?></div>
        </div>
        <div class="form-group field field-text">
            <label class="control-label">メールアドレス <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
            <div><?=$input['p_email'];?></div>
        </div>
        <div class="form-group field field-text">
            <label class="control-label">電話番号 <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
            <div><?=$input['p_tel'];?></div>
        </div>
        <div class="form-group field field-text">
            <label class="control-label">メッセージ <span class="text-danger small" style="font-weight: normal">（必須）</span></label>
            <div><?=nl2br($input['p_message']);?></div>
        </div>
        <div class="form-actions">
            <form method="post" id="form_back" action="<?=$view->action('back')?>#form" style="float:left;">
                <?php Core::make('helper/validation/token')->output('confirm_form_back');?>
                <?php echo $form->hidden('p_name')?>
                <?php echo $form->hidden('p_name_yomi')?>
                <?php echo $form->hidden('p_email')?>
                <?php echo $form->hidden('p_tel')?>
                <?php echo $form->hidden('p_message')?>
                <?php echo $form->submit('back', '戻る', array('style' => ''), 'btn btn-danger');?>
            </form>
            <form method="post" id="form_submit" action="<?=$view->action('submit')?>#form" style="float:left;">
                <?php Core::make('helper/validation/token')->output('confirm_form_confirm');?>
                <?php echo $form->hidden('p_name')?>
                <?php echo $form->hidden('p_name_yomi')?>
                <?php echo $form->hidden('p_email')?>
                <?php echo $form->hidden('p_tel')?>
                <?php echo $form->hidden('p_message')?>
                <?php echo $form->submit('submit', '送信', array('style' => ''), 'btn btn-primary');?>
            </form>
        </div>
    </div>
<?php }  ?>
