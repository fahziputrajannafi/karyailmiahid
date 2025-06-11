<?php
/**
 * ALERT COMPONENT - KARYAILMIAH.ID
 * 
 * Komponen reusable untuk menampilkan alert/notifikasi
 * Supports: success, danger, warning, info
 * 
 * Required variables:
 * - $alertType: string (success, danger, warning, info)
 * - $alertMessage: string pesan yang akan ditampilkan
 * 
 * Optional variables:
 * - $alertDismissible: boolean untuk dismissible alert (default: true)
 * - $alertIcon: string icon class (default: auto based on type)
 * - $alertTitle: string judul alert (optional)
 * - $alertActions: array tombol aksi (optional)
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Default values
$alertDismissible = $alertDismissible ?? true;
$alertTitle = $alertTitle ?? null;
$alertActions = $alertActions ?? [];

// Auto-select icon based on type if not provided
if (!isset($alertIcon)) {
    $iconMap = [
        'success' => 'check-circle',
        'danger' => 'exclamation-circle',
        'warning' => 'exclamation-triangle',
        'info' => 'info-circle'
    ];
    $alertIcon = $iconMap[$alertType] ?? 'info-circle';
}

// Background colors for different types
$bgColors = [
    'success' => 'alert-success-custom',
    'danger' => 'alert-danger-custom',
    'warning' => 'alert-warning-custom',
    'info' => 'alert-info-custom'
];

$bgClass = $bgColors[$alertType] ?? 'alert-info-custom';
?>

<div class="alert <?= $bgClass ?> <?= $alertDismissible ? 'alert-dismissible' : '' ?> fade show custom-alert" 
     role="alert"
     data-aos="fade-down"
     data-aos-duration="500">
    
    <div class="d-flex align-items-start">
        <!-- Icon -->
        <div class="alert-icon me-3">
            <i class="fas fa-<?= e($alertIcon) ?> fa-lg"></i>
        </div>
        
        <!-- Content -->
        <div class="alert-content flex-grow-1">
            <?php if ($alertTitle): ?>
                <h5 class="alert-heading mb-1"><?= e($alertTitle) ?></h5>
            <?php endif; ?>
            
            <p class="mb-0"><?= e($alertMessage) ?></p>
            
            <?php if (!empty($alertActions)): ?>
                <div class="alert-actions mt-3">
                    <?php foreach ($alertActions as $action): ?>
                        <a href="<?= e($action['url'] ?? '#') ?>" 
                           class="btn btn-sm <?= e($action['class'] ?? 'btn-outline-primary') ?> me-2">
                            <?php if (!empty($action['icon'])): ?>
                                <i class="fas fa-<?= e($action['icon']) ?> me-1"></i>
                            <?php endif; ?>
                            <?= e($action['label']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Close button -->
        <?php if ($alertDismissible): ?>
            <button type="button" 
                    class="btn-close ms-3" 
                    data-bs-dismiss="alert" 
                    aria-label="Close"></button>
        <?php endif; ?>
    </div>
</div>

<!-- Additional styles for custom alerts -->
<style>
.custom-alert {
    border: none;
    border-radius: var(--radius-lg);
    padding: 1.25rem 1.5rem;
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
}

.custom-alert::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
}

/* Success Alert */
.alert-success-custom {
    background-color: rgba(40, 167, 69, 0.1);
    color: #155724;
}

.alert-success-custom::before {
    background-color: #28a745;
}

.alert-success-custom .alert-icon {
    color: #28a745;
}

/* Danger Alert */
.alert-danger-custom {
    background-color: rgba(220, 53, 69, 0.1);
    color: #721c24;
}

.alert-danger-custom::before {
    background-color: #dc3545;
}

.alert-danger-custom .alert-icon {
    color: #dc3545;
}

/* Warning Alert */
.alert-warning-custom {
    background-color: rgba(255, 193, 7, 0.1);
    color: #856404;
}

.alert-warning-custom::before {
    background-color: #ffc107;
}

.alert-warning-custom .alert-icon {
    color: #ffc107;
}

/* Info Alert */
.alert-info-custom {
    background-color: rgba(23, 162, 184, 0.1);
    color: #0c5460;
}

.alert-info-custom::before {
    background-color: #17a2b8;
}

.alert-info-custom .alert-icon {
    color: #17a2b8;
}

/* Alert Components */
.alert-icon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert-heading {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.alert-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

/* Animation */
@keyframes slideInDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.custom-alert {
    animation: slideInDown 0.3s ease-out;
}

/* Close button styling */
.custom-alert .btn-close {
    opacity: 0.5;
    transition: opacity 0.3s ease;
}

.custom-alert .btn-close:hover {
    opacity: 1;
}

/* Responsive */
@media (max-width: 576px) {
    .custom-alert {
        padding: 1rem;
        font-size: 0.9rem;
    }
    
    .alert-heading {
        font-size: 1rem;
    }
    
    .alert-actions .btn {
        font-size: 0.8rem;
        padding: 0.25rem 0.75rem;
    }
}
</style>

<?php
/**
 * USAGE EXAMPLES:
 * 
 * Basic usage:
 * $alertType = 'success';
 * $alertMessage = 'Buku berhasil ditambahkan ke keranjang!';
 * include 'includes/components/alert.php';
 * 
 * With title:
 * $alertType = 'warning';
 * $alertTitle = 'Perhatian!';
 * $alertMessage = 'Saldo wallet Anda tidak mencukupi.';
 * include 'includes/components/alert.php';
 * 
 * With actions:
 * $alertType = 'info';
 * $alertTitle = 'Verifikasi Email';
 * $alertMessage = 'Silakan verifikasi email Anda untuk melanjutkan.';
 * $alertActions = [
 *     ['label' => 'Kirim Ulang', 'url' => '/resend-email', 'icon' => 'envelope'],
 *     ['label' => 'Bantuan', 'url' => '/help', 'class' => 'btn-outline-secondary', 'icon' => 'question-circle']
 * ];
 * include 'includes/components/alert.php';
 * 
 * Non-dismissible:
 * $alertType = 'danger';
 * $alertMessage = 'Akses ditolak. Anda tidak memiliki izin.';
 * $alertDismissible = false;
 * include 'includes/components/alert.php';
 */
?>

<!-- Helper function for session flash messages -->
<?php
/**
 * Display flash messages from session
 * Call this function after including header.php
 * 
 * TODO Backend: Set $_SESSION['flash'] with type and message
 */
function displayFlashMessages() {
    if (!isset($_SESSION['flash'])) return;
    
    $flash = $_SESSION['flash'];
    
    // Display each flash message
    foreach ($flash as $type => $messages) {
        if (!is_array($messages)) {
            $messages = [$messages];
        }
        
        foreach ($messages as $message) {
            $alertType = $type;
            $alertMessage = $message;
            include 'includes/components/alert.php';
        }
    }
    
    // Clear flash messages after displaying
    unset($_SESSION['flash']);
}

/**
 * Helper function to set flash message
 * 
 * @param string $type Alert type (success, danger, warning, info)
 * @param string $message Message to display
 */
function setFlashMessage($type, $message) {
    if (!isset($_SESSION['flash'])) {
        $_SESSION['flash'] = [];
    }
    
    if (!isset($_SESSION['flash'][$type])) {
        $_SESSION['flash'][$type] = [];
    }
    
    $_SESSION['flash'][$type][] = $message;
}
?>