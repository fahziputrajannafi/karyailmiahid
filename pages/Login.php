<?php
/**
 * LOGIN PAGE - KARYAILMIAH.ID
 * 
 * Halaman login dengan design modern dan animasi
 * Features: Remember me, social login, password recovery
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Page configuration
$pageTitle = 'Login';
$pageDescription = 'Masuk ke akun KaryaIlmiah.id Anda';

// Don't show header/footer for auth pages
$authPage = true;

// Get redirect URL if any
$redirect = $_GET['redirect'] ?? '/dashboard';

// TODO Backend: Handle login logic here
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    // Validate credentials
    // Set session
    // Redirect to $redirect
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
            background: linear-gradient(135deg, var(--primary-green-light) 0%, var(--accent-yellow-light) 100%);
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
            width: 300px;
            height: 300px;
            background: var(--primary-green);
            border-radius: 50%;
            top: -150px;
            right: -150px;
            animation: float 20s ease-in-out infinite;
        }
        
        .bg-shape-2 {
            width: 200px;
            height: 200px;
            background: var(--accent-yellow);
            border-radius: 50%;
            bottom: -100px;
            left: -100px;
            animation: float 15s ease-in-out infinite reverse;
        }
        
        .bg-shape-3 {
            width: 150px;
            height: 150px;
            background: var(--primary-green);
            border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            top: 50%;
            left: 10%;
            animation: morph 8s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -30px) scale(1.05); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
        }
        
        @keyframes morph {
            0%, 100% { border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%; }
            33% { border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%; }
            66% { border-radius: 30% 70% 70% 30% / 70% 30% 30% 70%; }
        }
        
        .auth-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .auth-card {
            background: white;
            border-radius: var(--radius-xl);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            min-height: 600px;
        }
        
        .auth-left {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .auth-right {
            flex: 1;
            background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-hover) 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .auth-right::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .form-floating {
            margin-bottom: 1rem;
        }
        
        .form-control {
            border-radius: var(--radius-md);
            padding: 1rem;
            height: auto;
            font-size: 1rem;
        }
        
        .form-control:focus {
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
        
        .social-login {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-btn {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid var(--medium-gray);
            border-radius: var(--radius-md);
            background: white;
            transition: all 0.3s ease;
            text-decoration: none;
            color: var(--dark-navy);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        .social-btn.google:hover {
            border-color: #4285f4;
            color: #4285f4;
        }
        
        .social-btn.facebook:hover {
            border-color: #1877f2;
            color: #1877f2;
        }
        
        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: var(--medium-gray);
        }
        
        .divider span {
            background: white;
            padding: 0 1rem;
            position: relative;
            color: var(--text-gray);
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
            <!-- Left side - Login Form -->
            <div class="auth-left">
                <!-- Logo -->
                <div class="text-center mb-4">
                    <a href="<?= url('/') ?>">
                        <img src="<?= asset('images/logo.png') ?>" alt="KaryaIlmiah.id" height="50">
                    </a>
                </div>
                
                <h2 class="text-center mb-2">Selamat Datang Kembali!</h2>
                <p class="text-center text-muted mb-4">
                    Masuk ke akun Anda untuk melanjutkan
                </p>
                
                <?php
                // Display any flash messages
                if (isset($_SESSION['flash'])) {
                    displayFlashMessages();
                }
                ?>
                
                <!-- Login Form -->
                <form method="POST" action="" class="needs-validation" novalidate>
                    <?= csrfField() ?>
                    <input type="hidden" name="redirect" value="<?= e($redirect) ?>">
                    
                    <!-- Email -->
                    <div class="form-floating mb-3">
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email" 
                               placeholder="Email"
                               required
                               autofocus>
                        <label for="email">
                            <i class="fas fa-envelope me-2"></i>Email
                        </label>
                        <div class="invalid-feedback">
                            Masukkan email yang valid
                        </div>
                    </div>
                    
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
                    
                    <!-- Remember me & Forgot password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="remember" 
                                   name="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                        <a href="<?= url('/forgot-password') ?>" class="text-primary">
                            Lupa password?
                        </a>
                    </div>
                    
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Masuk
                    </button>
                    
                    <!-- Register link -->
                    <p class="text-center mb-0">
                        Belum punya akun? 
                        <a href="<?= url('/register') ?>" class="text-primary fw-semibold">
                            Daftar sekarang
                        </a>
                    </p>
                </form>
                
                <!-- Divider -->
                <div class="divider">
                    <span>atau masuk dengan</span>
                </div>
                
                <!-- Social Login -->
                <div class="social-login">
                    <a href="#" class="social-btn google">
                        <img src="https://www.google.com/favicon.ico" alt="Google" width="20">
                        Google
                    </a>
                    <a href="#" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i>
                        Facebook
                    </a>
                </div>
            </div>
            
            <!-- Right side - Info -->
            <div class="auth-right">
                <div class="text-center position-relative">
                    <h3 class="mb-4">Platform Penerbitan Karya Ilmiah #1</h3>
                    
                    <div class="features mb-4">
                        <div class="feature-item mb-3">
                            <i class="fas fa-check-circle me-2"></i>
                            Royalti hingga 60% untuk self-publisher
                        </div>
                        <div class="feature-item mb-3">
                            <i class="fas fa-check-circle me-2"></i>
                            Proses penerbitan mudah dan cepat
                        </div>
                        <div class="feature-item mb-3">
                            <i class="fas fa-check-circle me-2"></i>
                            Dukungan editorial profesional
                        </div>
                        <div class="feature-item mb-3">
                            <i class="fas fa-check-circle me-2"></i>
                            Indexing otomatis ke Google Scholar
                        </div>
                    </div>
                    
                    <div class="stats">
                        <div class="row text-center">
                            <div class="col-4">
                                <h4 class="mb-0">5K+</h4>
                                <small>Buku Terbit</small>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0">3K+</h4>
                                <small>Penulis</small>
                            </div>
                            <div class="col-4">
                                <h4 class="mb-0">100K+</h4>
                                <small>Download</small>
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
        // Form validation
        (function () {
            'use strict'
            
            const forms = document.querySelectorAll('.needs-validation')
            
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
        })()
        
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
        
        // Add loading state on form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            if (this.checkValidity()) {
                const btn = this.querySelector('button[type="submit"]');
                btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                btn.disabled = true;
            }
        });
    </script>
</body>
</html>