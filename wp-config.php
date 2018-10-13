<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
 
 //	define('DISALLOW_FILE_MODS',true);
	
	error_reporting(E_ALL | E_STRICT);
	ini_set("display_errors", 1);
	
	define( 'WP_MAX_MEMORY_LIMIT', '256M' );
	define('WP_MEMORY_LIMIT', '128M');
	define( 'AUTOSAVE_INTERVAL', 36000 ); // Seconds
	define( 'WP_POST_REVISIONS', false );
	define( 'EMPTY_TRASH_DAYS', 5 );
	define('WP_ALLOW_REPAIR', true);

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define('DB_NAME', 'cuongphat');

/** Username của database */
define('DB_USER', 'root');

/** Mật khẩu của database */
define('DB_PASSWORD', '');

/** Hostname của database */
define('DB_HOST', 'localhost');

/** Database charset sử dụng để tạo bảng database. */
define('DB_CHARSET', 'utf8mb4');

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '?46&aPWAB&0/*/yBwsNMi$}briZ-v6KF%=$,=Cij3b%Y|$cj6]vBvay_I{:fg;/:');
define('SECURE_AUTH_KEY',  'sB.<mn]I7a=.yyK4D/J*@L7v5/V?NxZbS5uZ71r.ci=D0LK]kZK]tVQG`jT{|y9$');
define('LOGGED_IN_KEY',    '|9fx6YMB@T}$Tc#-mqOzTto+rgdF*DCS4JnJ[>$vw3ZjFRZ)|4~;WH-<-s*0Ot#<');
define('NONCE_KEY',        'qZE%+eUIFzFw^++7^F~WuH&5]?-AAfwN]:8B`}]1GqhEo4?Yt[{7y%MX]!gwW;j*');
define('AUTH_SALT',        'o!^-$mSF/.A<)%4f%K,LzNB>n8kg6-D>4bA]?~SNF?lg1Vm:}~*2N_~-_4%sr/O-');
define('SECURE_AUTH_SALT', 'N6#4+nfl&9L-P2{)F[(8gQ 9JMoi&eqzS{1HXM2.0/k$5%l9-_3uC$az<%oY}7Al');
define('LOGGED_IN_SALT',   'xtB_zh{05Rs8@ >,7h`fwtvk[Y-,@KCmAOwO|f)nPCo XWnijKdxRk{cvQrrak:s');
define('NONCE_SALT',       'WG5FgE+LasF=P>a#wu1g6=9D5R2Hfm-TtW<9X}=j;%2.U6W[;~^BV}Q4U[Bw7&sK');

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'poka_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
