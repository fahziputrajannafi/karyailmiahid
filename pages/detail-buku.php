<?php
/**
 * DETAIL BUKU PAGE - KARYAILMIAH.ID
 * 
 * Halaman detail buku individual dengan fitur:
 * - Informasi lengkap buku
 * - Preview/sample reading
 * - Reviews dan rating
 * - Related books
 * - Add to cart/wishlist
 * 
 * BACKEND TODO:
 * 1. Load data buku dari database berdasarkan ID
 * 2. Implementasi sistem review dan rating
 * 3. Tracking view count untuk analytics
 * 4. Related books algorithm (ML-based)
 * 5. Preview system dengan watermark
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Load konfigurasi
require_once '../config/config.php';

// Get book ID dari URL parameter
$bookId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$bookId) {
    // Redirect ke 404 jika ID tidak valid
    header('HTTP/1.0 404 Not Found');
    include '../pages/error/404.php';
    exit;
}

// BACKEND TODO: Load book data dari database
// Query: SELECT * FROM books WHERE id = ? AND status = 'published'
// Include: author info, publisher info, categories, reviews

// Dummy data untuk development
$book = [
    'id' => $bookId,
    'title' => 'Metodologi Penelitian Kuantitatif Modern',
    'subtitle' => 'Pendekatan Statistik dalam Penelitian Ilmiah',
    'author' => 'Dr. Ahmad Fauzi, M.Si',
    'author_bio' => 'Profesor di bidang Statistik dan Metodologi Penelitian dengan pengalaman 15 tahun.',
    'publisher' => 'UI Press',
    'publication_date' => '2024-01-15',
    'pages' => 245,
    'isbn' => '978-602-123-456-7',
    'language' => 'Bahasa Indonesia',
    'format' => ['PDF', 'EPUB'],
    'price' => 125000,
    'original_price' => 150000,
    'discount' => 17,
    'cover' => 'https://via.placeholder.com/400x600/20BBA4/ffffff?text=Book+Cover',
    'description' => 'Buku ini membahas metodologi penelitian kuantitatif dengan pendekatan modern yang mencakup penggunaan software statistik terkini...',
    'table_of_contents' => [
        'Bab 1: Pengantar Metodologi Penelitian',
        'Bab 2: Desain Penelitian Kuantitatif', 
        'Bab 3: Sampling dan Populasi',
        'Bab 4: Instrumen Penelitian',
        'Bab 5: Analisis Data Statistik',
        'Bab 6: Interpretasi Hasil',
        'Bab 7: Pelaporan Penelitian'
    ],
    'tags' => ['Metodologi', 'Penelitian', 'Statistik', 'Kuantitatif'],
    'category' => 'Metodologi Penelitian',
    'rating' => 4.5,
    'review_count' => 128,
    'sold_count' => 1250,
    'view_count' => 5420,
    'file_size' => 15.2, // MB
    'sample_url' => '/uploads/samples/book-' . $bookId . '-sample.pdf',
    'preview_pages' => 10
];

// BACKEND TODO: Track page view untuk analytics
// UPDATE books SET view_count = view_count + 1 WHERE id = ?
// INSERT INTO book_views (book_id, user_id, ip_address, user_agent, viewed_at)

// Load related books (algorithm-based)
// BACKEND TODO: Implementasi recommendation engine
$relatedBooks = getDummyBooks(4);

// Load reviews dengan pagination
// BACKEND TODO: Load dari database dengan proper pagination
$reviews = [
    [
        'id' => 1,
        'user_name' => 'Prof. Siti Nurhaliza',
        'user_avatar' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=20BBA4&color=fff',
        'rating' => 5,
        'comment' => 'Buku yang sangat komprehensif dan mudah dipahami. Sangat membantu untuk mahasiswa S2 dan S3.',
        'date' => '2024-01-20',
        'helpful_count' => 25,
        'verified_purchase' => true
    ],
    [
        'id' => 2,
        'user_name' => 'Dr. Budi Santoso',
        'user_avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=20BBA4&color=fff',
        'rating' => 4,
        'comment' => 'Penjelasan yang detail dan contoh-contoh yang relevan. Sedikit kekurangan di bagian analisis multivariat.',
        'date' => '2024-01-18',
        'helpful_count' => 18,
        'verified_purchase' => true
    ]
];

// Check if user already owns this book
$userOwnsBook = false;
if (isLoggedIn()) {
    // BACKEND TODO: Check di database
    // SELECT id FROM user_books WHERE user_id = ? AND book_id = ?
}

// Check if book is in wishlist
$inWishlist = false;
if (isLoggedIn()) {
    // BACKEND TODO: Check di database
    // SELECT id FROM wishlists WHERE user_id = ? AND book_id = ?
}

// Meta tags untuk SEO
$pageTitle = $book['title'];
$pageDescription = truncate($book['description'], 160);
$pageKeywords = implode(', ', $book['tags']);
$pageImage = $book['cover'];

// Include header
require_once '../includes/header.php';
?>

<!-- Breadcrumb -->
<nav class="breadcrumb-nav bg-light py-3">
    <div class="container">
        <?= breadcrumb([
            ['label' => 'Beranda', 'url' => '/'],
            ['label' => 'Katalog', 'url' => '/katalog'],
            ['label' => $book['category'], 'url' => '/katalog?category=' . urlencode($book['category'])],
            ['label' => $book['title']]
        ]) ?>
    </div>
</nav>

<!-- Book Detail Section -->
<section class="book-detail-section py-5">
    <div class="container">
        <div class="row">
            <!-- Book Cover & Actions -->
            <div class="col-lg-4 mb-4">
                <div class="book-cover-wrapper position-sticky" style="top: 100px;">
                    <!-- Cover Image -->
                    <div class="book-cover-container mb-4">
                        <img src="<?= e($book['cover']) ?>" 
                             alt="<?= e($book['title']) ?>" 
                             class="book-cover img-fluid rounded shadow">
                        
                        <?php if ($book['discount'] > 0): ?>
                            <span class="discount-badge position-absolute top-0 start-0 m-3 badge bg-danger">
                                -<?= $book['discount'] ?>%
                            </span>
                        <?php endif; ?>
                        
                        <?php if ($userOwnsBook): ?>
                            <span class="owned-badge position-absolute top-0 end-0 m-3 badge bg-success">
                                <i class="fas fa-check"></i> Dimiliki
                            </span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Price & Actions -->
                    <div class="book-actions">
                        <div class="price-section mb-3">
                            <div class="current-price h3 text-primary mb-0">
                                <?= formatCurrency($book['price']) ?>
                            </div>
                            <?php if ($book['discount'] > 0): ?>
                                <div class="original-price text-muted text-decoration-line-through">
                                    <?= formatCurrency($book['original_price']) ?>
                                </div>
                                <div class="discount-amount text-success small">
                                    Hemat <?= formatCurrency($book['original_price'] - $book['price']) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <?php if ($userOwnsBook): ?>
                            <!-- User already owns this book -->
                            <div class="d-grid gap-2 mb-3">
                                <a href="/dashboard/ebook/read/<?= $book['id'] ?>" class="btn btn-success btn-lg">
                                    <i class="fas fa-book-reader me-2"></i>
                                    Baca Sekarang
                                </a>
                                <a href="/downloads/<?= $book['id'] ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-download me-2"></i>
                                    Download Ulang
                                </a>
                            </div>
                        <?php else: ?>
                            <!-- Purchase actions -->
                            <div class="d-grid gap-2 mb-3">
                                <button class="btn btn-primary btn-lg add-to-cart" 
                                        data-book-id="<?= $book['id'] ?>">
                                    <i class="fas fa-cart-plus me-2"></i>
                                    Tambah ke Keranjang
                                </button>
                                <button class="btn btn-accent buy-now" 
                                        data-book-id="<?= $book['id'] ?>">
                                    <i class="fas fa-bolt me-2"></i>
                                    Beli Sekarang
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Secondary Actions -->
                        <div class="secondary-actions">
                            <div class="row g-2">
                                <div class="col-6">
                                    <button class="btn btn-outline-secondary w-100 wishlist-btn <?= $inWishlist ? 'active' : '' ?>" 
                                            data-book-id="<?= $book['id'] ?>">
                                        <i class="<?= $inWishlist ? 'fas' : 'far' ?> fa-heart me-1"></i>
                                        Wishlist
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-outline-secondary w-100" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#shareModal">
                                        <i class="fas fa-share me-1"></i>
                                        Share
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Sample/Preview -->
                        <?php if (!empty($book['sample_url'])): ?>
                            <div class="mt-3">
                                <a href="<?= e($book['sample_url']) ?>" 
                                   class="btn btn-outline-primary w-100"
                                   target="_blank">
                                    <i class="fas fa-eye me-2"></i>
                                    Baca Sample (<?= $book['preview_pages'] ?> halaman)
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Book Information -->
            <div class="col-lg-8">
                <!-- Title & Author -->
                <div class="book-header mb-4">
                    <h1 class="book-title"><?= e($book['title']) ?></h1>
                    <?php if (!empty($book['subtitle'])): ?>
                        <h2 class="book-subtitle h5 text-muted mb-3"><?= e($book['subtitle']) ?></h2>
                    <?php endif; ?>
                    
                    <div class="book-meta">
                        <div class="author-info mb-2">
                            <span class="text-muted">Penulis: </span>
                            <a href="/katalog?author=<?= urlencode($book['author']) ?>" 
                               class="author-link text-primary fw-semibold">
                                <?= e($book['author']) ?>
                            </a>
                        </div>
                        
                        <div class="publisher-info mb-2">
                            <span class="text-muted">Penerbit: </span>
                            <a href="/publisher/<?= generateSlug($book['publisher']) ?>" 
                               class="publisher-link text-primary">
                                <?= e($book['publisher']) ?>
                            </a>
                        </div>
                        
                        <div class="publication-date mb-2">
                            <span class="text-muted">Tanggal Terbit: </span>
                            <?= formatDate($book['publication_date']) ?>
                        </div>
                    </div>
                    
                    <!-- Rating & Stats -->
                    <div class="book-stats d-flex flex-wrap gap-3 mt-3">
                        <div class="rating-display">
                            <div class="stars text-warning d-inline-block">
                                <?php 
                                $rating = $book['rating'];
                                $fullStars = floor($rating);
                                $halfStar = ($rating - $fullStars) >= 0.5;
                                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                
                                for ($i = 0; $i < $fullStars; $i++): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                
                                <?php if ($halfStar): ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php endif; ?>
                                
                                <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                            </div>
                            <span class="rating-value ms-2">
                                <?= number_format($rating, 1) ?> (<?= number_format($book['review_count']) ?> ulasan)
                            </span>
                        </div>
                        
                        <div class="sold-count">
                            <i class="fas fa-shopping-bag text-success me-1"></i>
                            <?= number_format($book['sold_count']) ?> terjual
                        </div>
                        
                        <div class="view-count">
                            <i class="fas fa-eye text-info me-1"></i>
                            <?= number_format($book['view_count']) ?> dilihat
                        </div>
                    </div>
                </div>
                
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" 
                                id="description-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#description" 
                                type="button" 
                                role="tab">
                            Deskripsi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                id="details-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#details" 
                                type="button" 
                                role="tab">
                            Detail Buku
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                id="contents-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#contents" 
                                type="button" 
                                role="tab">
                            Daftar Isi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                id="reviews-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#reviews" 
                                type="button" 
                                role="tab">
                            Ulasan (<?= number_format($book['review_count']) ?>)
                        </button>
                    </li>
                </ul>
                
                <!-- Tabs Content -->
                <div class="tab-content">
                    <!-- Description Tab -->
                    <div class="tab-pane fade show active" 
                         id="description" 
                         role="tabpanel" 
                         aria-labelledby="description-tab">
                        <div class="book-description">
                            <p class="lead"><?= nl2br(e($book['description'])) ?></p>
                            
                            <?php if (!empty($book['author_bio'])): ?>
                                <h5 class="mt-4">Tentang Penulis</h5>
                                <p><?= nl2br(e($book['author_bio'])) ?></p>
                            <?php endif; ?>
                            
                            <!-- Tags -->
                            <?php if (!empty($book['tags'])): ?>
                                <div class="book-tags mt-4">
                                    <h6>Tag:</h6>
                                    <?php foreach ($book['tags'] as $tag): ?>
                                        <a href="/katalog?tag=<?= urlencode($tag) ?>" 
                                           class="badge bg-light text-dark text-decoration-none me-2 mb-2">
                                            <?= e($tag) ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Details Tab -->
                    <div class="tab-pane fade" 
                         id="details" 
                         role="tabpanel" 
                         aria-labelledby="details-tab">
                        <div class="book-details">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-semibold">ISBN:</td>
                                            <td><?= e($book['isbn']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Jumlah Halaman:</td>
                                            <td><?= number_format($book['pages']) ?> halaman</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Bahasa:</td>
                                            <td><?= e($book['language']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Format:</td>
                                            <td><?= implode(', ', $book['format']) ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-semibold">Kategori:</td>
                                            <td><?= e($book['category']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Ukuran File:</td>
                                            <td><?= number_format($book['file_size'], 1) ?> MB</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Tanggal Terbit:</td>
                                            <td><?= formatDate($book['publication_date']) ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-semibold">Penerbit:</td>
                                            <td><?= e($book['publisher']) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Table of Contents Tab -->
                    <div class="tab-pane fade" 
                         id="contents" 
                         role="tabpanel" 
                         aria-labelledby="contents-tab">
                        <div class="table-of-contents">
                            <ol class="list-group list-group-numbered">
                                <?php foreach ($book['table_of_contents'] as $chapter): ?>
                                    <li class="list-group-item border-0 px-0">
                                        <?= e($chapter) ?>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                    
                    <!-- Reviews Tab -->
                    <div class="tab-pane fade" 
                         id="reviews" 
                         role="tabpanel" 
                         aria-labelledby="reviews-tab">
                        
                        <!-- Rating Summary -->
                        <div class="rating-summary mb-4">
                            <div class="row align-items-center">
                                <div class="col-md-3 text-center">
                                    <div class="overall-rating">
                                        <div class="rating-value h2 mb-0"><?= number_format($book['rating'], 1) ?></div>
                                        <div class="stars text-warning mb-2">
                                            <?php for ($i = 0; $i < $fullStars; $i++): ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>
                                            <?php if ($halfStar): ?>
                                                <i class="fas fa-star-half-alt"></i>
                                            <?php endif; ?>
                                            <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <div class="review-count text-muted">
                                            <?= number_format($book['review_count']) ?> ulasan
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <!-- Rating Distribution -->
                                    <div class="rating-distribution">
                                        <?php 
                                        // BACKEND TODO: Get actual rating distribution from database
                                        $distribution = [5 => 65, 4 => 20, 3 => 10, 2 => 3, 1 => 2];
                                        ?>
                                        <?php foreach ($distribution as $stars => $percentage): ?>
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="stars-label me-2"><?= $stars ?> bintang</span>
                                                <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                    <div class="progress-bar bg-warning" 
                                                         style="width: <?= $percentage ?>%"></div>
                                                </div>
                                                <span class="percentage-label small text-muted"><?= $percentage ?>%</span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Write Review Button -->
                        <?php if (isLoggedIn() && $userOwnsBook): ?>
                            <div class="write-review mb-4">
                                <button class="btn btn-outline-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#reviewModal">
                                    <i class="fas fa-edit me-2"></i>
                                    Tulis Ulasan
                                </button>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Reviews List -->
                        <div class="reviews-list">
                            <?php foreach ($reviews as $review): ?>
                                <div class="review-item border-bottom pb-4 mb-4">
                                    <div class="d-flex align-items-start">
                                        <img src="<?= e($review['user_avatar']) ?>" 
                                             alt="<?= e($review['user_name']) ?>" 
                                             class="rounded-circle me-3" 
                                             width="50" 
                                             height="50">
                                        <div class="review-content flex-grow-1">
                                            <div class="review-header d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h6 class="mb-0">
                                                        <?= e($review['user_name']) ?>
                                                        <?php if ($review['verified_purchase']): ?>
                                                            <span class="badge bg-success ms-2">Pembeli Terverifikasi</span>
                                                        <?php endif; ?>
                                                    </h6>
                                                    <div class="review-meta small text-muted">
                                                        <div class="stars text-warning d-inline-block me-2">
                                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                                <i class="fas fa-star<?= $i > $review['rating'] ? '-o' : '' ?>"></i>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <?= formatDate($review['date']) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="review-text mb-2"><?= nl2br(e($review['comment'])) ?></p>
                                            <div class="review-actions">
                                                <button class="btn btn-sm btn-outline-secondary helpful-btn" 
                                                        data-review-id="<?= $review['id'] ?>">
                                                    <i class="fas fa-thumbs-up me-1"></i>
                                                    Membantu (<?= $review['helpful_count'] ?>)
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            
                            <!-- Load More Reviews -->
                            <div class="text-center">
                                <button class="btn btn-outline-primary load-more-reviews" 
                                        data-book-id="<?= $book['id'] ?>"
                                        data-page="2">
                                    Muat Ulasan Lainnya
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Books Section -->
<section class="related-books-section py-5 bg-light">
    <div class="container">
        <h3 class="mb-4">Buku Terkait</h3>
        <div class="row g-4">
            <?php foreach ($relatedBooks as $relatedBook): ?>
                <div class="col-lg-3 col-md-6">
                    <?php 
                    $book = $relatedBook;
                    $options = ['showRating' => true, 'showAddToCart' => true];
                    include '../includes/components/book-card.php'; 
                    ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bagikan Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="share-options">
                    <div class="mb-3">
                        <label class="form-label">Link Buku</label>
                        <div class="input-group">
                            <input type="text" 
                                   class="form-control" 
                                   value="<?= url('/buku/' . $book['id']) ?>" 
                                   readonly>
                            <button class="btn btn-outline-primary copy-link" type="button">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="social-share">
                        <h6>Bagikan ke:</h6>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-primary share-facebook">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="#" class="btn btn-info share-twitter">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                            <a href="#" class="btn btn-success share-whatsapp">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<?php if (isLoggedIn() && $userOwnsBook): ?>
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tulis Ulasan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form class="review-form" data-book-id="<?= $book['id'] ?>">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Rating</label>
                        <div class="star-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="far fa-star star-input" data-rating="<?= $i ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <input type="hidden" name="rating" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Ulasan</label>
                        <textarea class="form-control" 
                                  name="comment" 
                                  rows="4" 
                                  placeholder="Bagikan pengalaman Anda dengan buku ini..."
                                  required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Custom CSS -->
<style>
.book-cover-container {
    position: relative;
    text-align: center;
}

.book-cover {
    max-width: 100%;
    height: auto;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

.discount-badge, .owned-badge {
    border-radius: 8px;
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
}

.book-stats > div {
    padding: 0.5rem 0;
}

.rating-distribution .progress {
    width: 200px;
}

.star-rating .star-input {
    font-size: 1.5rem;
    cursor: pointer;
    color: #ddd;
    transition: color 0.2s;
}

.star-rating .star-input:hover,
.star-rating .star-input.active {
    color: #ffc107;
}

.share-options .social-share a {
    flex: 1;
    text-align: center;
}

@media (max-width: 768px) {
    .book-detail-section .col-lg-4 {
        order: 2;
    }
    
    .book-detail-section .col-lg-8 {
        order: 1;
    }
    
    .book-cover-wrapper {
        position: static !important;
    }
}
</style>

<!-- Page-specific JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Star rating interaction
    const starInputs = document.querySelectorAll('.star-input');
    const ratingInput = document.querySelector('input[name="rating"]');
    
    starInputs.forEach((star, index) => {
        star.addEventListener('click', function() {
            const rating = this.dataset.rating;
            ratingInput.value = rating;
            
            starInputs.forEach((s, i) => {
                if (i < rating) {
                    s.classList.remove('far');
                    s.classList.add('fas');
                } else {
                    s.classList.remove('fas');
                    s.classList.add('far');
                }
            });
        });
        
        star.addEventListener('mouseover', function() {
            const rating = this.dataset.rating;
            
            starInputs.forEach((s, i) => {
                if (i < rating) {
                    s.style.color = '#ffc107';
                } else {
                    s.style.color = '#ddd';
                }
            });
        });
    });
    
    // Copy link functionality
    document.querySelector('.copy-link').addEventListener('click', function() {
        const input = this.parentElement.querySelector('input');
        input.select();
        document.execCommand('copy');
        
        this.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
            this.innerHTML = '<i class="fas fa-copy"></i>';
        }, 2000);
    });
    
    // Review form submission
    const reviewForm = document.querySelector('.review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const bookId = this.dataset.bookId;
            
            try {
                const response = await fetch('/api/ajax/submit-review.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    // Close modal and show success message
                    bootstrap.Modal.getInstance(document.getElementById('reviewModal')).hide();
                    KaryaIlmiah.showAlert('Ulasan berhasil dikirim!', 'success');
                    
                    // Refresh reviews section
                    location.reload();
                } else {
                    KaryaIlmiah.showAlert(result.message || 'Gagal mengirim ulasan', 'danger');
                }
            } catch (error) {
                KaryaIlmiah.showAlert('Terjadi kesalahan. Silakan coba lagi.', 'danger');
            }
        });
    }
    
    // Load more reviews
    document.querySelector('.load-more-reviews').addEventListener('click', async function() {
        const bookId = this.dataset.bookId;
        const page = parseInt(this.dataset.page);
        
        this.disabled = true;
        this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memuat...';
        
        try {
            const response = await fetch(`/api/ajax/load-reviews.php?book_id=${bookId}&page=${page}`);
            const result = await response.json();
            
            if (result.success && result.reviews.length > 0) {
                // Append new reviews
                const reviewsList = document.querySelector('.reviews-list');
                const loadMoreBtn = this;
                
                result.reviews.forEach(review => {
                    // Create review element and append
                    // TODO: Create proper review HTML template
                });
                
                this.dataset.page = page + 1;
                this.disabled = false;
                this.innerHTML = 'Muat Ulasan Lainnya';
                
                if (!result.has_more) {
                    this.style.display = 'none';
                }
            } else {
                this.style.display = 'none';
            }
        } catch (error) {
            this.disabled = false;
            this.innerHTML = 'Muat Ulasan Lainnya';
            KaryaIlmiah.showAlert('Gagal memuat ulasan', 'danger');
        }
    });
});
</script>

<?php
// Include footer
require_once '../includes/footer.php';

// BACKEND TODO: 
// 1. Implementasi tracking untuk analytics
// 2. A/B testing untuk layout yang berbeda
// 3. Recommendation engine untuk related books
// 4. Caching untuk performa (Redis/Memcached)
// 5. SEO optimization dengan structured data
// 6. Social media integration
?>