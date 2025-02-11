<?php
/*
 * @Author: Qinver
 * @Url: zibll.com
 * @Date: 2021-04-11 21:36:20
 * @LastEditTime: 2022-11-17 11:31:36
 */

/**
 * 微信同步回调
 */


header('Content-type:text/html; Charset=utf-8');

ob_start();
require_once dirname(__FILE__) . '/../../../../../../wp-load.php';
ob_end_clean();

$user_id = get_current_user_id();
if ($user_id) {
    wp_safe_redirect(zib_get_user_center_url('order'));
    return;
}

wp_safe_redirect(home_url());
