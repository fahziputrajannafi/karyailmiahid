<?php
/**
 * FOOTER COMPONENT - KARYAILMIAH.ID
 * 
 * Footer universal yang digunakan di seluruh halaman
 * Includes: Links, contact info, social media, newsletter
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Footer links data
$footerLinks = [
    'layanan' => [
        'title' => 'Layanan',
        'links' => [
            ['label' => 'Penerbitan Individu', 'url' => '/layanan/penerbitan-individu'],
            ['label' => 'Penerbitan Kolaborasi', 'url' => '/layanan/penerbitan-kolaborasi'],
            ['label' => 'Editing & Proofreading', 'url' => '/layanan/editing'],
            ['label' => 'Paraphrase', 'url' => '/layanan/paraphrase'],
            ['label' => 'Translation', 'url' => '/layanan/translation']
        ]
    ],
    'panduan' => [
        'title' => 'Panduan',
        'links' => [
            ['label' => 'Cara Menerbitkan', 'url' => '/panduan/cara-menerbitkan'],
            ['label' => 'Panduan Penulis', 'url' => '/panduan/penulis'],
            ['label' => 'Panduan Publisher', 'url' => '/panduan/publisher'],
            ['label' => 'FAQ', 'url' => '/faq'],
            ['label' => 'Bantuan', 'url' => '/bantuan']
        ]
    ],
    'perusahaan' => [
        'title' => 'Perusahaan',
        'links' => [
            ['label' => 'Tentang Kami', 'url' => '/tentang'],
            ['label' => 'Tim Kami', 'url' => '/tim'],
            ['label' => 'Karir', 'url' => '/karir'],
            ['label' => 'Blog', 'url' => '/blog'],
            ['label' => 'Kontak', 'url' => '/kontak']
        ]
    ],
    'legal' => [
        'title' => 'Legal',
        'links' => [
            ['label' => 'Syarat & Ketentuan', 'url' => '/syarat-ketentuan'],
            ['label' => 'Kebijakan Privasi', 'url' => '/kebijakan-privasi'],
            ['label' => 'Kebijakan Refund', 'url' => '/kebijakan-refund'],
            ['label' => 'Hak Cipta', 'url' => '/hak-cipta']
        ]
    ]
];

// Social media links
$socialMedia = [
    ['icon' => 'facebook-f', 'url' => 'https://facebook.com/karyailmiah', 'label' => 'Facebook'],
    ['icon' => 'twitter', 'url' => 'https://twitter.com/karyailmiah', 'label' => 'Twitter'],
    ['icon' => 'instagram', 'url' => 'https://instagram.com/karyailmiah', 'label' => 'Instagram'],
    ['icon' => 'linkedin-in', 'url' => 'https://linkedin.com/company/karyailmiah', 'label' => 'LinkedIn'],
    ['icon' => 'youtube', 'url' => 'https://youtube.com/karyailmiah', 'label' => 'YouTube']
];

// Payment methods
$paymentMethods = [
    ['name' => 'BCA', 'logo' => 'bca.png'],
    ['name' => 'Mandiri', 'logo' => 'mandiri.png'],
    ['name' => 'BNI', 'logo' => 'bni.png'],
    ['name' => 'BRI', 'logo' => 'bri.png'],
    ['name' => 'GoPay', 'logo' => 'gopay.png'],
    ['name' => 'OVO', 'logo' => 'ovo.png'],
    ['name' => 'DANA', 'logo' => 'dana.png']
];
?>

    </main>
    <!-- Main Content End -->
    
    <!-- Footer -->
    <footer class="footer bg-navy text-white mt-5">
        <div class="container">
            <!-- Footer Top -->
            <div class="row py-5">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand mb-3">
                        <img src="<?= asset('images/logo-white.png') ?>" alt="KaryaIlmiah.id" height="40" class="mb-3">
                        <h5>KaryaIlmiah.id</h5>
                    </div>
                    <p class="text-white-50 mb-3">
                        Platform penerbitan karya ilmiah terpercaya di Indonesia. 
                        Terbitkan karya Anda dengan mudah dan dapatkan royalti hingga 60%.
                    </p>
                    
                    <!-- Contact Info -->
                    <div class="contact-info">
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <?= cms('contact_address', 'Jl. Pendidikan No. 123, Jakarta 12345') ?>
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:<?= cms('contact_phone', '+622112345678') ?>" class="text-white-50">
                                <?= cms('contact_phone', '+62 21 1234567') ?>
                            </a>
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:<?= cms('contact_email', 'info@karyailmiah.id') ?>" class="text-white-50">
                                <?= cms('contact_email', 'info@karyailmiah.id') ?>
                            </a>
                        </p>
                    </div>
                </div>
                
                <!-- Footer Links -->
                <?php foreach ($footerLinks as $section): ?>
                    <div class="col-lg-2 col-md-3 col-6 mb-4">
                        <h6 class="text-uppercase mb-3"><?= $section['title'] ?></h6>
                        <ul class="list-unstyled footer-links">
                            <?php foreach ($section['links'] as $link): ?>
                                <li class="mb-2">
                                    <a href="<?= url($link['url']) ?>" class="text-white-50">
                                        <?= $link['label'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Newsletter Section -->
            <div class="row py-4 border-top border-secondary">
                <div class="col-lg-6 mb-3">
                    <h5 class="mb-3">Berlangganan Newsletter</h5>
                    <p class="text-white-50 mb-3">
                        Dapatkan update terbaru tentang penerbitan, promo, dan tips menulis
                    </p>
                    <form class="newsletter-form" id="newsletter-form">
                        <div class="input-group">
                            <input type="email" 
                                   class="form-control" 
                                   placeholder="Email Anda" 
                                   required>
                            <button class="btn btn-accent" type="submit">
                                <i class="fas fa-paper-plane me-1"></i>
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Social Media -->
                <div class="col-lg-6 text-lg-end">
                    <h5 class="mb-3">Ikuti Kami</h5>
                    <div class="social-links">
                        <?php foreach ($socialMedia as $social): ?>
                            <a href="<?= $social['url'] ?>" 
                               class="btn btn-outline-light btn-sm rounded-circle me-2" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               title="<?= $social['label'] ?>">
                                <i class="fab fa-<?= $social['icon'] ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Payment Methods & Certifications -->
            <div class="row py-4 border-top border-secondary">
                <div class="col-md-6 mb-3">
                    <h6 class="text-uppercase mb-3">Metode Pembayaran</h6>
                    <div class="payment-methods d-flex flex-wrap gap-2">
                        <?php foreach ($paymentMethods as $payment): ?>
                            <img src="<?= asset('images/payment/' . $payment['logo']) ?>" 
                                 alt="<?= $payment['name'] ?>" 
                                 height="30" 
                                 class="bg-white rounded px-2">
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <h6 class="text-uppercase mb-3">Keamanan & Sertifikasi</h6>
                    <div class="certifications">
                        <img src="<?= asset('images/ssl-secured.png') ?>" alt="SSL Secured" height="40" class="me-2">
                        <img src="<?= asset('images/verified-publisher.png') ?>" alt="Verified Publisher" height="40">
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="footer-bottom text-center py-3 border-top border-secondary">
                <p class="mb-0 text-white-50">
                    &copy; <?= date('Y') ?> KaryaIlmiah.id. All rights reserved. 
                    <span class="d-none d-md-inline">|</span>
                    <br class="d-md-none">
                    Developed by <a href="#" class="text-accent">Frontend Team</a>
                </p>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button class="btn btn-primary btn-back-to-top" 
            id="backToTop" 
            title="Back to top"
            style="display: none;">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    <!-- JavaScript Files -->
    <script src="<?= asset('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= asset('js/main.js') ?>"></script>
    
    <?php if (isset($additionalJS)): ?>
        <?php foreach ($additionalJS as $js): ?>
            <script src="<?= asset($js) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Inline JavaScript for specific pages -->
    <?php if (isset($inlineJS)): ?>
        <script>
            <?= $inlineJS ?>
        </script>
    <?php endif; ?>
    
    <!-- Back to Top functionality -->
    <script>
        // Back to top button
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
        
        // Newsletter form
        document.getElementById('newsletter-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = e.target.querySelector('input[type="email"]').value;
            
            try {
                // TODO Backend: Implement newsletter subscription
                const response = await fetch('/api/ajax/subscribe-newsletter.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email })
                });
                
                if (response.ok) {
                    KaryaIlmiah.showAlert('Terima kasih! Anda berhasil berlangganan newsletter.', 'success');
                    e.target.reset();
                }
            } catch (error) {
                KaryaIlmiah.showAlert('Gagal berlangganan. Silakan coba lagi.', 'danger');
            }
        });
    </script>
    
    <!-- 
    TODO Backend:
    1. Implement newsletter subscription system
    2. Add tracking/analytics code
    3. Implement cookie consent banner
    4. Add live chat widget integration
    5. Implement service worker for PWA
    -->
    
    <!-- Additional CSS for footer components -->
    <style>
        /* Footer specific styles */
        .footer-links a {
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .footer-links a:hover {
            color: var(--primary-green) !important;
            padding-left: 5px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background-color: var(--primary-green) !important;
            border-color: var(--primary-green) !important;
            transform: translateY(-3px);
        }
        
        .payment-methods img {
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
        
        .payment-methods img:hover {
            opacity: 1;
        }
        
        .btn-back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            z-index: 999;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-back-to-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        }
        
        .newsletter-form .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }
        
        .newsletter-form .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        
        .newsletter-form .form-control:focus {
            background-color: rgba(255, 255, 255, 0.15);
            border-color: var(--accent-yellow);
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 199, 39, 0.25);
        }
    </style>
</body>
</html>