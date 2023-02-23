<?php
if (!defined('G5_MODULE_INSTALL') || !G5_MODULE_INSTALL) {
    die('잘못된 실행입니다.');
}

// SQL 파일 실행
function sql_file($filename) {
    $file = implode('', file($filename));

    $file = preg_replace('/^--.*$/m', '', $file); // 주석 제거
    $querys = explode(';', $file);
    foreach($querys as $sql) {
        if (trim($sql)) {
            if (in_array(strtolower(G5_DB_ENGINE), array('innodb', 'myisam'))) {
                $sql = preg_replace('/ENGINE=MyISAM/', 'ENGINE='.G5_DB_ENGINE, $sql);
            } else {
                $sql = preg_replace('/ENGINE=MyISAM/', '', $sql);
            }

            if (G5_DB_CHARSET !== 'utf8') {
                $sql = preg_replace('/CHARSET=utf8/', 'CHARSET='.run_replace('get_db_charset', G5_DB_CHARSET === 'utf8mb4' ? G5_DB_CHARSET.' COLLATE=utf8mb4_unicode_ci' : G5_DB_CHARSET, G5_DB_CHARSET), $sql);
            }

            if (preg_match('/CREATE TABLE IF NOT EXISTS `(.*?)`/', $sql, $sql_tmp)) {
                flush();
                echo('<li>'.$sql_tmp[1].'</li>'.PHP_EOL);
            }

            //sql_query($sql, true);
        }
    }
}

flush();

echo('<ul>'.PHP_EOL);

sql_file(realpath(__FILE__).'install.sql');

echo('</ul>'.PHP_EOL);