<?php
/**
 * HEADER COMPONENT - KARYAILMIAH.ID
 * 
 * Header universal yang digunakan di seluruh halaman
 * Includes: Navigation, user menu, search, responsive mobile menu
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Ensure functions are loaded
if (!function_exists('url')) {
    require_once BASE_PATH . '/includes/functions.php';
}

// Get current user data
$currentUser = getUser();
$isLoggedIn = isLoggedIn();
$cartCount = $_SESSION['cart_count'] ?? 0;

// Define navigation items based on user role
$navItems = [
    ['label' => 'Beranda', 'url' => '/', 'icon' => 'home'],
    ['label' => 'Katalog', 'url' => '/katalog', 'icon' => 'book'],
    ['label' => 'Kolaborasi', 'url' => '/kolaborasi', 'icon' => 'users'],
    ['label' => 'Layanan', 'url' => '/layanan', 'icon' => 'briefcase', 'dropdown' => [
        ['label' => 'Penerbitan Individu', 'url' => '/layanan/penerbitan-individu'],
        ['label' => 'Penerbitan Kolaborasi', 'url' => '/layanan/penerbitan-kolaborasi'],
        ['label' => 'Editing', 'url' => '/layanan/editing'],
        ['label' => 'Proofreading', 'url' => '/layanan/proofreading'],
        ['label' => 'Paraphrase', 'url' => '/layanan/paraphrase'],
        ['label' => 'Translation', 'url' => '/layanan/translation']
    ]],
    ['label' => 'Blog', 'url' => '/blog', 'icon' => 'newspaper']
];

// Admin menu items
$adminItems = [];
if (hasRole(ROLE_ADMIN_PRODUCT)) {
    $adminItems[] = ['label' => 'Admin Panel', 'url' => '/admin', 'icon' => 'cog'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO Meta Tags -->
    <title><?= e($pageTitle ?? 'KaryaIlmiah.id') ?> - Platform Penerbitan Karya Ilmiah</title>
    <meta name="description" content="<?= e($pageDescription ?? META_DESCRIPTION_DEFAULT) ?>">
    <meta name="keywords" content="<?= e($pageKeywords ?? META_KEYWORDS_DEFAULT) ?>">
    <meta name="author" content="KaryaIlmiah.id">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?= e($pageTitle ?? 'KaryaIlmiah.id') ?>">
    <meta property="og:description" content="<?= e($pageDescription ?? META_DESCRIPTION_DEFAULT) ?>">
    <meta property="og:image" content="<?= e($pageImage ?? META_OG_IMAGE_DEFAULT) ?>">
    <meta property="og:url" content="<?= url() ?>">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($pageTitle ?? 'KaryaIlmiah.id') ?>">
    <meta name="twitter:description" content="<?= e($pageDescription ?? META_DESCRIPTION_DEFAULT) ?>">
    <meta name="twitter:image" content="<?= e($pageImage ?? META_OG_IMAGE_DEFAULT) ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= asset('images/favicon.png') ?>">
    <link rel="apple-touch-icon" href="<?= asset('images/apple-touch-icon.png') ?>">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    <?php if (isset($additionalCSS)): ?>
        <?php foreach ($additionalCSS as $css): ?>
            <link rel="stylesheet" href="<?= asset($css) ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js -->
    <script defer src="<?= asset('js/alpine.min.js') ?>"></script>
    
    <!-- 
    TODO Backend: Tambahkan tracking codes (Google Analytics, etc)
    TODO Backend: Implementasi schema.org structured data
    -->
</head>
<body>
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>
    
    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="<?= url('/') ?>">
                <img src="<?= asset('images/logo.png') ?>" alt="KaryaIlmiah.id Logo" height="40">
                <span class="d-none d-sm-inline">KaryaIlmiah.id</span>
            </a>
            
            <!-- Mobile Menu Toggle -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <?php foreach ($navItems as $item): ?>
                        <?php if (isset($item['dropdown'])): ?>
                            <!-- Dropdown Menu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-<?= $item['icon'] ?> me-1"></i>
                                    <?= $item['label'] ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($item['dropdown'] as $subItem): ?>
                                        <li>
                                            <a class="dropdown-item" href="<?= url($subItem['url']) ?>">
                                                <?= $subItem['label'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <!-- Regular Menu Item -->
                            <li class="nav-item">
                                <a class="nav-link <?= getCurrentPage() === trim($item['url'], '/') ? 'active' : '' ?>" 
                                   href="<?= url($item['url']) ?>">
                                    <i class="fas fa-<?= $item['icon'] ?> me-1 d-lg-none"></i>
                                    <?= $item['label'] ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    
                    <?php foreach ($adminItems as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= url($item['url']) ?>">
                                <i class="fas fa-<?= $item['icon'] ?> me-1"></i>
                                <?= $item['label'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                
                <!-- Search Form (Desktop) -->
                <form class="search-form d-none d-lg-flex me-3" role="search">
                    <div class="input-group">
                        <input type="search" 
                               class="form-control search-input" 
                               placeholder="Cari buku..." 
                               aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                
                <!-- User Menu -->
                <ul class="navbar-nav">
                    <?php if ($isLoggedIn): ?>
                        <!-- Cart -->
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="<?= url('/cart') ?>" title="Keranjang">
                                <i class="fas fa-shopping-cart"></i>
                                <?php if ($cartCount > 0): ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                                        <?= $cartCount ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                        
                        <!-- Notifications -->
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                                    <span class="visually-hidden">New notifications</span>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="min-width: 300px;">
                                <h6 class="dropdown-header">Notifikasi</h6>
                                <div class="dropdown-divider"></div>
                                <!-- 
                                TODO Backend: Load notifications via AJAX
                                -->
                                <a class="dropdown-item" href="#">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-check-circle text-success"></i>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <p class="mb-0">Buku Anda telah disetujui</p>
                                            <small class="text-muted">2 jam yang lalu</small>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center" href="<?= url('/notifications') ?>">
                                    Lihat semua notifikasi
                                </a>
                            </div>
                        </li>
                        
                        <!-- User Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" 
                               href="#" 
                               role="button" 
                               data-bs-toggle="dropdown">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($currentUser['name']) ?>&background=20BBA4&color=fff" 
                                     alt="User Avatar" 
                                     class="rounded-circle me-2" 
                                     width="32" 
                                     height="32">
                                <span class="d-none d-lg-inline"><?= e($currentUser['name']) ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="<?= url('/dashboard') ?>">
                                        <i class="fas fa-tachometer-alt me-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= url('/profile') ?>">
                                        <i class="fas fa-user me-2"></i>
                                        Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= url('/dashboard/wallet') ?>">
                                        <i class="fas fa-wallet me-2"></i>
                                        Wallet: <?= formatCurrency($currentUser['wallet_balance']) ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?= url('/logout') ?>">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <!-- Login/Register Buttons -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?= url('/login') ?>">
                                <i class="fas fa-sign-in-alt me-1"></i>
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm" href="<?= url('/register') ?>">
                                <i class="fas fa-user-plus me-1"></i>
                                Daftar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Mobile Search (shown below navbar on mobile) -->
    <div class="mobile-search d-lg-none bg-light py-2">
        <div class="container">
            <form class="search-form" role="search">
                <div class="input-group">
                    <input type="search" 
                           class="form-control search-input" 
                           placeholder="Cari buku, penulis, atau penerbit..." 
                           aria-label="Search">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Alert Container for JavaScript alerts -->
    <div class="alert-container"></div>
    
    <!-- Main Content Start -->
    <main id="main-content">
    
    <!-- 
    TODO Backend: 
    1. Implement session management untuk user data
    2. Create notification system dengan real-time updates
    3. Implement cart functionality dengan AJAX
    4. Add search autocomplete dengan Elasticsearch/Algolia
    5. Cache navigation menu untuk performance
    -->