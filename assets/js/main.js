/**
 * MAIN JAVASCRIPT - KARYAILMIAH.ID
 * 
 * File ini berisi semua fungsi JavaScript untuk interaktivitas website
 * Menggunakan Alpine.js untuk reactive components
 * 
 * @author  Frontend Team
 * @version 1.0.0
 */

// Wait for DOM to be ready
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    
    /**
     * INITIALIZATION
     */
    
    // Initialize tooltips (Bootstrap)
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers (Bootstrap)
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
    
    /**
     * NAVIGATION
     */
    
    // Mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navbarNav = document.querySelector('.navbar-nav');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            navbarNav.classList.toggle('active');
            this.classList.toggle('active');
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.navbar')) {
                navbarNav.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            }
        });
    }
    
    // Active navigation highlight
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }
    });
    
    /**
     * SEARCH FUNCTIONALITY
     */
    
    const searchForm = document.querySelector('.search-form');
    const searchInput = document.querySelector('.search-input');
    
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.trim();
            
            if (query) {
                // TODO Backend: Implement search
                window.location.href = '/katalog?search=' + encodeURIComponent(query);
            }
        });
        
        // Search suggestions (autocomplete)
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length > 2) {
                searchTimeout = setTimeout(() => {
                    fetchSearchSuggestions(query);
                }, 300);
            }
        });
    }
    
    /**
     * FORM VALIDATION
     */
    
    // Custom form validation
    const forms = document.querySelectorAll('.needs-validation');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            form.classList.add('was-validated');
        });
    });
    
    // Password strength indicator
    const passwordInput = document.querySelector('#password');
    const passwordStrength = document.querySelector('.password-strength');
    
    if (passwordInput && passwordStrength) {
        passwordInput.addEventListener('input', function() {
            const strength = calculatePasswordStrength(this.value);
            updatePasswordStrengthUI(strength, passwordStrength);
        });
    }
    
    // Password toggle visibility
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    passwordToggles.forEach(toggle => {
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
    
    /**
     * FILE UPLOAD
     */
    
    const fileInputs = document.querySelectorAll('.file-input');
    
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0]?.name || 'Pilih file...';
            const fileLabel = this.parentElement.querySelector('.file-label');
            
            if (fileLabel) {
                fileLabel.textContent = fileName;
            }
            
            // Preview for images
            if (this.files[0] && this.accept.includes('image')) {
                previewImage(this.files[0], this.dataset.preview);
            }
            
            // Validate file size
            const maxSize = parseInt(this.dataset.maxSize) || 50 * 1024 * 1024; // 50MB default
            if (this.files[0]?.size > maxSize) {
                showAlert('File terlalu besar. Maksimal ' + formatFileSize(maxSize), 'danger');
                this.value = '';
            }
        });
    });
    
    /**
     * LAZY LOADING
     */
    
    // Lazy load images
    const lazyImages = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for browsers without IntersectionObserver
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
        });
    }
    
    /**
     * INFINITE SCROLL
     */
    
    const infiniteScrollContainer = document.querySelector('.infinite-scroll');
    
    if (infiniteScrollContainer) {
        let page = 1;
        let loading = false;
        
        window.addEventListener('scroll', () => {
            if (loading) return;
            
            const { scrollTop, scrollHeight, clientHeight } = document.documentElement;
            
            if (scrollTop + clientHeight >= scrollHeight - 100) {
                loading = true;
                loadMoreContent(++page).then(() => {
                    loading = false;
                });
            }
        });
    }
    
    /**
     * CART FUNCTIONALITY
     */
    
    // Add to cart
    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-to-cart')) {
            e.preventDefault();
            const button = e.target.closest('.add-to-cart');
            const bookId = button.dataset.bookId;
            
            addToCart(bookId, button);
        }
    });
    
    // Remove from cart
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-from-cart')) {
            e.preventDefault();
            const button = e.target.closest('.remove-from-cart');
            const bookId = button.dataset.bookId;
            
            removeFromCart(bookId, button);
        }
    });
    
    /**
     * MODALS
     */
    
    // Dynamic modal content
    const dynamicModals = document.querySelectorAll('[data-bs-toggle="modal"][data-remote]');
    
    dynamicModals.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const modalId = this.dataset.bsTarget;
            const modal = document.querySelector(modalId);
            const modalBody = modal.querySelector('.modal-body');
            
            // Show loading
            modalBody.innerHTML = '<div class="text-center"><div class="spinner"></div></div>';
            
            // Load content
            fetch(this.dataset.remote)
                .then(response => response.text())
                .then(html => {
                    modalBody.innerHTML = html;
                })
                .catch(error => {
                    modalBody.innerHTML = '<div class="alert alert-danger">Gagal memuat konten</div>';
                });
        });
    });
    
    /**
     * COUNTERS
     */
    
    // Animated counters
    const counters = document.querySelectorAll('.counter');
    
    if (counters.length > 0) {
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    animateCounter(entry.target);
                    entry.target.classList.add('counted');
                }
            });
        });
        
        counters.forEach(counter => counterObserver.observe(counter));
    }
    
    /**
     * COPY TO CLIPBOARD
     */
    
    document.addEventListener('click', function(e) {
        if (e.target.closest('.copy-to-clipboard')) {
            const button = e.target.closest('.copy-to-clipboard');
            const text = button.dataset.text || button.textContent;
            
            copyToClipboard(text, button);
        }
    });
    
    /**
     * SMOOTH SCROLL
     */
    
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    /**
     * FILTERS & SORTING
     */
    
    // Price range slider
    const priceRange = document.querySelector('#price-range');
    const priceMin = document.querySelector('#price-min');
    const priceMax = document.querySelector('#price-max');
    
    if (priceRange) {
        priceRange.addEventListener('input', function() {
            const value = parseInt(this.value);
            const max = parseInt(this.max);
            const percentage = (value / max) * 100;
            
            priceMax.textContent = formatCurrency(value);
            this.style.background = `linear-gradient(to right, var(--primary-green) ${percentage}%, var(--medium-gray) ${percentage}%)`;
        });
    }
    
    // Sort dropdown
    const sortSelect = document.querySelector('#sort-by');
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('sort', this.value);
            window.location.href = currentUrl.toString();
        });
    }
    
    /**
     * TABS
     */
    
    // Custom tab functionality
    const tabTriggers = document.querySelectorAll('[data-tab]');
    
    tabTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            
            const tabId = this.dataset.tab;
            const tabContent = document.querySelector(`#${tabId}`);
            
            // Hide all tabs
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('active');
            });
            
            // Remove active from all triggers
            tabTriggers.forEach(t => t.classList.remove('active'));
            
            // Show selected tab
            tabContent.classList.add('active');
            this.classList.add('active');
        });
    });
});

/**
 * HELPER FUNCTIONS
 */

// Show alert message
function showAlert(message, type = 'info', duration = 5000) {
    const alertContainer = document.querySelector('.alert-container') || createAlertContainer();
    
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show`;
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    alertContainer.appendChild(alert);
    
    // Auto dismiss
    if (duration > 0) {
        setTimeout(() => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150);
        }, duration);
    }
}

// Create alert container if not exists
function createAlertContainer() {
    const container = document.createElement('div');
    container.className = 'alert-container';
    container.style.cssText = 'position: fixed; top: 80px; right: 20px; z-index: 9999; max-width: 400px;';
    document.body.appendChild(container);
    return container;
}

// Calculate password strength
function calculatePasswordStrength(password) {
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^a-zA-Z0-9]/.test(password)) strength++;
    
    return Math.min(strength, 5);
}

// Update password strength UI
function updatePasswordStrengthUI(strength, element) {
    const strengthTexts = ['Sangat Lemah', 'Lemah', 'Cukup', 'Kuat', 'Sangat Kuat'];
    const strengthColors = ['danger', 'warning', 'warning', 'success', 'success'];
    
    element.innerHTML = `
        <div class="progress mt-2" style="height: 5px;">
            <div class="progress-bar bg-${strengthColors[strength - 1]}" 
                 style="width: ${(strength / 5) * 100}%"></div>
        </div>
        <small class="text-${strengthColors[strength - 1]}">${strengthTexts[strength - 1] || ''}</small>
    `;
}

// Preview image
function previewImage(file, previewId) {
    if (!previewId) return;
    
    const preview = document.querySelector(`#${previewId}`);
    if (!preview) return;
    
    const reader = new FileReader();
    
    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };
    
    reader.readAsDataURL(file);
}

// Format file size
function formatFileSize(bytes) {
    const units = ['B', 'KB', 'MB', 'GB'];
    let i = 0;
    
    while (bytes >= 1024 && i < units.length - 1) {
        bytes /= 1024;
        i++;
    }
    
    return Math.round(bytes * 100) / 100 + ' ' + units[i];
}

// Format currency
function formatCurrency(amount) {
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Animate counter
function animateCounter(element) {
    const target = parseInt(element.dataset.target);
    const duration = parseInt(element.dataset.duration) || 2000;
    const step = target / (duration / 16); // 60 FPS
    
    let current = 0;
    
    const timer = setInterval(() => {
        current += step;
        
        if (current >= target) {
            element.textContent = target.toLocaleString('id-ID');
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current).toLocaleString('id-ID');
        }
    }, 16);
}

// Copy to clipboard
function copyToClipboard(text, button) {
    navigator.clipboard.writeText(text).then(() => {
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
        button.classList.add('btn-success');
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('btn-success');
        }, 2000);
    }).catch(err => {
        showAlert('Gagal menyalin teks', 'danger');
    });
}

// Fetch search suggestions
async function fetchSearchSuggestions(query) {
    try {
        const response = await fetch(`/api/ajax/search-suggestions.php?q=${encodeURIComponent(query)}`);
        const suggestions = await response.json();
        
        displaySearchSuggestions(suggestions);
    } catch (error) {
        console.error('Error fetching suggestions:', error);
    }
}

// Display search suggestions
function displaySearchSuggestions(suggestions) {
    // TODO: Implement suggestions dropdown
    console.log('Suggestions:', suggestions);
}

// Load more content (infinite scroll)
async function loadMoreContent(page) {
    try {
        const response = await fetch(`/api/ajax/load-more.php?page=${page}`);
        const html = await response.text();
        
        const container = document.querySelector('.infinite-scroll');
        container.insertAdjacentHTML('beforeend', html);
    } catch (error) {
        console.error('Error loading more content:', error);
    }
}

// Add to cart
async function addToCart(bookId, button) {
    button.disabled = true;
    button.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menambahkan...';
    
    try {
        const response = await fetch('/api/ajax/add-to-cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ book_id: bookId })
        });
        
        const result = await response.json();
        
        if (result.success) {
            button.innerHTML = '<i class="fas fa-check"></i> Ditambahkan';
            button.classList.replace('btn-primary', 'btn-success');
            updateCartCount(result.cart_count);
            showAlert('Buku berhasil ditambahkan ke keranjang', 'success');
        } else {
            throw new Error(result.message || 'Gagal menambahkan ke keranjang');
        }
    } catch (error) {
        button.disabled = false;
        button.innerHTML = '<i class="fas fa-cart-plus"></i> Tambah ke Keranjang';
        showAlert(error.message, 'danger');
    }
}

// Remove from cart
async function removeFromCart(bookId, button) {
    if (!confirm('Hapus buku dari keranjang?')) return;
    
    button.disabled = true;
    
    try {
        const response = await fetch('/api/ajax/remove-from-cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ book_id: bookId })
        });
        
        const result = await response.json();
        
        if (result.success) {
            const cartItem = button.closest('.cart-item');
            cartItem.style.opacity = '0';
            setTimeout(() => cartItem.remove(), 300);
            
            updateCartCount(result.cart_count);
            updateCartTotal(result.total);
            showAlert('Buku dihapus dari keranjang', 'success');
        }
    } catch (error) {
        button.disabled = false;
        showAlert('Gagal menghapus dari keranjang', 'danger');
    }
}

// Update cart count
function updateCartCount(count) {
    const cartBadge = document.querySelector('.cart-badge');
    if (cartBadge) {
        cartBadge.textContent = count;
        cartBadge.style.display = count > 0 ? 'inline-block' : 'none';
    }
}

// Update cart total
function updateCartTotal(total) {
    const cartTotal = document.querySelector('.cart-total');
    if (cartTotal) {
        cartTotal.textContent = formatCurrency(total);
    }
}

/**
 * ALPINE.JS COMPONENTS
 * 
 * Define Alpine.js components untuk reactive UI
 * TODO Backend: Sync data dengan server via AJAX
 */

// Dashboard Component
document.addEventListener('alpine:init', () => {
    Alpine.data('dashboard', () => ({
        user: {
            name: 'John Doe',
            balance: 99000000,
            referralCode: 'REF123456'
        },
        
        stats: {
            totalBooks: 0,
            totalSales: 0,
            totalEarnings: 0,
            pendingWithdraw: 0
        },
        
        init() {
            this.loadStats();
        },
        
        async loadStats() {
            try {
                const response = await fetch('/api/ajax/dashboard-stats.php');
                this.stats = await response.json();
            } catch (error) {
                console.error('Error loading stats:', error);
            }
        },
        
        formatCurrency(amount) {
            return formatCurrency(amount);
        },
        
        copyReferralCode() {
            copyToClipboard(this.user.referralCode, this.$el);
        }
    }));
    
    // Book Filter Component
    Alpine.data('bookFilter', () => ({
        filters: {
            category: '',
            priceMin: 0,
            priceMax: 1000000,
            rating: 0,
            publisher: ''
        },
        
        books: [],
        loading: false,
        
        init() {
            this.loadBooks();
        },
        
        async loadBooks() {
            this.loading = true;
            
            try {
                const params = new URLSearchParams(this.filters);
                const response = await fetch(`/api/ajax/filter-books.php?${params}`);
                this.books = await response.json();
            } catch (error) {
                console.error('Error loading books:', error);
            }
            
            this.loading = false;
        },
        
        resetFilters() {
            this.filters = {
                category: '',
                priceMin: 0,
                priceMax: 1000000,
                rating: 0,
                publisher: ''
            };
            this.loadBooks();
        }
    }));
    
    // Cart Component
    Alpine.data('cart', () => ({
        items: [],
        total: 0,
        
        init() {
            this.loadCart();
        },
        
        async loadCart() {
            try {
                const response = await fetch('/api/ajax/get-cart.php');
                const data = await response.json();
                this.items = data.items;
                this.total = data.total;
            } catch (error) {
                console.error('Error loading cart:', error);
            }
        },
        
        updateQuantity(itemId, quantity) {
            // TODO: Update quantity via AJAX
        },
        
        removeItem(itemId) {
            removeFromCart(itemId, this.$el);
            this.loadCart();
        },
        
        get formattedTotal() {
            return formatCurrency(this.total);
        }
    }));
});

// Export functions for use in other scripts
window.KaryaIlmiah = {
    showAlert,
    formatCurrency,
    formatFileSize,
    copyToClipboard
};