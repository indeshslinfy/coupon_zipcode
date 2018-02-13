<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')  OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                   OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')             OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')           OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')      OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')    OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')  OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('DS') OR define('DS', DIRECTORY_SEPARATOR);

// USER
defined('USER_STATUS_ACTIVE') OR define('USER_STATUS_ACTIVE', 1);
defined('USER_STATUS_INACTIVE') OR define('USER_STATUS_INACTIVE', 0);

// ROLES
defined('ACCESS_ROLE_SUPERADMIN') OR define('ACCESS_ROLE_SUPERADMIN', 1);
defined('ACCESS_ROLE_ADMIN') OR define('ACCESS_ROLE_ADMIN', 2);
defined('ACCESS_ROLE_USER') OR define('ACCESS_ROLE_USER', 3);

defined('COUPON_LOCAL') OR define('COUPON_LOCAL', 1);
defined('COUPON_GROUPON') OR define('COUPON_GROUPON', 2);

// TICKETS
defined('TICKET_TYPE_CONTACT') OR define('TICKET_TYPE_CONTACT', 1);
defined('TICKET_TYPE_ADVERTISE') OR define('TICKET_TYPE_ADVERTISE', 2);

defined('TICKET_STATUS_CLOSE') OR define('TICKET_STATUS_CLOSE', 0);
defined('TICKET_STATUS_OPEN') OR define('TICKET_STATUS_OPEN', 1);
defined('TICKET_STATUS_ANSWER') OR define('TICKET_STATUS_ANSWER', 2);

// STORES
defined('STORE_STATUS_ACTIVE') OR define('STORE_STATUS_ACTIVE', 1);
defined('STORE_STATUS_INACTIVE') OR define('STORE_STATUS_INACTIVE', 0);

defined('STORE_ATCH_MENU') OR define('STORE_ATCH_MENU', 3);
defined('STORE_ATCH_MENU_FOLDER') OR define('STORE_ATCH_MENU_FOLDER', 'uploads' . DS . 'store_menus');
defined('STORE_ATCH_IMAGE') OR define('STORE_ATCH_IMAGE', 1);
defined('STORE_ATCH_IMAGE_FOLDER') OR define('STORE_ATCH_IMAGE_FOLDER', 'uploads' . DS . 'store_images');
defined('STORE_ATCH_VIDEO') OR define('STORE_ATCH_VIDEO', 2);

defined('STORE_UNLIKE') OR define('STORE_UNLIKE', 0);
defined('STORE_LIKE') OR define('STORE_LIKE', 1);

defined('CATEGORY_SRC_GROUPON') OR define('CATEGORY_SRC_GROUPON', 1);
defined('CATEGORY_SRC_EBAY') OR define('CATEGORY_SRC_EBAY', 2);
defined('CATEGORY_SRC_AMAZON') OR define('CATEGORY_SRC_AMAZON', 3);

// COUPONS
defined('COUPON_STATUS_INACTIVE') OR define('COUPON_STATUS_INACTIVE', 0);
defined('COUPON_STATUS_ACTIVE') OR define('COUPON_STATUS_ACTIVE', 1);
defined('COUPON_STATUS_EXPIRED') OR define('COUPON_STATUS_EXPIRED', 2);
defined('COUPON_STATUS_FUTURE') OR define('COUPON_STATUS_FUTURE', 3);

defined('COUPON_TYPE_CODE') OR define('COUPON_TYPE_CODE', 1);
defined('COUPON_TYPE_IMAGE') OR define('COUPON_TYPE_IMAGE', 2);

// REVIEWS
defined('REVIEW_STATUS_DISAPPROVE') OR define('REVIEW_STATUS_DISAPPROVE', 0);
defined('REVIEW_STATUS_APPROVE') OR define('REVIEW_STATUS_APPROVE', 1);
defined('REVIEW_STATUS_ABUSE') OR define('REVIEW_STATUS_ABUSE', 2);

defined('REVIEW_TYPE_STORE') OR define('REVIEW_TYPE_STORE', 1);

// MISC
defined('ADMIN_PREFIX') OR define('ADMIN_PREFIX', 'admin');