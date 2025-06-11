<?php
/**
 * HELPER FUNCTIONS KARYAILMIAH.ID
 * 
 * File ini berisi fungsi-fungsi helper yang digunakan di seluruh sistem
 * Termasuk: formatting, validation, security, UI helpers, dll
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(dirname(__FILE__)));
    require_once BASE_PATH . '/config/config.php';
}

/**
 * URL & ROUTING HELPERS
 */

/**
 * Generate URL lengkap dari path relatif
 * 
 * @param string $path Path relatif
 * @return string URL lengkap
 * 
 * TODO Backend: Implementasi URL rewriting di .htaccess
 */
function url($path = '') {
    return rtrim(SITE_URL, '/') . '/' . ltrim($path, '/');
}

/**
 * Generate asset URL
 * 
 * @param string $path Path asset relatif
 * @return string URL asset lengkap
 */
function asset($path) {
    return rtrim(ASSETS_URL, '/') . '/' . ltrim($path, '/');
}

/**
 * Redirect ke URL lain
 * 
 * @param string $url URL tujuan
 * @param int $code HTTP response code
 */
function redirect($url, $code = 302) {
    header("Location: $url", true, $code);
    exit;
}

/**
 * Get current page untuk navigation active state
 * 
 * @return string Current page name
 */
function getCurrentPage() {
    $path = $_SERVER['REQUEST_URI'];
    $path = parse_url($path, PHP_URL_PATH);
    $path = trim($path, '/');
    return $path ?: 'home';
}

/**
 * SECURITY HELPERS
 */

/**
 * Generate CSRF token field untuk form
 * 
 * @return string HTML hidden input dengan CSRF token
 * 
 * TODO Backend: Validate token di setiap form submission
 */
function csrfField() {
    $token = $_SESSION[CSRF_TOKEN_NAME] ?? '';
    return '<input type="hidden" name="' . CSRF_TOKEN_NAME . '" value="' . $token . '">';
}

/**
 * Sanitize input untuk mencegah XSS
 * 
 * @param string $input Input string
 * @return string Sanitized string
 */
function e($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

/**
 * Clean input untuk database
 * 
 * @param mixed $input Input data
 * @return mixed Cleaned data
 * 
 * TODO Backend: Gunakan prepared statements, bukan escape string
 */
function clean($input) {
    if (is_array($input)) {
        return array_map('clean', $input);
    }
    return trim(stripslashes($input));
}

/**
 * SESSION & AUTH HELPERS
 */

/**
 * Check apakah user sudah login
 * 
 * @return bool
 * 
 * TODO Backend: Implementasi proper session management
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0;
}

/**
 * Get current user ID
 * 
 * @return int|null User ID atau null jika belum login
 */
function getUserId() {
    return $_SESSION['user_id'] ?? null;
}

/**
 * Get current user data
 * 
 * @return array|null User data atau null
 * 
 * TODO Backend: Cache user data di session untuk performa
 */
function getUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    // Dummy data untuk frontend development
    return [
        'id' => getUserId(),
        'name' => $_SESSION['user_name'] ?? 'John Doe',
        'email' => $_SESSION['user_email'] ?? 'user@example.com',
        'role' => $_SESSION['user_role'] ?? ROLE_USER,
        'wallet_balance' => $_SESSION['wallet_balance'] ?? 0,
        'referral_code' => $_SESSION['referral_code'] ?? 'REF123456'
    ];
}

/**
 * Check apakah user memiliki role tertentu
 * 
 * @param int $role Role constant
 * @return bool
 */
function hasRole($role) {
    $user = getUser();
    return $user && $user['role'] >= $role;
}

/**
 * Check apakah user adalah admin (any level)
 * 
 * @return bool
 */
function isAdmin() {
    return hasRole(ROLE_ADMIN_PRODUCT);
}

/**
 * FORMATTING HELPERS
 */

/**
 * Format currency (Rupiah)
 * 
 * @param int|float $amount Jumlah uang
 * @param bool $withSymbol Include symbol Rp
 * @return string Formatted currency
 */
function formatCurrency($amount, $withSymbol = true) {
    $formatted = number_format($amount, 0, ',', '.');
    return $withSymbol ? 'Rp ' . $formatted : $formatted;
}

/**
 * Format tanggal Indonesia
 * 
 * @param string $date Tanggal
 * @param string $format Format output
 * @return string Formatted date
 */
function formatDate($date, $format = DATE_FORMAT) {
    if (empty($date)) return '-';
    
    $timestamp = strtotime($date);
    if (!$timestamp) return '-';
    
    // Array untuk nama hari dan bulan Indonesia
    $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    $months = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    $day = $days[date('w', $timestamp)];
    $date_num = date('j', $timestamp);
    $month = $months[date('n', $timestamp)];
    $year = date('Y', $timestamp);
    
    // Default format: "1 Januari 2024"
    if ($format === DATE_FORMAT) {
        return "$date_num $month $year";
    }
    
    // With day: "Senin, 1 Januari 2024"
    if ($format === 'full') {
        return "$day, $date_num $month $year";
    }
    
    // With time
    if ($format === DATETIME_FORMAT) {
        $time = date('H:i', $timestamp);
        return "$date_num $month $year $time";
    }
    
    return date($format, $timestamp);
}

/**
 * Format file size
 * 
 * @param int $bytes Size in bytes
 * @return string Formatted size
 */
function formatFileSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    
    while ($bytes >= 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    
    return round($bytes, 2) . ' ' . $units[$i];
}

/**
 * Generate slug from string
 * 
 * @param string $text Input text
 * @return string URL-friendly slug
 */
function generateSlug($text) {
    // Convert to lowercase
    $text = strtolower($text);
    
    // Remove special chars
    $text = preg_replace('/[^a-z0-9\s-]/', '', $text);
    
    // Replace spaces with dash
    $text = preg_replace('/\s+/', '-', $text);
    
    // Remove multiple dashes
    $text = preg_replace('/-+/', '-', $text);
    
    return trim($text, '-');
}

/**
 * Truncate text dengan ellipsis
 * 
 * @param string $text Text to truncate
 * @param int $length Max length
 * @param string $suffix Suffix to add
 * @return string Truncated text
 */
function truncate($text, $length = 100, $suffix = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    return substr($text, 0, $length - strlen($suffix)) . $suffix;
}

/**
 * UI HELPERS
 */

/**
 * Generate alert/notification HTML
 * 
 * @param string $message Pesan
 * @param string $type Type: success, danger, warning, info
 * @param bool $dismissible Bisa di-close atau tidak
 * @return string HTML alert
 */
function alert($message, $type = 'info', $dismissible = true) {
    $class = "alert alert-$type";
    if ($dismissible) {
        $class .= " alert-dismissible fade show";
    }
    
    $html = '<div class="' . $class . '" role="alert">';
    $html .= e($message);
    
    if ($dismissible) {
        $html .= '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
    }
    
    $html .= '</div>';
    
    return $html;
}

/**
 * Generate breadcrumb HTML
 * 
 * @param array $items Array of breadcrumb items ['label' => '', 'url' => '']
 * @return string HTML breadcrumb
 */
function breadcrumb($items) {
    if (empty($items)) return '';
    
    $html = '<nav aria-label="breadcrumb">';
    $html .= '<ol class="breadcrumb">';
    
    foreach ($items as $i => $item) {
        $isLast = ($i === count($items) - 1);
        
        if ($isLast) {
            $html .= '<li class="breadcrumb-item active">' . e($item['label']) . '</li>';
        } else {
            $html .= '<li class="breadcrumb-item">';
            $html .= '<a href="' . e($item['url']) . '">' . e($item['label']) . '</a>';
            $html .= '</li>';
        }
    }
    
    $html .= '</ol></nav>';
    
    return $html;
}

/**
 * Generate pagination HTML
 * 
 * @param int $currentPage Current page number
 * @param int $totalPages Total pages
 * @param string $baseUrl Base URL for pagination links
 * @return string HTML pagination
 */
function pagination($currentPage, $totalPages, $baseUrl) {
    if ($totalPages <= 1) return '';
    
    $html = '<nav><ul class="pagination">';
    
    // Previous button
    if ($currentPage > 1) {
        $html .= '<li class="page-item">';
        $html .= '<a class="page-link" href="' . $baseUrl . '?page=' . ($currentPage - 1) . '">Previous</a>';
        $html .= '</li>';
    } else {
        $html .= '<li class="page-item disabled">';
        $html .= '<span class="page-link">Previous</span>';
        $html .= '</li>';
    }
    
    // Page numbers
    $start = max(1, $currentPage - 2);
    $end = min($totalPages, $currentPage + 2);
    
    if ($start > 1) {
        $html .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=1">1</a></li>';
        if ($start > 2) {
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }
    
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $currentPage) {
            $html .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
        } else {
            $html .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $i . '">' . $i . '</a></li>';
        }
    }
    
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) {
            $html .= '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        $html .= '<li class="page-item"><a class="page-link" href="' . $baseUrl . '?page=' . $totalPages . '">' . $totalPages . '</a></li>';
    }
    
    // Next button
    if ($currentPage < $totalPages) {
        $html .= '<li class="page-item">';
        $html .= '<a class="page-link" href="' . $baseUrl . '?page=' . ($currentPage + 1) . '">Next</a>';
        $html .= '</li>';
    } else {
        $html .= '<li class="page-item disabled">';
        $html .= '<span class="page-link">Next</span>';
        $html .= '</li>';
    }
    
    $html .= '</ul></nav>';
    
    return $html;
}

/**
 * Get status badge HTML
 * 
 * @param string $status Status code
 * @param string $type Type of status (book, transaction, etc)
 * @return string HTML badge
 */
function statusBadge($status, $type = 'book') {
    $badges = [
        'book' => [
            BOOK_STATUS_DRAFT => ['secondary', 'Draft'],
            BOOK_STATUS_REVIEW => ['warning', 'Review'],
            BOOK_STATUS_EDITING => ['info', 'Editing'],
            BOOK_STATUS_APPROVED => ['primary', 'Approved'],
            BOOK_STATUS_PUBLISHED => ['success', 'Published'],
            BOOK_STATUS_REJECTED => ['danger', 'Rejected']
        ],
        'transaction' => [
            TRX_STATUS_PENDING => ['warning', 'Pending'],
            TRX_STATUS_PROCESSING => ['info', 'Processing'],
            TRX_STATUS_SUCCESS => ['success', 'Success'],
            TRX_STATUS_FAILED => ['danger', 'Failed'],
            TRX_STATUS_EXPIRED => ['secondary', 'Expired']
        ],
        'withdraw' => [
            WITHDRAW_PENDING => ['warning', 'Pending'],
            WITHDRAW_APPROVED => ['primary', 'Approved'],
            WITHDRAW_PROCESSING => ['info', 'Processing'],
            WITHDRAW_COMPLETED => ['success', 'Completed'],
            WITHDRAW_REJECTED => ['danger', 'Rejected']
        ]
    ];
    
    $config = $badges[$type][$status] ?? ['secondary', ucfirst($status)];
    
    return '<span class="badge bg-' . $config[0] . '">' . $config[1] . '</span>';
}

/**
 * DATA HELPERS
 */

/**
 * Get dummy books data untuk development
 * 
 * @param int $limit Jumlah buku
 * @return array Array of books
 * 
 * TODO Backend: Replace dengan query database
 */
function getDummyBooks($limit = 10) {
    $books = [];
    
    for ($i = 1; $i <= $limit; $i++) {
        $books[] = [
            'id' => $i,
            'title' => "Buku Ilmiah $i",
            'author' => "Dr. Author $i",
            'price' => rand(50000, 200000),
            'cover' => 'https://via.placeholder.com/200x300',
            'rating' => rand(35, 50) / 10,
            'sold' => rand(10, 1000),
            'category' => ['Teknologi', 'Pendidikan', 'Kesehatan'][rand(0, 2)],
            'publisher' => "Publisher $i"
        ];
    }
    
    return $books;
}

/**
 * Get categories list
 * 
 * @return array Categories
 * 
 * TODO Backend: Ambil dari database
 */
function getCategories() {
    return [
        'teknologi' => 'Teknologi',
        'pendidikan' => 'Pendidikan',
        'kesehatan' => 'Kesehatan',
        'ekonomi' => 'Ekonomi',
        'hukum' => 'Hukum',
        'sosial' => 'Sosial',
        'sains' => 'Sains',
        'bahasa' => 'Bahasa'
    ];
}

/**
 * VALIDATION HELPERS
 */

/**
 * Validate email format
 * 
 * @param string $email Email address
 * @return bool
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone number (Indonesia)
 * 
 * @param string $phone Phone number
 * @return bool
 */
function isValidPhone($phone) {
    return preg_match(REGEX_PHONE, $phone);
}

/**
 * Check if request is AJAX
 * 
 * @return bool
 */
function isAjax() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
           strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

/**
 * Get client IP address
 * 
 * @return string IP address
 */
function getClientIp() {
    $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
    
    foreach ($ipKeys as $key) {
        if (array_key_exists($key, $_SERVER) === true) {
            foreach (explode(',', $_SERVER[$key]) as $ip) {
                $ip = trim($ip);
                
                if (filter_var($ip, FILTER_VALIDATE_IP, 
                    FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                    return $ip;
                }
            }
        }
    }
    
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

/**
 * CMS HELPERS
 */

/**
 * Get CMS content by key
 * 
 * @param string $key Content key
 * @param string $default Default value if not found
 * @return string Content value
 * 
 * TODO Backend: Implement database query with caching
 */
function cms($key, $default = '') {
    // Dummy CMS data untuk development
    $content = [
        'hero_title' => 'Platform Penerbitan Karya Ilmiah #1 di Indonesia',
        'hero_subtitle' => 'Terbitkan karya ilmiah Anda dengan mudah, dapatkan royalti hingga 60%',
        'about_text' => 'KaryaIlmiah.id adalah platform terpercaya untuk penerbitan karya ilmiah di Indonesia.',
        'contact_address' => 'Jl. Pendidikan No. 123, Jakarta 12345',
        'contact_phone' => '+62 21 1234567',
        'contact_email' => 'info@karyailmiah.id'
    ];
    
    return $content[$key] ?? $default;
}

/**
 * Check if CMS content is editable by current user
 * 
 * @return bool
 */
function canEditCMS() {
    return isAdmin();
}

/**
 * LOG HELPERS
 */

/**
 * Log activity
 * 
 * @param string $type Activity type
 * @param string $message Log message
 * @param array $data Additional data
 * 
 * TODO Backend: Implement proper logging to database/file
 */
function logActivity($type, $message, $data = []) {
    if (!LOG_ERRORS) return;
    
    $log = [
        'timestamp' => date('Y-m-d H:i:s'),
        'type' => $type,
        'user_id' => getUserId(),
        'ip' => getClientIp(),
        'message' => $message,
        'data' => $data
    ];
    
    // For development, just error_log
    error_log(json_encode($log));
}

/**
 * Debug helper
 * 
 * @param mixed $data Data to debug
 * @param bool $die Stop execution
 */
function dd($data, $die = true) {
    if (!DEBUG_MODE) return;
    
    echo '<pre style="background:#f5f5f5;padding:10px;border:1px solid #ddd;">';
    var_dump($data);
    echo '</pre>';
    
    if ($die) die();
}