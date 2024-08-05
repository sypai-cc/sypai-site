## 说明
已经内置[Locoy.php](Locoy.php)文件，可直接使用。

已经开启[xmlrpc.php](xmlrpc.php)文件，可直接调用。

## 使用方法

创建数据库，将根目录的[sypai.sql](sypai.sql)导入数据库中（建议使用phpMyAdmin创建新表导入）。

然后运行以下SQL，你需要把`http://新域名`替换为你的域名，并将`'你的邮箱'`替换为你自己的真实邮箱。

```SQL
UPDATE wp_options SET option_value = replace( option_value, 'https://sypai.cc', 'http://新域名' ) 

WHERE option_name = 'home' OR option_name = 'siteurl';

UPDATE wp_posts SET post_content = replace( post_content, 'https://sypai.cc', 'http://新域名' ) ;

UPDATE wp_posts SET guid = replace( guid, 'https://sypai.cc', 'http://新域名' ) ;

UPDATE `wp_users` SET `user_email` = '你的邮箱' WHERE `wp_users`.`ID` = 1;

UPDATE `wp_options` SET `option_value` = '你的邮箱' WHERE `wp_options`.`option_id` = 7;
```

配置数据库信息，在[wp-config.php](wp-config.php)中按照你的数据库信息定位并修改以下内容：

```php
define('DB_NAME', 'your_db_name');
define('DB_USER', 'your_db_user');
define('DB_PASSWORD', 'your_db_password');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
```

然后，将以下随机码通过手写或者随机码生成器重置为自己的：

```php
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );
```
例如：
```php
define( 'AUTH_KEY',         getenv_docker('WORDPRESS_AUTH_KEY',         'bbdc266e4e7044248e5d036f945d67693fa95662') );
define( 'SECURE_AUTH_KEY',  getenv_docker('WORDPRESS_SECURE_AUTH_KEY',  'fad22b427acd78353df6b9cdf4d22f3e99e2f756') );
define( 'LOGGED_IN_KEY',    getenv_docker('WORDPRESS_LOGGED_IN_KEY',    '4879486caa8ead870858ec0e7b07d1e4333e7a54') );
define( 'NONCE_KEY',        getenv_docker('WORDPRESS_NONCE_KEY',        '82482690d192e3f215af2cad6257b5cc05545d2a') );
define( 'AUTH_SALT',        getenv_docker('WORDPRESS_AUTH_SALT',        'a9a7d608d40d65e915120d2a5c7757fceb826612') );
define( 'SECURE_AUTH_SALT', getenv_docker('WORDPRESS_SECURE_AUTH_SALT', '779a930eb5aa2538d0741f4518e4df1f4689f51c') );
define( 'LOGGED_IN_SALT',   getenv_docker('WORDPRESS_LOGGED_IN_SALT',   'f733851c16bb1567a670762c7f51869d945e4967') );
define( 'NONCE_SALT',       getenv_docker('WORDPRESS_NONCE_SALT',       '57e1e23d6d8113d9e8550ade48d3e89cb5d0e84d') );
```

将修改后的网站源代码（可以删除sypai.sql）上传到PHP环境的根目录下，设置伪静态为wordpress，然后访问`http://yourdomain/index.php`即可。

初始管理员账号为：

```
username: sypai
password: admin123
```

后台插件介绍

- WP Extra File Types：允许上传更多文件类型，默认只允许上传部分文件类型。

- WP-Sweep：清理垃圾文件。

- 超级缓存（WP-Super-Cache）：缓存页面，减少服务器压力，如果后台修改了页面，需要手动清除缓存。