<?php
$sub_menu = "100650";
include_once('./_common.php');

if ($is_admin != 'super') {
    alert('최고관리자만 접근 가능합니다.');
}

$module = get_module_dir();

$module = array_values(array_unique($module));
$total_count = count($module);

$g5['title'] = "모듈설정";
include_once('./admin.head.php');
?>
<script src="<?php echo G5_ADMIN_URL; ?>/module.js"></script>
<div class="local_wr">
    <span class="btn_ov01"><span class="ov_txt">설치된 모듈</span><span class="ov_num">  <?php echo number_format($total_count); ?></span></span>
</div>

<?php if($total_count > 0) { ?>
    <ul id="module_list">
    <?php
    for($i = 0; $i < $total_count; $i++) {
        $info = get_module_info($module[$i]);
        $name = get_text($info['module_name']);
        if($info['screenshot']) {
            $screenshot = '<img src="'.$info['screenshot'].'" alt="'.$name.'">';
        } else {
            $screenshot = '<img src="'.G5_ADMIN_URL.'/img/module_img.jpg" alt="">';
        }

        $btn_active = '';
        if (isset($info['default_table']) && $info['default_table']) {
            $row = sql_fetch("SHOW TABLES LIKE '{$info['default_table']}'");
            if (!(isset($row) && is_array($row) && count($row))) {
                $btn_active = '<button type="button" class="module_sl module_install" data-module="'.$module[$i].'" '.'data-name="'.$name.'" data-set_default_skin="'.$set_default_skin.'">모듈설치</button>';
            }
        }
    ?>
    <li>
        <div class="tmli_if">
            <?php echo $screenshot; ?>
            <div class="tmli_tit">
                <p><?php echo get_text($info['module_name']); ?></p>
            </div>
        </div>
        <?php echo $btn_active; ?>
        <button type="button" class="tmli_dt module_preview" data-module="<?php echo $module[$i]; ?>">상세보기</button>
    </li>
    <?php
    }
    ?>
</ul>
<?php } else { ?>
<p class="no_module">설치된 모듈이 없습니다.</p>
<?php } ?>

<?php
include_once ('./admin.tail.php');