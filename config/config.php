<?php
/**
 * KONFIGURASI DASAR SISTEM KARYAILMIAH.ID
 * 
 * File ini berisi semua konfigurasi dasar yang diperlukan sistem
 * Pastikan untuk mengubah nilai-nilai sesuai environment (dev/staging/production)
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(dirname(__FILE__)));
}

/**
 * DATABASE CONFIGURATION
 * Sesuaikan dengan kredensial database Anda
 * 
 * TODO Backend: Implementasikan koneksi database menggunakan PDO
 * dengan prepared statements untuk keamanan
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'karyailmiah_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

/**
 * SITE CONFIGURATION
 * Konfigurasi umum website
 */
define('SITE_NAME', 'KaryaIlmiah.id');
define('SITE_TAGLINE', 'Platform Penerbitan Karya Ilmiah Indonesia');
define('SITE_URL', 'http://localhost/karyailmiah'); // Ganti dengan URL production
define('SITE_EMAIL', 'info@karyailmiah.id');
define('SITE_PHONE', '+62 21 1234567');

/**
 * PATH CONFIGURATION
 * Definisi path untuk berbagai direktori
 */
define('ASSETS_URL', SITE_URL . '/assets');
define('CSS_URL', ASSETS_URL . '/css');
define('JS_URL', ASSETS_URL . '/js');
define('IMG_URL', ASSETS_URL . '/images');
define('UPLOAD_PATH', BASE_PATH . '/uploads');
define('UPLOAD_URL', SITE_URL . '/uploads');

/**
 * ROYALTY & COMMISSION CONFIGURATION
 * Pengaturan pembagian royalti dan komisi
 * 
 * TODO Backend: Buat tabel settings di database untuk nilai-nilai ini
 * agar bisa diubah tanpa edit code
 */
define('ROYALTY_SELF_PUBLISHER', 60); // 60% untuk self-publisher
define('ROYALTY_PLATFORM', 40); // 40% untuk platform
define('AFFILIATE_COMMISSION', 10); // 10% komisi afiliasi
define('EDITOR_COMMISSION_RATE', 15); // 15% komisi editor per proyek

/**
 * PAYMENT GATEWAY CONFIGURATION
 * Konfigurasi untuk payment gateway (Midtrans/Stripe)
 * 
 * TODO Backend: Simpan API keys di environment variables
 * Jangan hardcode di file ini untuk production
 */
define('PAYMENT_MODE', 'sandbox'); // sandbox atau production
define('MIDTRANS_SERVER_KEY', 'YOUR_SERVER_KEY');
define('MIDTRANS_CLIENT_KEY', 'YOUR_CLIENT_KEY');
define('MIDTRANS_MERCHANT_ID', 'YOUR_MERCHANT_ID');

/**
 * EMAIL CONFIGURATION
 * Konfigurasi untuk pengiriman email
 * 
 * TODO Backend: Gunakan library seperti PHPMailer atau SwiftMailer
 * Implementasikan queue system untuk email massal
 */
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'noreply@karyailmiah.id');
define('SMTP_PASS', 'your_password');
define('SMTP_ENCRYPTION', 'tls');

/**
 * UPLOAD CONFIGURATION
 * Pengaturan untuk upload file
 */
define('MAX_UPLOAD_SIZE', 50 * 1024 * 1024); // 50MB
define('ALLOWED_BOOK_FORMATS', ['pdf', 'epub']);
define('ALLOWED_IMAGE_FORMATS', ['jpg', 'jpeg', 'png', 'webp']);
define('COVER_SIZES', [
    'thumbnail' => ['width' => 200, 'height' => 300],
    'medium' => ['width' => 400, 'height' => 600],
    'large' => ['width' => 800, 'height' => 1200]
]);

/**
 * SESSION CONFIGURATION
 * Pengaturan session untuk keamanan
 */
define('SESSION_LIFETIME', 7200); // 2 jam
define('SESSION_NAME', 'KARYAILMIAH_SESS');
define('REMEMBER_ME_DURATION', 30 * 24 * 60 * 60); // 30 hari

/**
 * SECURITY CONFIGURATION
 * Pengaturan keamanan sistem
 * 
 * TODO Backend: Implementasikan CSRF protection di semua form
 * Gunakan password_hash() untuk enkripsi password
 */
define('CSRF_TOKEN_NAME', 'csrf_token');
define('PASSWORD_MIN_LENGTH', 8);
define('LOGIN_MAX_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 900); // 15 menit

/**
 * PAGINATION CONFIGURATION
 * Pengaturan untuk pagination
 */
define('BOOKS_PER_PAGE', 12);
define('BLOG_PER_PAGE', 9);
define('TRANSACTIONS_PER_PAGE', 20);
define('USERS_PER_PAGE', 50);

/**
 * CMS CONFIGURATION
 * Pengaturan untuk Content Management System
 * 
 * TODO Backend: Buat tabel cms_content untuk menyimpan konten dinamis
 * Structure: id, key, value, type, updated_at, updated_by
 */
define('CMS_CACHE_ENABLED', true);
define('CMS_CACHE_DURATION', 3600); // 1 jam
define('CMS_VERSION_CONTROL', true); // Track perubahan konten

/**
 * API CONFIGURATION
 * Pengaturan untuk API endpoints
 */
define('API_VERSION', 'v1');
define('API_RATE_LIMIT', 100); // Request per jam
define('API_KEY_HEADER', 'X-API-Key');

/**
 * INDEXING CONFIGURATION
 * Pengaturan untuk scholar indexing
 */
define('GOOGLE_SCHOLAR_ENABLED', true);
define('CROSSREF_ENABLED', true);
define('DOI_PREFIX', '10.12345'); // Ganti dengan DOI prefix resmi

/**
 * TIMEZONE & LOCALE
 * Pengaturan zona waktu dan lokalisasi
 */
date_default_timezone_set('Asia/Jakarta');
setlocale(LC_ALL, 'id_ID.UTF-8', 'id_ID', 'id');
define('DATE_FORMAT', 'd F Y');
define('DATETIME_FORMAT', 'd F Y H:i');
define('CURRENCY', 'IDR');
define('CURRENCY_SYMBOL', 'Rp');

/**
 * DEBUG CONFIGURATION
 * Pengaturan untuk debugging
 * 
 * TODO Backend: Set ke false di production
 * Implementasikan proper error logging
 */
define('DEBUG_MODE', true);
define('LOG_ERRORS', true);
define('LOG_PATH', BASE_PATH . '/logs');
define('ERROR_DISPLAY', DEBUG_MODE ? 'all' : 'none');

// Error reporting berdasarkan mode
if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

/**
 * AUTOLOAD CONFIGURATION
 * Load file-file yang diperlukan
 * 
 * TODO Backend: Implementasikan PSR-4 autoloading dengan Composer
 */
require_once BASE_PATH . '/config/constants.php';
require_once BASE_PATH . '/includes/functions.php';

// Start session dengan konfigurasi keamanan
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', !DEBUG_MODE); // HTTPS only di production
    ini_set('session.cookie_samesite', 'Lax');
    session_name(SESSION_NAME);
    session_start();
}

/**
 * Initialize CSRF token jika belum ada
 * 
 * TODO Backend: Buat helper function untuk generate dan validate CSRF token
 */
if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
    $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
}