<?php
/**
 * USER SIDEBAR COMPONENT - KARYAILMIAH.ID
 * 
 * Komponen sidebar untuk dashboard user
 * Menampilkan menu navigasi sesuai role user
 * 
 * Required variables:
 * - $activePage: string nama halaman aktif
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Get current user
$user = getUser();
if (!$user) return;

// Define menu items based on role
$menuItems = [
    'dashboard' => [
        'label' => 'Dashboard',
        'icon' => 'tachometer-alt',
        'url' => '/dashboard',
        'roles' => [ROLE_USER]
    ],
    'ebook' => [
        'label' => 'eBook Saya',
        'icon' => 'book',
        'url' => '/dashboard/ebook',
        'roles' => [ROLE_USER]
    ],
    'publikasi' => [
        'label' => 'Publikasi Saya',
        'icon' => 'file-alt',
        'url' => '/dashboard/publikasi',
        'roles' => [ROLE_SELF_PUBLISHER, ROLE_PUBLISHER],
        'submenu' => [
            ['label' => 'Semua Publikasi', 'url' => '/dashboard/publikasi'],
            ['label' => 'Upload Baru', 'url' => '/dashboard/publikasi/upload'],
            ['label' => 'Draft', 'url' => '/dashboard/publikasi/draft'],
            ['label' => 'Dalam Review', 'url' => '/dashboard/publikasi/review']
        ]
    ],
    'kolaborasi' => [
        'label' => 'Kolaborasi',
        'icon' => 'users',
        'url' => '/dashboard/kolaborasi',
        'roles' => [ROLE_USER]
    ],
    'wallet' => [
        'label' => 'Wallet',
        'icon' => 'wallet',
        'url' => '/dashboard/wallet',
        'roles' => [ROLE_USER],
        'badge' => formatCurrency($user['wallet_balance'], false)
    ],
    'afiliasi' => [
        'label' => 'Program Afiliasi',
        'icon' => 'link',
        'url' => '/dashboard/afiliasi',
        'roles' => [ROLE_USER]
    ],
    'laporan' => [
        'label' => 'Laporan',
        'icon' => 'chart-line',
        'url' => '/dashboard/laporan',
        'roles' => [ROLE_SELF_PUBLISHER, ROLE_PUBLISHER],
        'submenu' => [
            ['label' => 'Penjualan', 'url' => '/dashboard/laporan/penjualan'],
            ['label' => 'Royalti', 'url' => '/dashboard/laporan/royalti'],
            ['label' => 'Statistik', 'url' => '/dashboard/laporan/statistik']
        ]
    ],
    'editor' => [
        'label' => 'Editor Panel',
        'icon' => 'edit',
        'url' => '/editor/workspace',
        'roles' => [ROLE_EDITOR]
    ],
    'pengaturan' => [
        'label' => 'Pengaturan',
        'icon' => 'cog',
        'url' => '/dashboard/pengaturan',
        'roles' => [ROLE_USER]
    ]
];

// Publisher specific menu
if (hasRole(ROLE_PUBLISHER)) {
    $menuItems['publisher'] = [
        'label' => 'Publisher Center',
        'icon' => 'building',
        'url' => '/publisher/manage',
        'roles' => [ROLE_PUBLISHER]
    ];
}
?>

<div class="sidebar-wrapper">
    <!-- User Profile Summary -->
    <div class="sidebar-profile mb-4">
        <div class="d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name=<?= urlencode($user['name']) ?>&background=20BBA4&color=fff" 
                 alt="<?= e($user['name']) ?>" 
                 class="rounded-circle me-3"
                 width="50" 
                 height="50">
            <div>
                <h6 class="mb-0"><?= e($user['name']) ?></h6>
                <small class="text-muted">
                    <?php
                    // Display role name
                    $roleNames = [
                        ROLE_USER => 'Member',
                        ROLE_SELF_PUBLISHER => 'Self-Publisher',
                        ROLE_PUBLISHER => 'Publisher',
                        ROLE_EDITOR => 'Editor',
                        ROLE_ADMIN_PRODUCT => 'Admin Produk',
                        ROLE_ADMIN_FINANCE => 'Admin Finance',
                        ROLE_SUPERADMIN => 'Superadmin',
                        ROLE_OWNER => 'Owner'
                    ];
                    echo $roleNames[$user['role']] ?? 'User';
                    ?>
                </small>
            </div>
        </div>
        
        <!-- Wallet Balance Card -->
        <div class="wallet-card mt-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted d-block">Saldo Wallet</small>
                    <h5 class="mb-0 text-primary"><?= formatCurrency($user['wallet_balance']) ?></h5>
                </div>
                <a href="<?= url('/dashboard/wallet/withdraw') ?>" 
                   class="btn btn-sm btn-accent"
                   title="Withdraw">
                    <i class="fas fa-arrow-up"></i>
                </a>
            </div>
        </div>
        
        <!-- Referral Code -->
        <div class="referral-card mt-3">
            <small class="text-muted d-block mb-1">Kode Referral</small>
            <div class="input-group input-group-sm">
                <input type="text" 
                       class="form-control" 
                       value="<?= e($user['referral_code']) ?>" 
                       readonly>
                <button class="btn btn-outline-primary copy-to-clipboard" 
                        type="button"
                        data-text="<?= e($user['referral_code']) ?>">
                    <i class="fas fa-copy"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <?php foreach ($menuItems as $key => $item): ?>
                <?php 
                // Check if user has permission for this menu
                if (!empty($item['roles']) && !in_array($user['role'], $item['roles'])) {
                    continue;
                }
                
                $isActive = ($activePage === $key);
                $hasSubmenu = !empty($item['submenu']);
                ?>
                
                <li class="nav-item <?= $hasSubmenu ? 'has-submenu' : '' ?>">
                    <?php if ($hasSubmenu): ?>
                        <!-- Menu with submenu -->
                        <a class="nav-link <?= $isActive ? 'active' : '' ?>" 
                           href="#<?= $key ?>Submenu" 
                           data-bs-toggle="collapse"
                           aria-expanded="<?= $isActive ? 'true' : 'false' ?>">
                            <i class="fas fa-<?= $item['icon'] ?> me-2"></i>
                            <?= $item['label'] ?>
                            <i class="fas fa-chevron-down ms-auto"></i>
                        </a>
                        
                        <div class="collapse <?= $isActive ? 'show' : '' ?>" id="<?= $key ?>Submenu">
                            <ul class="nav flex-column ms-3">
                                <?php foreach ($item['submenu'] as $subitem): ?>
                                    <li class="nav-item">
                                        <a class="nav-link py-2" href="<?= url($subitem['url']) ?>">
                                            <i class="fas fa-circle fa-xs me-2"></i>
                                            <?= $subitem['label'] ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Regular menu item -->
                        <a class="nav-link <?= $isActive ? 'active' : '' ?>" 
                           href="<?= url($item['url']) ?>">
                            <i class="fas fa-<?= $item['icon'] ?> me-2"></i>
                            <?= $item['label'] ?>
                            <?php if (!empty($item['badge'])): ?>
                                <span class="badge bg-primary ms-auto"><?= $item['badge'] ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    
    <!-- Sidebar Footer -->
    <div class="sidebar-footer mt-auto pt-4 border-top">
        <div class="d-grid gap-2">
            <a href="<?= url('/bantuan') ?>" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-question-circle me-1"></i> Bantuan
            </a>
            <a href="<?= url('/logout') ?>" class="btn btn-sm btn-danger">
                <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
        </div>
    </div>
</div>

<!-- Sidebar Styles -->
<style>
.sidebar-wrapper {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    height: calc(100vh - 120px);
    overflow-y: auto;
    box-shadow: var(--shadow-sm);
    display: flex;
    flex-direction: column;
}

/* Custom Scrollbar */
.sidebar-wrapper::-webkit-scrollbar {
    width: 6px;
}

.sidebar-wrapper::-webkit-scrollbar-track {
    background: var(--soft-gray);
}

.sidebar-wrapper::-webkit-scrollbar-thumb {
    background: var(--primary-green);
    border-radius: 3px;
}

/* Wallet Card */
.wallet-card {
    background: var(--primary-green-light);
    padding: 1rem;
    border-radius: var(--radius-md);
    border: 1px solid var(--primary-green);
}

/* Referral Card */
.referral-card {
    background: var(--soft-gray);
    padding: 1rem;
    border-radius: var(--radius-md);
}

.referral-card .form-control {
    background: white;
    font-family: monospace;
    font-weight: 600;
    letter-spacing: 1px;
}

/* Navigation */
.sidebar-nav {
    flex: 1;
}

.sidebar-nav .nav-link {
    color: var(--dark-navy);
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    align-items: center;
}

.sidebar-nav .nav-link:hover {
    background: var(--soft-gray);
    color: var(--primary-green);
    transform: translateX(5px);
}

.sidebar-nav .nav-link.active {
    background: var(--primary-green);
    color: white;
}

.sidebar-nav .nav-link.active i {
    color: white;
}

/* Submenu */
.has-submenu .nav-link[aria-expanded="true"] .fa-chevron-down {
    transform: rotate(180deg);
}

.has-submenu .fa-chevron-down {
    transition: transform 0.3s ease;
}

.sidebar-nav .collapse .nav-link {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
}

.sidebar-nav .collapse .nav-link:hover {
    transform: translateX(3px);
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .sidebar-wrapper {
        position: fixed;
        left: -280px;
        top: 0;
        width: 280px;
        height: 100vh;
        z-index: 1040;
        transition: left 0.3s ease;
    }
    
    .sidebar-wrapper.show {
        left: 0;
    }
    
    /* Overlay */
    .sidebar-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1039;
        display: none;
    }
    
    .sidebar-overlay.show {
        display: block;
    }
}

/* Sidebar Toggle Button (Mobile) */
.sidebar-toggle {
    display: none;
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 1041;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--primary-green);
    color: white;
    border: none;
    box-shadow: var(--shadow-lg);
}

@media (max-width: 991px) {
    .sidebar-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
    }
}
</style>

<!-- Sidebar JavaScript -->
<script>
// Mobile sidebar toggle
document.addEventListener('DOMContentLoaded', function() {
    const sidebarWrapper = document.querySelector('.sidebar-wrapper');
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebarWrapper.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        });
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            sidebarWrapper.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });
    }
});
</script>