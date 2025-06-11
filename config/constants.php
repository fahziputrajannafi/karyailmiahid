<?php
/**
 * KONSTANTA SISTEM KARYAILMIAH.ID
 * 
 * File ini berisi semua konstanta yang digunakan di seluruh sistem
 * Termasuk: User roles, status codes, tipe konten, dll
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('BASE_PATH')) {
    die('Access denied');
}

/**
 * USER ROLES
 * Definisi level akses user dalam sistem
 * 
 * TODO Backend: Sync dengan tabel roles di database
 * Buat middleware untuk cek permission berdasarkan role
 */
define('ROLE_GUEST', 0);          // Pengunjung tidak login
define('ROLE_USER', 1);           // User terdaftar biasa
define('ROLE_SELF_PUBLISHER', 2); // Self-publisher (60% royalty)
define('ROLE_PUBLISHER', 3);      // Publisher/Institusi
define('ROLE_EDITOR', 4);         // Editor internal/eksternal
define('ROLE_ADMIN_PRODUCT', 5);  // Admin produk
define('ROLE_ADMIN_FINANCE', 6);  // Admin keuangan
define('ROLE_SUPERADMIN', 7);     // Superadmin
define('ROLE_OWNER', 8);          // Owner sistem

/**
 * BOOK STATUS
 * Status dalam alur penerbitan buku
 * 
 * TODO Backend: Buat state machine untuk transisi status
 * Log setiap perubahan status dengan timestamp dan user
 */
define('BOOK_STATUS_DRAFT', 'draft');                 // Naskah baru diupload
define('BOOK_STATUS_REVIEW', 'review');               // Dalam review admin
define('BOOK_STATUS_EDITING', 'editing');             // Sedang diedit
define('BOOK_STATUS_PROOFREADING', 'proofreading');   // Proses proofreading
define('BOOK_STATUS_APPROVED', 'approved');           // Disetujui, siap publish
define('BOOK_STATUS_PUBLISHED', 'published');         // Sudah dipublish
define('BOOK_STATUS_REJECTED', 'rejected');           // Ditolak
define('BOOK_STATUS_ARCHIVED', 'archived');           // Diarsipkan

/**
 * TRANSACTION STATUS
 * Status transaksi pembelian
 * 
 * TODO Backend: Integrate dengan payment gateway callback
 */
define('TRX_STATUS_PENDING', 'pending');       // Menunggu pembayaran
define('TRX_STATUS_PROCESSING', 'processing'); // Sedang diproses
define('TRX_STATUS_SUCCESS', 'success');       // Berhasil
define('TRX_STATUS_FAILED', 'failed');         // Gagal
define('TRX_STATUS_EXPIRED', 'expired');       // Kadaluarsa
define('TRX_STATUS_REFUNDED', 'refunded');     // Direfund

/**
 * WITHDRAW STATUS
 * Status pencairan dana
 */
define('WITHDRAW_PENDING', 'pending');     // Menunggu approval
define('WITHDRAW_APPROVED', 'approved');   // Disetujui
define('WITHDRAW_PROCESSING', 'processing'); // Sedang diproses
define('WITHDRAW_COMPLETED', 'completed'); // Selesai
define('WITHDRAW_REJECTED', 'rejected');   // Ditolak
define('WITHDRAW_CANCELLED', 'cancelled'); // Dibatalkan user

/**
 * COLLABORATION STATUS
 * Status proyek kolaborasi
 */
define('COLLAB_OPEN', 'open');           // Terbuka untuk pendaftar
define('COLLAB_IN_PROGRESS', 'progress'); // Sedang berjalan
define('COLLAB_REVIEW', 'review');       // Tahap review
define('COLLAB_COMPLETED', 'completed'); // Selesai
define('COLLAB_CANCELLED', 'cancelled'); // Dibatalkan

/**
 * EDITOR TASK STATUS
 * Status tugas editor
 */
define('TASK_ASSIGNED', 'assigned');     // Baru ditugaskan
define('TASK_IN_PROGRESS', 'progress');  // Sedang dikerjakan
define('TASK_SUBMITTED', 'submitted');   // Sudah submit hasil
define('TASK_REVISION', 'revision');     // Perlu revisi
define('TASK_APPROVED', 'approved');     // Disetujui
define('TASK_PAID', 'paid');            // Komisi sudah dibayar

/**
 * CONTENT TYPES
 * Tipe konten dalam sistem
 * 
 * TODO Backend: Gunakan untuk filtering dan categorizing
 */
define('CONTENT_EBOOK', 'ebook');
define('CONTENT_JOURNAL', 'journal');
define('CONTENT_THESIS', 'thesis');
define('CONTENT_RESEARCH', 'research');
define('CONTENT_ARTICLE', 'article');
define('CONTENT_PROCEEDINGS', 'proceedings');

/**
 * SERVICE TYPES
 * Jenis layanan yang ditawarkan
 */
define('SERVICE_SELF_PUBLISH', 'self_publish');
define('SERVICE_COLLABORATION', 'collaboration');
define('SERVICE_EDITING', 'editing');
define('SERVICE_PROOFREADING', 'proofreading');
define('SERVICE_PARAPHRASE', 'paraphrase');
define('SERVICE_TRANSLATION', 'translation');

/**
 * NOTIFICATION TYPES
 * Tipe notifikasi sistem
 * 
 * TODO Backend: Buat queue system untuk kirim notifikasi
 */
define('NOTIF_BOOK_APPROVED', 'book_approved');
define('NOTIF_BOOK_REJECTED', 'book_rejected');
define('NOTIF_BOOK_SOLD', 'book_sold');
define('NOTIF_PAYMENT_SUCCESS', 'payment_success');
define('NOTIF_WITHDRAW_APPROVED', 'withdraw_approved');
define('NOTIF_TASK_ASSIGNED', 'task_assigned');
define('NOTIF_ROYALTY_RECEIVED', 'royalty_received');

/**
 * PAYMENT METHODS
 * Metode pembayaran yang diterima
 */
define('PAYMENT_BANK_TRANSFER', 'bank_transfer');
define('PAYMENT_CREDIT_CARD', 'credit_card');
define('PAYMENT_EWALLET', 'ewallet');
define('PAYMENT_VA', 'virtual_account');

/**
 * BANKS LIST
 * Daftar bank untuk withdraw
 * 
 * TODO Backend: Buat tabel banks di database
 */
define('BANKS', [
    'bca' => 'Bank Central Asia',
    'bni' => 'Bank Negara Indonesia',
    'bri' => 'Bank Rakyat Indonesia',
    'mandiri' => 'Bank Mandiri',
    'cimb' => 'CIMB Niaga',
    'danamon' => 'Bank Danamon',
    'permata' => 'Bank Permata'
]);

/**
 * E-WALLET LIST
 * Daftar e-wallet untuk pembayaran
 */
define('EWALLETS', [
    'gopay' => 'GoPay',
    'ovo' => 'OVO',
    'dana' => 'DANA',
    'linkaja' => 'LinkAja',
    'shopeepay' => 'ShopeePay'
]);

/**
 * LANGUAGES
 * Bahasa yang didukung sistem
 */
define('LANG_ID', 'id');
define('LANG_EN', 'en');
define('DEFAULT_LANG', LANG_ID);

/**
 * CACHE KEYS
 * Prefix untuk cache keys
 * 
 * TODO Backend: Implementasi Redis/Memcached untuk caching
 */
define('CACHE_HOMEPAGE', 'homepage_');
define('CACHE_CATALOG', 'catalog_');
define('CACHE_BOOK_DETAIL', 'book_');
define('CACHE_PUBLISHER', 'publisher_');
define('CACHE_STATS', 'stats_');

/**
 * META TAGS DEFAULTS
 * Default meta tags untuk SEO
 */
define('META_TITLE_SUFFIX', ' - KaryaIlmiah.id');
define('META_DESCRIPTION_DEFAULT', 'Platform penerbitan karya ilmiah terpercaya di Indonesia. Terbitkan buku, jurnal, dan karya ilmiah Anda dengan mudah.');
define('META_KEYWORDS_DEFAULT', 'penerbitan, karya ilmiah, ebook, jurnal, self publishing, indonesia');
define('META_OG_IMAGE_DEFAULT', IMG_URL . '/og-default.jpg');

/**
 * LIMITS & THRESHOLDS
 * Batasan-batasan dalam sistem
 */
define('MIN_WITHDRAW_AMOUNT', 100000); // Rp 100.000
define('MAX_WITHDRAW_AMOUNT', 10000000); // Rp 10.000.000
define('MIN_BOOK_PRICE', 10000); // Rp 10.000
define('MAX_BOOK_PRICE', 1000000); // Rp 1.000.000
define('MAX_LOGIN_SESSIONS', 3); // Max device login bersamaan

/**
 * TIME LIMITS
 * Batasan waktu dalam sistem
 */
define('PAYMENT_EXPIRY_TIME', 24 * 60 * 60); // 24 jam
define('DOWNLOAD_LINK_EXPIRY', 7 * 24 * 60 * 60); // 7 hari
define('PASSWORD_RESET_EXPIRY', 60 * 60); // 1 jam
define('EMAIL_VERIFICATION_EXPIRY', 24 * 60 * 60); // 24 jam

/**
 * REGEX PATTERNS
 * Pattern untuk validasi
 * 
 * TODO Backend: Gunakan untuk validasi input
 */
define('REGEX_EMAIL', '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/');
define('REGEX_PHONE', '/^(\+62|62|0)8[1-9][0-9]{6,10}$/');
define('REGEX_USERNAME', '/^[a-zA-Z0-9_]{3,20}$/');
define('REGEX_SLUG', '/^[a-z0-9]+(?:-[a-z0-9]+)*$/');

/**
 * ERROR MESSAGES
 * Pesan error standar
 * 
 * TODO Backend: Buat multi-language support
 */
define('ERROR_GENERAL', 'Terjadi kesalahan. Silakan coba lagi.');
define('ERROR_AUTH_REQUIRED', 'Silakan login terlebih dahulu.');
define('ERROR_PERMISSION_DENIED', 'Anda tidak memiliki akses ke halaman ini.');
define('ERROR_NOT_FOUND', 'Halaman yang Anda cari tidak ditemukan.');
define('ERROR_VALIDATION_FAILED', 'Data yang Anda masukkan tidak valid.');
define('ERROR_UPLOAD_FAILED', 'Gagal mengupload file. Silakan coba lagi.');

/**
 * SUCCESS MESSAGES
 * Pesan sukses standar
 */
define('SUCCESS_REGISTER', 'Registrasi berhasil! Silakan cek email untuk verifikasi.');
define('SUCCESS_LOGIN', 'Login berhasil! Selamat datang kembali.');
define('SUCCESS_BOOK_SUBMITTED', 'Buku berhasil disubmit! Tim kami akan mereview dalam 1-3 hari kerja.');
define('SUCCESS_PAYMENT', 'Pembayaran berhasil! Anda dapat mengunduh ebook sekarang.');
define('SUCCESS_WITHDRAW', 'Permintaan withdraw berhasil diajukan!');

/**
 * EMAIL TEMPLATES
 * ID template email
 * 
 * TODO Backend: Buat tabel email_templates di database
 */
define('EMAIL_WELCOME', 'welcome');
define('EMAIL_VERIFICATION', 'verification');
define('EMAIL_PASSWORD_RESET', 'password_reset');
define('EMAIL_BOOK_APPROVED', 'book_approved');
define('EMAIL_BOOK_REJECTED', 'book_rejected');
define('EMAIL_PAYMENT_SUCCESS', 'payment_success');
define('EMAIL_WITHDRAW_APPROVED', 'withdraw_approved');
define('EMAIL_ROYALTY_NOTIFICATION', 'royalty_notification');

/**
 * ACTIVITY LOG TYPES
 * Tipe activity untuk audit log
 * 
 * TODO Backend: Log semua aktivitas penting
 */
define('LOG_LOGIN', 'user_login');
define('LOG_LOGOUT', 'user_logout');
define('LOG_REGISTER', 'user_register');
define('LOG_BOOK_SUBMIT', 'book_submit');
define('LOG_BOOK_PUBLISH', 'book_publish');
define('LOG_PURCHASE', 'book_purchase');
define('LOG_WITHDRAW', 'withdraw_request');
define('LOG_ADMIN_ACTION', 'admin_action');

/**
 * SYSTEM MESSAGES
 * Pesan sistem untuk maintenance, dll
 */
define('MAINTENANCE_MODE', false);
define('MAINTENANCE_MESSAGE', 'Sistem sedang dalam perbaikan. Kami akan kembali secepatnya.');
define('SYSTEM_NOTICE', ''); // Isi jika ada pengumuman