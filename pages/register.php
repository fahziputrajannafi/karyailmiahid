<?php
/**
 * REGISTER PAGE - KARYAILMIAH.ID
 * 
 * Halaman registrasi dengan multi-step form
 * Features: Real-time validation, password strength, terms acceptance
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Page configuration
$pageTitle = 'Daftar';
$pageDescription = 'Daftar akun KaryaIlmiah.id dan mulai terbitkan karya Anda';

// Don't show header/footer for auth pages
$authPage = true;

// TODO Backend: Handle registration logic here
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    // Validate input
    // Check if email exists
    // Create user account
    // Send verification email
    // Auto login or redirect to login
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> - KaryaIlmiah.id</title>
    <meta name="description" content="<?= $pageDescription ?>">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom styles for auth pages -->
    <style>
        body {
            background: linear-gradient(135deg, var(--accent-yellow-light) 0%, var(--primary-green-light) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        /* Animated background shapes */
        .bg-shape {
            position: absolute;
            opacity: 0.1;
        }
        
        .bg-shape-1 {
            width: 400px;
            height: 400px;
            background: var(--accent-yellow);
            border-radius: 50%;
            top: -200px;
            left: -200px;
            animation: float 25s ease-in-out infinite;
        }
        
        .bg-shape-2 {
            width: 250px;
            height: 250px;
            background: var(--primary-green);
            border-radius: 50%;
            bottom: -125px;
            right: -125px;
            animation: float 20s ease-in-out infinite reverse;
        }
        
        .bg-shape-3 {
            width: 200px;
            height: 200px;
            background: var(--accent-yellow);
            border-radius: 40% 60% 60% 40% / 40% 40% 60% 60%;
            top: 40%;
            right: 15%;
            animation: morph 10s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
            33% { transform: translate(30px, -30px) scale(1.05) rotate(120deg); }
            66% { transform: translate(-20px, 20px) scale(0.95) rotate(240deg); }
        }
        
        @keyframes morph {
            0%, 100% { border-radius: 40% 60% 60% 40% / 40% 40% 60% 60%; }
            33% { border-radius: 60% 40% 40% 60% / 60% 60% 40% 40%; }
            66% { border-radius: 40% 60% 60% 40% / 60% 40% 40% 60%; }
        }
        
        .auth-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .auth-card {
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
            min-height: 700px;
        }
        
        .auth-left {
            flex: 1.2;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 600px;
        }
        
        .auth-right {
            flex: 1;
            background: linear-gradient(135deg, var(--accent-yellow) 0%, var(--accent-yellow-hover) 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--dark-navy);
            position: relative;
            overflow: hidden;
        }
        
        .auth-right::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            animation: rotate 35s linear infinite reverse;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Multi-step form */
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        
        .step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--medium-gray);
            color: var(--text-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .step.active {
            background: var(--primary-green);
            color: white;
            transform: scale(1.1);
        }
        
        .step.completed {
            background: var(--success);
            color: white;
        }
        
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 2px;
            background: var(--medium-gray);
            transition: background 0.3s ease;
        }
        
        .step.completed:not(:last-child)::after {
            background: var(--success);
        }
        
        .form-step {
            display: none;
        }
        
        .form-step.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Password strength indicator */
        .password-strength {
            margin-top: 0.5rem;
        }
        
        .strength-bar {
            height: 4px;
            background: var(--medium-gray);
            border-radius: 2px;
            overflow: hidden;
            margin-bottom: 0.25rem;
        }
        
        .strength-fill {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        
        .strength-weak { width: 33%; background: var(--danger); }
        .strength-medium { width: 66%; background: var(--warning); }
        .strength-strong { width: 100%; background: var(--success); }
        
        /* Form styling */
        .form-floating {
            margin-bottom: 1rem;
        }
        
        .form-control, .form-select {
            border-radius: var(--radius-md);
            padding: 1rem;
            height: auto;
            font-size: 1rem;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px var(--primary-green-light);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--text-gray);
            background: none;
            border: none;
            padding: 5px;
            z-index: 10;
        }
        
        /* Terms checkbox */
        .form-check-input:checked {
            background-color: var(--primary-green);
            border-color: var(--primary-green);
        }
        
        /* Role selection */
        .role-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .role-card {
            border: 2px solid var(--medium-gray);
            border-radius: var(--radius-md);
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .role-card:hover {
            border-color: var(--primary-green);
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }
        
        .role-card.selected {
            border-color: var(--primary-green);
            background: var(--primary-green-light);
        }
        
        .role-card input[type="radio"] {
            position: absolute;
            opacity: 0;
        }
        
        .role-icon {
            font-size: 2.5rem;
            color: var(--primary-green);
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
            }
            
            .auth-right {
                padding: 2rem;
                min-height: 200px;
            }
            
            .auth-left {
                padding: 2rem;
            }
            
            .role-options {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Animated background shapes -->
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3"></div>
    
    <div class="auth-container">
        <div class="auth-card">
            <!-- Left side - Register Form -->
            <div class="auth-left">
                <!-- Logo -->
                <div class="text-center mb-4">
                    <a href="<?= url('/') ?>">
                        <img src="<?= asset('images/logo.png') ?>" alt="KaryaIlmiah.id" height="50">
                    </a>
                </div>
                
                <h2 class="text-center mb-2">Bergabung Bersama Kami</h2>
                <p class="text-center text-muted mb-4">
                    Mulai perjalanan penerbitan karya ilmiah Anda
                </p>
                
                <!-- Step Indicator -->
                <div class="step-indicator">
                    <div class="step active" data-step="1">1</div>
                    <div class="step" data-step="2">2</div>
                    <div class="step" data-step="3">3</div>
                </div>
                
                <!-- Multi-step Form -->
                <form method="POST" action="" class="needs-validation" novalidate id="registerForm">
                    <?= csrfField() ?>
                    
                    <!-- Step 1: Account Type -->
                    <div class="form-step active" data-step="1">
                        <h5 class="mb-3">Pilih Tipe Akun</h5>
                        
                        <div class="role-options">
                            <label class="role-card">
                                <input type="radio" name="account_type" value="reader" checked>
                                <div class="role-icon">
                                    <i class="fas fa-book-reader"></i>
                                </div>
                                <h6>Pembaca</h6>
                                <small class="text-muted">Beli dan baca karya ilmiah</small>
                            </label>
                            
                            <label class="role-card">
                                <input type="radio" name="account_type" value="author">
                                <div class="role-icon">
                                    <i class="fas fa-pen-fancy"></i>
                                </div>
                                <h6>Penulis</h6>
                                <small class="text-muted">Terbitkan karya Anda</small>
                            </label>
                            
                            <label class="role-card">
                                <input type="radio" name="account_type" value="publisher">
                                <div class="role-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <h6>Publisher</h6>
                                <small class="text-muted">Kelola penerbitan institusi</small>
                            </label>
                            
                            <label class="role-card">
                                <input type="radio" name="account_type" value="editor">
                                <div class="role-icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <h6>Editor</h6>
                                <small class="text-muted">Layanan editorial</small>
                            </label>
                        </div>
                        
                        <button type="button" class="btn btn-primary btn-lg w-100 next-step">
                            Lanjutkan <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </div>
                    
                    <!-- Step 2: Personal Information -->
                    <div class="form-step" data-step="2">
                        <h5 class="mb-3">Informasi Pribadi</h5>
                        
                        <!-- Full Name -->
                        <div class="form-floating mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   id="fullname" 
                                   name="fullname" 
                                   placeholder="Nama Lengkap"
                                   required>
                            <label for="fullname">
                                <i class="fas fa-user me-2"></i>Nama Lengkap
                            </label>
                            <div class="invalid-feedback">
                                Masukkan nama lengkap Anda
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="form-floating mb-3">
                            <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   placeholder="Email"
                                   required>
                            <label for="email">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <div class="invalid-feedback">
                                Masukkan email yang valid
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="form-floating mb-3">
                            <input type="tel" 
                                   class="form-control" 
                                   id="phone" 
                                   name="phone" 
                                   placeholder="Nomor HP"
                                   pattern="^(\+62|62|0)8[1-9][0-9]{6,10}$"
                                   required>
                            <label for="phone">
                                <i class="fas fa-phone me-2"></i>Nomor HP
                            </label>
                            <div class="invalid-feedback">
                                Masukkan nomor HP yang valid (contoh: 08123456789)
                            </div>
                        </div>
                        
                        <!-- Institution (for publisher/editor) -->
                        <div class="form-floating mb-3 institution-field" style="display: none;">
                            <input type="text" 
                                   class="form-control" 
                                   id="institution" 
                                   name="institution" 
                                   placeholder="Nama Institusi">
                            <label for="institution">
                                <i class="fas fa-building me-2"></i>Nama Institusi
                            </label>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-lg flex-fill prev-step">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-primary btn-lg flex-fill next-step">
                                Lanjutkan <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Security -->
                    <div class="form-step" data-step="3">
                        <h5 class="mb-3">Keamanan Akun</h5>
                        
                        <!-- Password -->
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" 
                                   class="form-control" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Password"
                                   required
                                   minlength="8">
                            <label for="password">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <button type="button" class="password-toggle" tabindex="-1">
                                <i class="fas fa-eye"></i>
                            </button>
                            <div class="invalid-feedback">
                                Password minimal 8 karakter
                            </div>
                        </div>
                        
                        <!-- Password Strength -->
                        <div class="password-strength mb-3">
                            <div class="strength-bar">
                                <div class="strength-fill"></div>
                            </div>
                            <small class="strength-text text-muted">Masukkan password</small>
                        </div>
                        
                        <!-- Confirm Password -->
                        <div class="form-floating mb-3 position-relative">
                            <input type="password" 
                                   class="form-control" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Konfirmasi Password"
                                   required>
                            <label for="password_confirmation">
                                <i class="fas fa-lock me-2"></i>Konfirmasi Password
                            </label>
                            <button type="button" class="password-toggle" tabindex="-1">
                                <i class="fas fa-eye"></i>
                            </button>
                            <div class="invalid-feedback">
                                Password tidak cocok
                            </div>
                        </div>
                        
                        <!-- Referral Code (optional) -->
                        <div class="form-floating mb-3">
                            <input type="text" 
                                   class="form-control" 
                                   id="referral_code" 
                                   name="referral_code" 
                                   placeholder="Kode Referral (opsional)">
                            <label for="referral_code">
                                <i class="fas fa-gift me-2"></i>Kode Referral (opsional)
                            </label>
                        </div>
                        
                        <!-- Terms & Conditions -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="terms" 
                                   name="terms"
                                   required>
                            <label class="form-check-label" for="terms">
                                Saya setuju dengan 
                                <a href="<?= url('/syarat-ketentuan') ?>" target="_blank">Syarat & Ketentuan</a>
                                dan 
                                <a href="<?= url('/kebijakan-privasi') ?>" target="_blank">Kebijakan Privasi</a>
                            </label>
                            <div class="invalid-feedback">
                                Anda harus menyetujui syarat & ketentuan
                            </div>
                        </div>
                        
                        <!-- Newsletter -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="newsletter" 
                                   name="newsletter"
                                   checked>
                            <label class="form-check-label" for="newsletter">
                                Saya ingin menerima update dan penawaran menarik
                            </label>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-lg flex-fill prev-step">
                                <i class="fas fa-arrow-left me-2"></i> Kembali
                            </button>
                            <button type="submit" class="btn btn-primary btn-lg flex-fill">
                                <i class="fas fa-user-plus me-2"></i> Daftar
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Login link -->
                <p class="text-center mt-4 mb-0">
                    Sudah punya akun? 
                    <a href="<?= url('/login') ?>" class="text-primary fw-semibold">
                        Masuk di sini
                    </a>
                </p>
            </div>
            
            <!-- Right side - Info -->
            <div class="auth-right">
                <div class="text-center position-relative">
                    <h3 class="mb-4">Mengapa Bergabung?</h3>
                    
                    <div class="benefits">
                        <div class="benefit-item mb-4 text-start">
                            <div class="d-flex align-items-start">
                                <div class="benefit-icon me-3">
                                    <i class="fas fa-rocket fa-2x"></i>
                                </div>
                                <div>
                                    <h5>Proses Cepat</h5>
                                    <p class="mb-0">Terbitkan karya dalam hitungan hari, bukan bulan</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="benefit-item mb-4 text-start">
                            <div class="d-flex align-items-start">
                                <div class="benefit-icon me-3">
                                    <i class="fas fa-chart-line fa-2x"></i>
                                </div>
                                <div>
                                    <h5>Royalti Tinggi</h5>
                                    <p class="mb-0">Dapatkan hingga 60% dari setiap penjualan</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="benefit-item mb-4 text-start">
                            <div class="d-flex align-items-start">
                                <div class="benefit-icon me-3">
                                    <i class="fas fa-globe fa-2x"></i>
                                </div>
                                <div>
                                    <h5>Jangkauan Luas</h5>
                                    <p class="mb-0">Karya Anda dapat diakses pembaca di seluruh Indonesia</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="benefit-item text-start">
                            <div class="d-flex align-items-start">
                                <div class="benefit-icon me-3">
                                    <i class="fas fa-shield-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h5>Aman & Terpercaya</h5>
                                    <p class="mb-0">Hak cipta Anda dilindungi dengan sistem keamanan terbaik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Back to home -->
        <div class="text-center mt-4">
            <a href="<?= url('/') ?>" class="text-dark">
                <i class="fas fa-arrow-left me-2"></i>
                Kembali ke beranda
            </a>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="<?= asset('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Multi-step form handler
        const form = document.getElementById('registerForm');
        const steps = document.querySelectorAll('.form-step');
        const stepIndicators = document.querySelectorAll('.step');
        let currentStep = 1;
        
        // Next step buttons
        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {
                if (validateStep(currentStep)) {
                    goToStep(currentStep + 1);
                }
            });
        });
        
        // Previous step buttons
        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                goToStep(currentStep - 1);
            });
        });
        
        // Go to specific step
        function goToStep(step) {
            // Hide current step
            steps[currentStep - 1].classList.remove('active');
            stepIndicators[currentStep - 1].classList.remove('active');
            
            // Mark as completed if moving forward
            if (step > currentStep) {
                stepIndicators[currentStep - 1].classList.add('completed');
            }
            
            // Show new step
            currentStep = step;
            steps[currentStep - 1].classList.add('active');
            stepIndicators[currentStep - 1].classList.add('active');
        }
        
        // Validate current step
        function validateStep(step) {
            const currentStepElement = steps[step - 1];
            const inputs = currentStepElement.querySelectorAll('input[required]');
            let valid = true;
            
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
            
            return valid;
        }
        
        // Role selection
        document.querySelectorAll('.role-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
                
                // Show/hide institution field
                const accountType = this.querySelector('input').value;
                const institutionField = document.querySelector('.institution-field');
                
                if (accountType === 'publisher' || accountType === 'editor') {
                    institutionField.style.display = 'block';
                    institutionField.querySelector('input').setAttribute('required', 'required');
                } else {
                    institutionField.style.display = 'none';
                    institutionField.querySelector('input').removeAttribute('required');
                }
            });
        });
        
        // Password toggle
        document.querySelectorAll('.password-toggle').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });
        
        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthFill = document.querySelector('.strength-fill');
        const strengthText = document.querySelector('.strength-text');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Length check
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            
            // Character variety
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            // Update UI
            strengthFill.className = 'strength-fill';
            
            if (strength <= 2) {
                strengthFill.classList.add('strength-weak');
                strengthText.textContent = 'Password lemah';
                strengthText.className = 'strength-text text-danger';
            } else if (strength <= 4) {
                strengthFill.classList.add('strength-medium');
                strengthText.textContent = 'Password cukup kuat';
                strengthText.className = 'strength-text text-warning';
            } else {
                strengthFill.classList.add('strength-strong');
                strengthText.textContent = 'Password sangat kuat';
                strengthText.className = 'strength-text text-success';
            }
        });
        
        // Password confirmation validation
        const passwordConfirm = document.getElementById('password_confirmation');
        
        passwordConfirm.addEventListener('input', function() {
            if (this.value !== passwordInput.value) {
                this.setCustomValidity('Password tidak cocok');
                this.classList.add('is-invalid');
            } else {
                this.setCustomValidity('');
                this.classList.remove('is-invalid');
            }
        });
        
        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!this.checkValidity() || !validateStep(3)) {
                e.stopPropagation();
                this.classList.add('was-validated');
                return;
            }
            
            // Add loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Mendaftar...';
            submitBtn.disabled = true;
            
            // Submit form
            // TODO: Actually submit the form
            setTimeout(() => {
                this.submit();
            }, 1000);
        });
        
        // Remove validation classes on input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    </script>
</body>
</html>