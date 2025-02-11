<?php
/*
 * @Author        : Qinver
 * @Url           : zibll.com
 * @Date          : 2020-09-29 13:18:36
 * @LastEditTime: 2022-10-26 21:46:06
 * @Email         : 770349780@qq.com
 * @Project       : Zibll子比主题
 * @Description   : 一款极其优雅的Wordpress主题
 * @Read me       : 感谢您使用子比主题，主题源码有详细的注释，支持二次开发。
 * @Remind        : 使用盗版主题会存在各种未知风险。支持正版，从我做起！
 */

require_once get_theme_file_path('/inc/inc.php');

/**
 * 如果您需要添加一些自定义的PHP代码
 * 您可以在当前目录下新建一个 func.php 的文件，写入你的php代码
 * 主题会自动判断文件进行引入
 * 使用此方式在线更新主题的时候，func.php文件的内容将不会被覆盖（手动更新仍然会覆盖）
 * 当然需要注意php的代码规范，错误代码将会引起网站严重错误！
 */
if (file_exists(get_theme_file_path('/func.php'))) {
    require_once get_theme_file_path('/func.php');
}

/**
 * 您也可以将您的临时自定义php代码写在下方
 * 主题更新请自行备份您的自定义代码
 */

add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/validate-credentials', array(
        'methods' => 'POST',
        'callback' => 'validate_credentials',
        'permission_callback' => function () {
            return true; // 你可以根据需要设置权限
        },
    ));
});

function validate_credentials(WP_REST_Request $request) {
    $username = $request->get_param('username');
    $password = $request->get_param('password');

    if (empty($username) || empty($password)) {
        return new WP_Error('missing_fields', 'Username and password are required', array('status' => 400));
    }

    $user = wp_authenticate($username, $password);

    if (is_wp_error($user)) {
        return new WP_Error('invalid_credentials', 'Invalid username or password', array('status' => 401));
    }

    return rest_ensure_response(array('success' => true, 'message' => 'Credentials are valid'));
}
