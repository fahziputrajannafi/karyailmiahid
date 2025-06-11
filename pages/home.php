<?php
/**
 * HOMEPAGE - KARYAILMIAH.ID
 * 
 * Halaman utama website dengan sections:
 * - Hero banner dengan search
 * - Service highlights
 * - Best sellers
 * - Discounted books
 * - New arrivals
 * - Publisher showcase
 * - Partners
 * - Blog articles
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Page configuration
$pageTitle = 'Beranda';
$pageDescription = 'Platform penerbitan karya ilmiah terpercaya di Indonesia. Terbitkan buku, jurnal, dan karya ilmiah dengan royalti hingga 60%.';

// Include header
require_once 'includes/header.php';

// Get dummy data untuk development
$bestSellers = getDummyBooks(10);
$discountedBooks = getDummyBooks(10);
$newBooks = getDummyBooks(10);

// TODO Backend: Replace dengan data dari database
?>

<!-- Hero Section dengan Background Pattern -->
<section class="hero-section position-relative overflow-hidden">
    <div class="hero-pattern"></div>
    <div class="container py-5">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-3" data-aos="fade-right">
                    <?= cms('hero_title', 'Platform Penerbitan Karya Ilmiah #1 di Indonesia') ?>
                </h1>
                <p class="lead mb-4" data-aos="fade-right" data-aos-delay="100">
                    <?= cms('hero_subtitle', 'Terbitkan karya ilmiah Anda dengan mudah, dapatkan royalti hingga 60%') ?>
                </p>
                
                <!-- Search Form -->
                <form class="hero-search mb-4" data-aos="fade-right" data-aos-delay="200">
                    <div class="input-group input-group-lg">
                        <input type="search" 
                               class="form-control" 
                               placeholder="Cari buku, penulis, atau penerbit...">
                        <button class="btn btn-primary px-4" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                
                <!-- CTA Buttons -->
                <div class="d-flex flex-wrap gap-3" data-aos="fade-right" data-aos-delay="300">
                    <a href="<?= url('/register') ?>" class="btn btn-accent btn-lg">
                        <i class="fas fa-rocket me-2"></i>
                        Mulai Terbitkan
                    </a>
                    <a href="<?= url('/katalog') ?>" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-book-open me-2"></i>
                        Jelajahi Katalog
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="hero-image text-center" data-aos="fade-left">
                    <img src="<?= asset('images/hero-illustration.svg') ?>" 
                         alt="Publishing Illustration" 
                         class="img-fluid">
                </div>
            </div>
        </div>
        
        <!-- Stats Counter -->
        <div class="row mt-5 text-center">
            <div class="col-6 col-md-3 mb-3" data-aos="fade-up">
                <h3 class="counter text-primary mb-0" data-target="5000" data-duration="2000">0</h3>
                <p class="text-muted">Buku Terbit</p>
            </div>
            <div class="col-6 col-md-3 mb-3" data-aos="fade-up" data-aos-delay="100">
                <h3 class="counter text-primary mb-0" data-target="3000" data-duration="2000">0</h3>
                <p class="text-muted">Penulis Aktif</p>
            </div>
            <div class="col-6 col-md-3 mb-3" data-aos="fade-up" data-aos-delay="200">
                <h3 class="counter text-primary mb-0" data-target="100000" data-duration="2000">0</h3>
                <p class="text-muted">Download</p>
            </div>
            <div class="col-6 col-md-3 mb-3" data-aos="fade-up" data-aos-delay="300">
                <h3 class="counter text-primary mb-0" data-target="98" data-duration="2000">0</h3>
                <span class="text-primary">%</span>
                <p class="text-muted">Kepuasan</p>
            </div>
        </div>
    </div>
</section>

<!-- Service Highlights Section -->
<section class="highlights-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold" data-aos="fade-down">Layanan Unggulan Kami</h2>
            <p class="lead text-muted" data-aos="fade-down" data-aos-delay="100">
                Solusi lengkap untuk kebutuhan penerbitan karya ilmiah Anda
            </p>
        </div>
        
        <div class="row g-4">
            <!-- Penerbitan Individu -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <div class="service-card h-100 text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h4>Penerbitan Individu</h4>
                    <p class="text-muted">Self-publishing dengan royalti hingga 60%. Kontrol penuh atas karya Anda.</p>
                    <a href="<?= url('/layanan/penerbitan-individu') ?>" class="btn btn-sm btn-outline-primary mt-3">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            
            <!-- Penerbitan Kolaborasi -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card h-100 text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Penerbitan Kolaborasi</h4>
                    <p class="text-muted">Bergabung dengan penulis lain dalam proyek kolaborasi yang menarik.</p>
                    <a href="<?= url('/layanan/penerbitan-kolaborasi') ?>" class="btn btn-sm btn-outline-primary mt-3">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            
            <!-- Editing & Proofreading -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card h-100 text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-spell-check"></i>
                    </div>
                    <h4>Editing & Proofreading</h4>
                    <p class="text-muted">Layanan editorial profesional untuk kesempurnaan karya Anda.</p>
                    <a href="<?= url('/layanan/editing') ?>" class="btn btn-sm btn-outline-primary mt-3">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            
            <!-- Paraphrase -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card h-100 text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h4>Paraphrase</h4>
                    <p class="text-muted">Layanan parafrase untuk meningkatkan orisinalitas tulisan.</p>
                    <a href="<?= url('/layanan/paraphrase') ?>" class="btn btn-sm btn-outline-primary mt-3">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            
            <!-- Cek Plagiasi -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="service-card h-100 text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-search-plus"></i>
                    </div>
                    <h4>Cek Plagiasi</h4>
                    <p class="text-muted">Pastikan karya Anda bebas plagiarisme dengan teknologi terkini.</p>
                    <a href="<?= url('/layanan/cek-plagiasi') ?>" class="btn btn-sm btn-outline-primary mt-3">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            
            <!-- Translation -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="service-card h-100 text-center p-4">
                    <div class="service-icon mb-3">
                        <i class="fas fa-language"></i>
                    </div>
                    <h4>Translation</h4>
                    <p class="text-muted">Layanan penerjemahan akademik berkualitas tinggi.</p>
                    <a href="<?= url('/layanan/translation') ?>" class="btn btn-sm btn-outline-primary mt-3">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Best Seller Section -->
<section class="bestseller-section py-5">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0" data-aos="fade-right">
                <i class="fas fa-fire text-danger"></i> Best Seller
            </h2>
            <a href="<?= url('/katalog?sort=bestseller') ?>" class="btn btn-link text-primary" data-aos="fade-left">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <!-- Book Slider -->
        <div class="book-slider" data-aos="fade-up">
            <div class="row g-3 flex-nowrap overflow-auto pb-3">
                <?php foreach (array_slice($bestSellers, 0, 10) as $book): ?>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2-4">
                        <?php 
                        $showActions = true;
                        $cardClass = 'book-card-small';
                        include 'includes/components/book-card.php'; 
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Discounted Books Section -->
<section class="discount-section py-5 bg-light">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0" data-aos="fade-right">
                <i class="fas fa-tags text-warning"></i> E-Book Turun Harga
            </h2>
            <a href="<?= url('/katalog?filter=discount') ?>" class="btn btn-link text-primary" data-aos="fade-left">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <!-- Book Grid -->
        <div class="row g-3" data-aos="fade-up">
            <?php foreach (array_slice($discountedBooks, 0, 10) as $book): ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2-4">
                    <?php 
                    // Add discount badge
                    $book['discount'] = rand(10, 50);
                    $book['original_price'] = $book['price'] * (100 / (100 - $book['discount']));
                    $showActions = true;
                    $cardClass = 'book-card-small discount-card';
                    include 'includes/components/book-card.php'; 
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- New Books Section -->
<section class="newbooks-section py-5">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0" data-aos="fade-right">
                <i class="fas fa-sparkles text-primary"></i> Buku Terbaru
            </h2>
            <a href="<?= url('/katalog?sort=newest') ?>" class="btn btn-link text-primary" data-aos="fade-left">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <!-- Book Grid -->
        <div class="row g-3" data-aos="fade-up">
            <?php foreach (array_slice($newBooks, 0, 10) as $book): ?>
                <div class="col-6 col-md-4 col-lg-3 col-xl-2-4">
                    <?php 
                    $showActions = true;
                    $cardClass = 'book-card-small';
                    include 'includes/components/book-card.php'; 
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA Banner Section -->
<section class="cta-banner-section py-5 bg-gradient">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="text-white mb-3">Siap Menerbitkan Karya Ilmiah Anda?</h2>
                <p class="text-white-50 lead mb-0">
                    Bergabunglah dengan ribuan penulis yang telah mempercayakan karya mereka kepada kami
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0" data-aos="fade-left">
                <a href="<?= url('/register') ?>" class="btn btn-accent btn-lg">
                    <i class="fas fa-rocket me-2"></i>
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Publisher Showcase Section -->
<section class="publisher-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" data-aos="fade-down">Jelajahi Toko Publisher</h2>
            <p class="lead text-muted" data-aos="fade-down" data-aos-delay="100">
                Temukan karya berkualitas dari penerbit terpercaya
            </p>
        </div>
        
        <div class="row g-4" data-aos="fade-up">
            <?php 
            // TODO Backend: Get publisher data from database
            $publishers = [
                ['name' => 'Universitas Indonesia Press', 'books' => 156, 'logo' => 'ui-press.png'],
                ['name' => 'ITB Press', 'books' => 203, 'logo' => 'itb-press.png'],
                ['name' => 'UGM Press', 'books' => 189, 'logo' => 'ugm-press.png'],
                ['name' => 'Airlangga University Press', 'books' => 142, 'logo' => 'unair-press.png'],
                ['name' => 'Brawijaya Press', 'books' => 98, 'logo' => 'ub-press.png'],
                ['name' => 'IPB Press', 'books' => 167, 'logo' => 'ipb-press.png']
            ];
            
            foreach ($publishers as $publisher): 
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="publisher-card">
                    <div class="d-flex align-items-center">
                        <img src="<?= asset('images/publishers/' . $publisher['logo']) ?>" 
                             alt="<?= e($publisher['name']) ?>" 
                             class="publisher-logo me-3">
                        <div>
                            <h5 class="mb-1"><?= e($publisher['name']) ?></h5>
                            <p class="text-muted small mb-0"><?= e($publisher['books']) ?> buku tersedia</p>
                        </div>
                    </div>
                    <a href="<?= url('/publisher/' . generateSlug($publisher['name'])) ?>" 
                       class="stretched-link"></a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="<?= url('/publishers') ?>" class="btn btn-outline-primary">
                Lihat Semua Publisher <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="partners-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold" data-aos="fade-down">Partner Kami</h2>
            <p class="lead text-muted" data-aos="fade-down" data-aos-delay="100">
                Dipercaya oleh institusi pendidikan terkemuka di Indonesia
            </p>
        </div>
        
        <div class="partner-logos" data-aos="fade-up">
            <?php 
            $partners = [
                'Universitas Indonesia', 'ITB', 'UGM', 'IPB', 'Unair', 
                'ITS', 'Undip', 'Unpad', 'USU', 'Unhas', 'UB', 'UI'
            ];
            
            foreach ($partners as $partner): 
            ?>
            <div class="partner-logo-wrapper">
                <img src="https://via.placeholder.com/150x80/f8f9fa/6c757d?text=<?= urlencode($partner) ?>" 
                     alt="<?= e($partner) ?>" 
                     class="partner-logo">
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <p class="text-muted">dan 999+ institusi lainnya</p>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="blog-section py-5">
    <div class="container">
        <div class="section-header d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold mb-0" data-aos="fade-right">Blog & Artikel</h2>
            <a href="<?= url('/blog') ?>" class="btn btn-link text-primary" data-aos="fade-left">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="row g-4" data-aos="fade-up">
            <?php 
            // TODO Backend: Get blog posts from database
            $blogPosts = [
                [
                    'title' => 'Tips Menulis Karya Ilmiah yang Baik dan Benar',
                    'excerpt' => 'Pelajari cara menulis karya ilmiah yang memenuhi standar akademik...',
                    'author' => 'Dr. Ahmad Wijaya',
                    'date' => '2024-01-15',
                    'category' => 'Tips Menulis',
                    'image' => 'blog-1.jpg',
                    'read_time' => '5 menit'
                ],
                [
                    'title' => 'Memahami Proses Peer Review dalam Publikasi Ilmiah',
                    'excerpt' => 'Peer review adalah tahapan penting dalam publikasi karya ilmiah...',
                    'author' => 'Prof. Siti Nurhaliza',
                    'date' => '2024-01-12',
                    'category' => 'Publikasi',
                    'image' => 'blog-2.jpg',
                    'read_time' => '7 menit'
                ],
                [
                    'title' => 'Pentingnya Indexing untuk Karya Ilmiah Anda',
                    'excerpt' => 'Indexing membantu karya ilmiah Anda lebih mudah ditemukan...',
                    'author' => 'Dr. Budi Santoso',
                    'date' => '2024-01-10',
                    'category' => 'Indexing',
                    'image' => 'blog-3.jpg',
                    'read_time' => '4 menit'
                ]
            ];
            
            foreach ($blogPosts as $post): 
            ?>
            <div class="col-lg-4 col-md-6">
                <article class="blog-card h-100">
                    <div class="blog-image">
                        <img src="https://via.placeholder.com/400x250/20BBA4/ffffff?text=Blog" 
                             alt="<?= e($post['title']) ?>" 
                             class="img-fluid">
                        <span class="blog-category"><?= e($post['category']) ?></span>
                    </div>
                    <div class="blog-content">
                        <h4 class="blog-title">
                            <a href="<?= url('/blog/' . generateSlug($post['title'])) ?>">
                                <?= e($post['title']) ?>
                            </a>
                        </h4>
                        <p class="blog-excerpt"><?= e($post['excerpt']) ?></p>
                        <div class="blog-meta">
                            <span class="blog-author">
                                <i class="fas fa-user-circle"></i> <?= e($post['author']) ?>
                            </span>
                            <span class="blog-date">
                                <i class="fas fa-calendar"></i> <?= formatDate($post['date']) ?>
                            </span>
                        </div>
                        <a href="<?= url('/blog/' . generateSlug($post['title'])) ?>" 
                           class="btn btn-link text-primary p-0 mt-3">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Quick View Modal -->
<div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Additional CSS for Homepage -->
<style>
/* Hero Section Styles */
.hero-section {
    background: linear-gradient(135deg, var(--primary-green-light) 0%, var(--accent-yellow-light) 100%);
    position: relative;
}

.hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%2320BBA4' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.min-vh-50 {
    min-height: 50vh;
}

.hero-search .form-control {
    border-radius: 50px 0 0 50px;
    padding: 1rem 1.5rem;
    border: 2px solid var(--primary-green);
    border-right: none;
}

.hero-search .btn {
    border-radius: 0 50px 50px 0;
    padding: 1rem 2rem;
    border: 2px solid var(--primary-green);
    border-left: none;
}

/* Service Cards */
.service-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 2rem;
    transition: all 0.3s ease;
    border: 1px solid var(--medium-gray);
    height: 100%;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary-green);
}

.service-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto;
    background: var(--primary-green-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--primary-green);
    transition: all 0.3s ease;
}

.service-card:hover .service-icon {
    background: var(--primary-green);
    color: white;
    transform: scale(1.1);
}

/* Book Cards Small */
.book-card-small .book-cover {
    height: 200px;
}

.book-card-small .card-body {
    padding: 1rem;
}

.book-card-small .book-title {
    font-size: 0.9rem;
    -webkit-line-clamp: 1;
}

.book-card-small .book-author {
    font-size: 0.8rem;
}

/* Book Slider */
.book-slider {
    position: relative;
}

.book-slider .row {
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: thin;
    scrollbar-color: var(--primary-green) var(--medium-gray);
}

.book-slider .row::-webkit-scrollbar {
    height: 8px;
}

.book-slider .row::-webkit-scrollbar-track {
    background: var(--medium-gray);
    border-radius: 10px;
}

.book-slider .row::-webkit-scrollbar-thumb {
    background: var(--primary-green);
    border-radius: 10px;
}

/* Column for 5 items per row */
.col-xl-2-4 {
    flex: 0 0 20%;
    max-width: 20%;
}

@media (max-width: 1199px) {
    .col-xl-2-4 {
        flex: 0 0 25%;
        max-width: 25%;
    }
}

/* Discount Card */
.discount-card .book-cover {
    position: relative;
}

.discount-card .book-cover::before {
    content: attr(data-discount) '% OFF';
    position: absolute;
    top: 10px;
    right: 10px;
    background: var(--danger);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    font-weight: bold;
}

/* CTA Banner */
.bg-gradient {
    background: linear-gradient(135deg, var(--primary-green) 0%, var(--primary-green-hover) 100%);
}

/* Publisher Card */
.publisher-card {
    background: white;
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    border: 1px solid var(--medium-gray);
    transition: all 0.3s ease;
    position: relative;
}

.publisher-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary-green);
}

.publisher-logo {
    width: 60px;
    height: 60px;
    object-fit: contain;
}

/* Partner Logos */
.partner-logos {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 2rem;
}

.partner-logo-wrapper {
    flex: 0 0 auto;
}

.partner-logo {
    height: 60px;
    width: auto;
    filter: grayscale(100%);
    opacity: 0.6;
    transition: all 0.3s ease;
}

.partner-logo:hover {
    filter: grayscale(0%);
    opacity: 1;
    transform: scale(1.1);
}

/* Blog Cards */
.blog-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.blog-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.blog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.blog-card:hover .blog-image img {
    transform: scale(1.1);
}

.blog-category {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: var(--primary-green);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
}

.blog-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.blog-title {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

.blog-title a {
    color: var(--dark-navy);
    text-decoration: none;
    transition: color 0.3s ease;
}

.blog-title a:hover {
    color: var(--primary-green);
}

.blog-excerpt {
    color: var(--text-gray);
    margin-bottom: 1rem;
    flex-grow: 1;
}

.blog-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.875rem;
    color: var(--text-gray);
}

.blog-meta i {
    margin-right: 0.25rem;
}

/* Counter Animation */
.counter {
    font-size: 2.5rem;
    font-weight: 700;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2rem;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 1rem;
    }
    
    .col-xl-2-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
    
    .service-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .publisher-card {
        padding: 1rem;
    }
    
    .publisher-logo {
        width: 40px;
        height: 40px;
    }
}
</style>

<!-- Additional JavaScript -->
<script>
// Initialize AOS (Animate On Scroll)
document.addEventListener('DOMContentLoaded', function() {
    // Simulated AOS effect
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    // Observe all elements with data-aos
    document.querySelectorAll('[data-aos]').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease';
        observer.observe(el);
    });
});
</script>

<?php
// Include footer
require_once 'includes/footer.php';
?>