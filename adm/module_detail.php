<?php
$sub_menu = "100650";
include_once('./_common.php');

if ($is_admin != 'super')
    die('최고관리자만 접근 가능합니다.');

$module = trim($_POST['module']);
$module_dir = get_module_dir();

if(!in_array($module, $module_dir))
    die('선택하신 테마가 설치되어 있지 않습니다.');

$info = get_module_info($module);
$name = get_text($info['module_name']);

if($info['screenshot'])
    $screenshot = '<img src="'.$info['screenshot'].'" alt="'.$name.'">';
else
    $screenshot = '<img src="'.G5_ADMIN_URL.'/img/module_img.jpg" alt="">';
?>

<div id="module_detail">
    <h2><?php echo $name; ?></h2>
    <div class="module_dt_img"><?php echo $screenshot; ?></div>
    <div class="module_dt_if">
        <p><?php echo get_text($info['detail']); ?></p>
        <table>
            <tr>
                <th scope="row">Version</th>
                <td><?php echo get_text($info['version']); ?></td>
            </tr>
        </table>
        <div class="module_dt_btn">
        <button type="button" class="close_btn">닫기</button>
        </div>
    </div>
</div>

<script>
$(".close_btn").on("click", function() {
    $("#module_detail").remove();
});
</script>