<?php
$sub_menu = "200110";
require_once './_common.php';

auth_check_menu($auth, $sub_menu, 'r');

$sql = "SELECT *
    FROM VW_TR_MEMBER
    WHERE cn_id = '{$config['cn_id']}' ";
$result = sql_query($sql, true);

$g5['title'] = '회원계보관리';
require_once './admin.head.php';
?>

<?php
function create_member_children_tree() {
    global $result;

    $mb_tree = array();

    while($row = sql_fetch_array($result)) {
        if ($row['is_children'] > 0) {
            $row['children'] = create_member_children_tree();
        }

        array_push($mb_tree, $row);
    }

    if (count($mb_tree) == 1 && $mb_tree[0]['mb_recommend'] == '') $mb_tree = $mb_tree[0];

    return $mb_tree;
}

$mb_tree = array();
$mb_tree = create_member_children_tree();
$mb_tree_json = json_encode($mb_tree, JSON_UNESCAPED_UNICODE);
?>

<div id="chart-container"></div>

<link rel="stylesheet" href="<?php echo(G5_URL); ?>/js/orgchart/jquery.orgchart.min.css">
<script type="text/javascript" src="<?php echo(G5_URL); ?>/js/orgchart/jquery.orgchart.min.js"></script>
<script type="text/javascript" language="javascript">
var datasource = <?php echo($mb_tree_json); ?>;

$('#chart-container').orgchart({
  'data' : datasource,
  'depth': 2,
  'nodeTitle': 'mb_id',
  'nodeContent': 'mb_name'
});
</script>

<?php
require_once './admin.tail.php';
