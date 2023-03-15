<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_MODULE_PATH.'/module.lib.php');

$pf = get_profile($channel['cn_id']);

$it_list = array();

$sql = "SELECT *
    FROM {$g5['g5_shop_item_table']}
    WHERE cn_id = '{$channel['cn_id']}'
        AND it_type3 = '1'
    ORDER BY it_order ASC ";
$result = sql_query($sql);
if ($result) {
    while($row = sql_fetch_array($result)) {
        array_push($it_list, $row);
    }
    unset($result);
}

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    // 상태바에 표시될 제목
    $g5_head_title = implode(' | ', array_filter(array($g5['title'], $config['cf_title'])));
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/

//include_once(G5_MODULE_PATH.'/head.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<title><?php echo $g5_head_title; ?></title>
<link rel="stylesheet" href="<?php echo(G5_MODULE_URL); ?>/css/reset.css">
<link rel="stylesheet" href="<?php echo(G5_MODULE_URL); ?>/css/common.css">
<link rel="stylesheet" href="<?php echo(G5_MODULE_URL); ?>/css/style.css">
</head>
<body>

<section id="container">
    <header id="header">
        <section class="inner">
            <h1 class="logo">
                <a href="index.html">
                    <div class="sprite_insta_icon"></div>
                    <div class="sprite_write_logo"></div>
                </a>
            </h1>
            <div class="search_box">
                <input type="text" placeholder="검색" id="search-field">
                <div class="fake_field">
                    <span class="sprite_small_search_icon"></span>
                    <span>검색</span>
                </div>
            </div>

            <div class="right_icons">
                <a href="new_post.html"><div class="sprite_camera_icon"></div></a>
                <a href="login.html"><div class="sprite_compass_icon"></div></a>
                <a href="follow.html"><div class="sprite_heart_icon_outline"></div></a>
                <a href="profile.html"><div class="sprite_user_icon_outline"></div></a>
            </div>

        </section>

    </header>


    <section id="main_container">
        <div class="inner">
            <div class="contents_box">
                <?php
                foreach($it_list as $it_row) {
                ?>
                <article class="contents">
                    <header class="top">
                        <div class="user_container">
                            <div class="profile_img">
                                <img src="<?php echo(G5_DATA_URL); ?>/common/profile_img" alt="<?php echo($pf['pf_name']); ?>">
                            </div>
                            <div class="user_name">
                                <div class="nick_name m_text"><?php echo($pf['pf_name']); ?></div>
                                <!--div class="country s_text"><?php echo($it_row['it_name']); ?></div//-->
                            </div>
                        </div>
                        
                        <div class="sprite_more_icon" data-name="more">
                            <ul class="toggle_box">
                               <li><input type="submit" class="follow" value="팔로우" data-name="follow"></li>
                                <li>수정</li>
                                <li>삭제</li>
                            </ul>
                        </div>
                    </header>

                    <div class="img_section">
                        <div class="trans_inner">
                            <div><img src="<?php echo(G5_DATA_URL); ?>/item/<?php echo($it_row['it_img1']); ?>"></div>
                        </div>
                    </div>

                    <div class="comment_container">
                        <div>
                            <?php echo($it_row['it_name']); ?>
                        </div>
                    </div>

                    <div class="bottom_icons">
                        <div class="left_icons">
                            <div class="heart_btn">
                                <div class="sprite_heart_icon_outline" name="39" data-name="heartbeat"></div>
                            </div>
                            <div class="sprite_bubble_icon"></div>
                            <div class="sprite_share_icon" data-name="share"></div>
                        </div>
                        <div class="right_icon">
                            <div class="sprite_bookmark_outline" data-name="bookmark"></div>
                        </div>
                    </div>

                    <div class="likes m_text">
                        좋아요
                        <span id="like-count-39">2,346</span>
                        <span id="bookmark-count-39"></span>
                        개
                    </div>

                    <div class="comment_container">
                        <div class="comment" id="comment-list-ajax-post37">
                            <div class="comment-detail">
                                <div class="nick_name m_text">dongdong2</div>
                                <div>강아지가 너무 귀여워요~!</div>
                            </div>
                        </div>
                        <div class="small_heart">
                            <div class="sprite_small_heart_icon_outline"></div>
                        </div>
                    </div>

                    <div class="timer">1시간 전</div>

                    <div class="comment_field" id="add-comment-post37">
                        <input type="text" placeholder="댓글달기...">
                        <div class="upload_btn m_text" data-name="comment">게시</div>
                    </div>
                </article>
                <?php
                }
                ?>
            </div>
            <input type="hidden" id="page" value="1">

            <div class="side_box">
                <div class="user_profile">
                    <div class="profile_thumb">
                        <img src="<?php echo(G5_MODULE_URL); ?>/imgs/thumb.jpeg" alt="프로필사진">
                    </div>
                    <div class="detail">
                        <div class="id m_text">VANETA</div>
                        <div class="ko_name">배네타</div>
                    </div>
                </div>

                <article class="story">
                    <header class="story_header">
                        <div>스토리</div>
                        <div class="more">모두 보기</div>
                    </header>

                    <div class="scroll_inner">
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <img src="<?php echo(G5_MODULE_URL); ?>/imgs/thumb02.jpg" alt="프로필사진">
                            </div>
                            <div class="detail">
                                <div class="id">kind_tigerrrr</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <img src="<?php echo(G5_MODULE_URL); ?>/imgs/thumb02.jpg" alt="프로필사진">
                            </div>
                            <div class="detail">
                                <div class="id">kind_tigerrrr</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <img src="<?php echo(G5_MODULE_URL); ?>/imgs/thumb02.jpg" alt="프로필사진">
                            </div>
                            <div class="detail">
                                <div class="id">kind_tigerrrr</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <img src="<?php echo(G5_MODULE_URL); ?>/imgs/thumb02.jpg" alt="프로필사진">
                            </div>
                            <div class="detail">
                                <div class="id">kind_tigerrrr</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                        <div class="thumb_user">
                            <div class="profile_thumb">
                                <img src="<?php echo(G5_MODULE_URL); ?>/imgs/thumb02.jpg" alt="프로필사진">
                            </div>
                            <div class="detail">
                                <div class="id">kind_tigerrrr</div>
                                <div class="time">1시간 전</div>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="recommend">
                    <header class="reco_header">
                        <div>회원님을 위한 추천</div>
                        <div class="more">모두 보기</div>
                    </header>

                    <div class="thumb_user">
                        <div class="profile_thumb">
                            <img src="<?php echo(G5_MODULE_URL); ?>/imgs/thumb02.jpg" alt="프로필사진">
                        </div>
                        <div class="detail">
                            <div class="id">kind_tigerrrr</div>
                            <div class="time">1시간 전</div>
                        </div>
                    </div>
                    <div class="thumb_user">
                        <div class="profile_thumb">
                            <img src="<?php echo(G5_MODULE_URL); ?>/imgs/thumb02.jpg" alt="프로필사진">
                        </div>
                        <div class="detail">
                            <div class="id">kind_tigerrrr</div>
                            <div class="time">1시간 전</div>
                        </div>
                    </div>
                </article>
            </div>


        </div>
    </section>



</section>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="<?php echo(G5_MODULE_URL); ?>/js/main.js"></script>
</body>
</html>
<?php
//include_once(G5_MODULE_PATH.'/tail.php');