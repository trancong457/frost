<?php
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

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define('DB_NAME', 'frost');

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
define('AUTH_KEY',         'lX*Q@$0&Z[ Q9TuVcb`E$N,uRoe7CyL,BU>Typ[c<JU=KvzIfb@1&[8[i&/X17E4');
define('SECURE_AUTH_KEY',  'pL!eEp*R%ghQO7>}Kg^5K,ac6XuS$O^Yz%.pLBb8d0[]}8G}Ke4`}&f0]3{TBGj%');
define('LOGGED_IN_KEY',    '@^3HuRf~q)CY%U[5b<~VnRL4pW]7c{e<*?GxKl8oGDfGr@hJ)P_5ZlC={b4x&-E*');
define('NONCE_KEY',        'b-)L&X[#&m2Ui^0kU]aDFYWC8Ku/B>}bxfo4n4sO#Lc)~C_$d&)2F*MKuWR=^iS ');
define('AUTH_SALT',        'K8$K2S[_&v5)x)(.AU_t0@ZCB5~KRM[b?T*X Q59+ZqV1=faVh]G}&&s8(|O8zPE');
define('SECURE_AUTH_SALT', 'M.VLl@(#})7~=$jK/l(yA,F6<-pm~/;cqk5?+w:[hElbD<9KPz}aN_mE)5^t$^mZ');
define('LOGGED_IN_SALT',   'J5>GY(o &cs@cx%awmfj/xU>1m[C,03,V&Iqv#fvJr^aT ()ywC`_ocs3(Y8GeJX');
define('NONCE_SALT',       'n/.[s5U=G~7o&d02x+e=:u[v@eP_,6&CO-ZzblS~:C>I07_g[gFl*Zt?PIeTw{0p');

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

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
