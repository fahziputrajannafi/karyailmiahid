<?php
/**
 * BOOK CARD COMPONENT - KARYAILMIAH.ID
 * 
 * Komponen reusable untuk menampilkan kartu buku
 * Digunakan di: homepage, katalog, search results, dashboard
 * 
 * Parameters:
 * - $book: array dengan data buku (id, title, author, price, cover, rating, sold, etc)
 * - $options: array opsi tampilan (showRating, showPublisher, showAddToCart, etc)
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Default options
$defaultOptions = [
    'showRating' => true,
    'showPublisher' => true,
    'showAddToCart' => true,
    'showBadge' => true,
    'showQuickView' => true,
    'cardClass' => '',
    'lazyLoad' => true
];

$options = array_merge($defaultOptions, $options ?? []);

// Generate unique ID for this card
$cardId = 'book-' . ($book['id'] ?? uniqid());

// Badge logic
$badge = null;
if ($options['showBadge']) {
    if (isset($book['is_new']) && $book['is_new']) {
        $badge = ['text' => 'Baru', 'class' => 'bg-success'];
    } elseif (isset($book['is_bestseller']) && $book['is_bestseller']) {
        $badge = ['text' => 'Best Seller', 'class' => 'bg-danger'];
    } elseif (isset($book['discount']) && $book['discount'] > 0) {
        $badge = ['text' => '-' . $book['discount'] . '%', 'class' => 'bg-warning text-dark'];
    }
}

// Calculate discounted price if applicable
$originalPrice = $book['price'] ?? 0;
$discountedPrice = isset($book['discount']) 
    ? $originalPrice - ($originalPrice * $book['discount'] / 100)
    : $originalPrice;

// Rating stars
$rating = $book['rating'] ?? 0;
$fullStars = floor($rating);
$halfStar = ($rating - $fullStars) >= 0.5;
$emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
?>

<div class="book-card-wrapper <?= $options['cardClass'] ?>" id="<?= $cardId ?>">
    <div class="card book-card h-100 border-0 shadow-sm hover-scale">
        <!-- Cover Image Container -->
        <div class="book-cover-container position-relative overflow-hidden">
            <!-- Badge -->
            <?php if ($badge): ?>
                <span class="position-absolute top-0 start-0 m-2 badge <?= $badge['class'] ?> z-1">
                    <?= $badge['text'] ?>
                </span>
            <?php endif; ?>
            
            <!-- Book Cover -->
            <a href="<?= url('/buku/' . $book['id']) ?>" class="text-decoration-none">
                <?php if ($options['lazyLoad']): ?>
                    <img data-src="<?= e($book['cover'] ?? asset('images/default-book-cover.jpg')) ?>" 
                         src="<?= asset('images/placeholder-book.jpg') ?>"
                         class="card-img-top book-cover" 
                         alt="<?= e($book['title']) ?>"
                         loading="lazy">
                <?php else: ?>
                    <img src="<?= e($book['cover'] ?? asset('images/default-book-cover.jpg')) ?>" 
                         class="card-img-top book-cover" 
                         alt="<?= e($book['title']) ?>">
                <?php endif; ?>
            </a>
            
            <!-- Quick Actions (shown on hover) -->
            <div class="book-actions position-absolute top-0 end-0 m-2 d-flex flex-column gap-2">
                <?php if ($options['showQuickView']): ?>
                    <button class="btn btn-sm btn-light rounded-circle shadow-sm quick-view-btn" 
                            data-bs-toggle="modal" 
                            data-bs-target="#quickViewModal"
                            data-book-id="<?= $book['id'] ?>"
                            title="Quick View">
                        <i class="fas fa-eye"></i>
                    </button>
                <?php endif; ?>
                
                <?php if (isLoggedIn()): ?>
                    <button class="btn btn-sm btn-light rounded-circle shadow-sm wishlist-btn" 
                            data-book-id="<?= $book['id'] ?>"
                            title="Add to Wishlist">
                        <i class="<?= isset($book['in_wishlist']) && $book['in_wishlist'] ? 'fas' : 'far' ?> fa-heart text-danger"></i>
                    </button>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body d-flex flex-column">
            <!-- Category -->
            <?php if (isset($book['category'])): ?>
                <small class="text-muted mb-1">
                    <i class="fas fa-folder me-1"></i>
                    <?= e($book['category']) ?>
                </small>
            <?php endif; ?>
            
            <!-- Title -->
            <h5 class="book-title card-title mb-2">
                <a href="<?= url('/buku/' . $book['id']) ?>" 
                   class="text-decoration-none text-dark stretched-link"
                   title="<?= e($book['title']) ?>">
                    <?= e($book['title']) ?>
                </a>
            </h5>
            
            <!-- Author -->
            <p class="book-author text-muted mb-2">
                <i class="fas fa-user-edit me-1"></i>
                <a href="<?= url('/katalog?author=' . urlencode($book['author'])) ?>" 
                   class="text-decoration-none text-muted">
                    <?= e($book['author']) ?>
                </a>
            </p>
            
            <!-- Publisher (optional) -->
            <?php if ($options['showPublisher'] && isset($book['publisher'])): ?>
                <p class="book-publisher text-muted small mb-2">
                    <i class="fas fa-building me-1"></i>
                    <a href="<?= url('/publisher/' . generateSlug($book['publisher'])) ?>" 
                       class="text-decoration-none text-muted">
                        <?= e($book['publisher']) ?>
                    </a>
                </p>
            <?php endif; ?>
            
            <!-- Rating (optional) -->
            <?php if ($options['showRating'] && isset($book['rating'])): ?>
                <div class="book-rating mb-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stars text-warning">
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
                        <small class="text-muted">
                            <?= number_format($rating, 1) ?>
                            <?php if (isset($book['review_count'])): ?>
                                (<?= $book['review_count'] ?>)
                            <?php endif; ?>
                        </small>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- Spacer to push price to bottom -->
            <div class="mt-auto">
                <!-- Price -->
                <div class="book-price mb-3">
                    <?php if (isset($book['discount']) && $book['discount'] > 0): ?>
                        <div class="d-flex align-items-center gap-2">
                            <span class="h5 mb-0 text-primary"><?= formatCurrency($discountedPrice) ?></span>
                            <small class="text-muted text-decoration-line-through">
                                <?= formatCurrency($originalPrice) ?>
                            </small>
                        </div>
                    <?php else: ?>
                        <span class="h5 mb-0 text-primary"><?= formatCurrency($originalPrice) ?></span>
                    <?php endif; ?>
                    
                    <!-- Sold count -->
                    <?php if (isset($book['sold']) && $book['sold'] > 0): ?>
                        <small class="text-muted d-block mt-1">
                            <i class="fas fa-shopping-bag me-1"></i>
                            Terjual <?= number_format($book['sold']) ?>
                        </small>
                    <?php endif; ?>
                </div>
                
                <!-- Action Buttons -->
                <?php if ($options['showAddToCart']): ?>
                    <div class="book-actions-bottom d-grid gap-2">
                        <?php if (isset($book['stock']) && $book['stock'] <= 0): ?>
                            <button class="btn btn-secondary btn-sm" disabled>
                                <i class="fas fa-times-circle me-1"></i>
                                Stok Habis
                            </button>
                        <?php else: ?>
                            <button class="btn btn-primary btn-sm add-to-cart" 
                                    data-book-id="<?= $book['id'] ?>">
                                <i class="fas fa-cart-plus me-1"></i>
                                Tambah ke Keranjang
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Component-specific CSS -->
<style>
    .book-card-wrapper {
        transition: all 0.3s ease;
    }
    
    .book-card {
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
    }
    
    .book-cover-container {
        position: relative;
        padding-top: 150%; /* 2:3 aspect ratio */
        background-color: #f8f9fa;
    }
    
    .book-cover {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    
    .book-card:hover .book-cover {
        transform: scale(1.05);
    }
    
    .book-title {
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .book-author {
        font-size: 0.875rem;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .book-actions {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .book-card:hover .book-actions {
        opacity: 1;
    }
    
    .book-actions button {
        width: 35px;
        height: 35px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .wishlist-btn:hover {
        background-color: #fff0f0 !important;
    }
    
    .quick-view-btn:hover {
        background-color: var(--primary-green) !important;
        color: white !important;
    }
    
    /* Skeleton loading animation */
    .book-card.skeleton .book-cover,
    .book-card.skeleton .book-title,
    .book-card.skeleton .book-author,
    .book-card.skeleton .book-price {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }
    
    /* Responsive adjustments */
    @media (max-width: 576px) {
        .book-card-wrapper {
            font-size: 0.875rem;
        }
        
        .book-title {
            font-size: 0.9375rem;
        }
        
        .book-price .h5 {
            font-size: 1.125rem;
        }
    }
</style>

<script>
// Book card specific interactions
document.addEventListener('DOMContentLoaded', function() {
    // Wishlist toggle
    document.querySelectorAll('.wishlist-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const bookId = this.dataset.bookId;
            const icon = this.querySelector('i');
            
            // Toggle wishlist
            if (icon.classList.contains('far')) {
                icon.classList.replace('far', 'fas');
                // TODO Backend: Add to wishlist via AJAX
            } else {
                icon.classList.replace('fas', 'far');
                // TODO Backend: Remove from wishlist via AJAX
            }
        });
    });
    
    // Quick view modal
    document.querySelectorAll('.quick-view-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const bookId = this.dataset.bookId;
            // TODO Backend: Load book details in modal via AJAX
        });
    });
});
</script>

<!-- 
TODO Backend:
1. Implement wishlist functionality dengan user sessions
2. Create quick view modal dengan AJAX loading
3. Add to cart functionality dengan stock checking
4. Track view count untuk analytics
5. Implement lazy loading untuk cover images
-->