/**
 * Ruchi Chocolates - Header & Wishlist Drawer Engine
 * Exact replica of ruchichocolate.com interactions
 */

function toggleRcMobileDrawer() {
  const drawer = document.getElementById('rcMobileDrawer');
  if (drawer) {
    drawer.classList.toggle('open');
    document.body.classList.toggle('rc-drawer-open');
  }
}

// Global Wishlist Engine
(function () {
  const WISHLIST_KEY = 'ruchi_wishlist';

  function getWishlist() {
    try {
      const items = localStorage.getItem(WISHLIST_KEY);
      return items ? JSON.parse(items) : [];
    } catch (e) {
      return [];
    }
  }

  function saveWishlist(wishlist) {
    localStorage.setItem(WISHLIST_KEY, JSON.stringify(wishlist));
    updateGlobalWishlistStates();
  }

  function toggleWishlist(product) {
    let wishlist = getWishlist();
    const index = wishlist.findIndex((item) => item.id == product.id);
    if (index > -1) {
      wishlist.splice(index, 1);
    } else {
      wishlist.push(product);
    }
    saveWishlist(wishlist);
  }

  function updateGlobalWishlistStates() {
    const wishlist = getWishlist();

    // Update count badges
    const countBadges = document.querySelectorAll('.rc-wishlist-count, .wishlist-count');
    countBadges.forEach((badge) => {
      badge.textContent = wishlist.length;
    });

    renderWishlistDrawerItems();
  }

  function renderWishlistDrawerItems() {
    const wishlist = getWishlist();
    const body = document.getElementById('wishlistDrawerBody');
    const headerCount = document.getElementById('wishlistDrawerCount');
    const footerCount = document.getElementById('wishlistFooterCount');
    const totalPriceEl = document.getElementById('wishlistDrawerTotalPrice');
    const totalCompareEl = document.getElementById('wishlistDrawerTotalComparePrice');

    if (!body) return;

    if (headerCount) headerCount.textContent = `${wishlist.length} Items`;
    if (footerCount) footerCount.textContent = wishlist.length;

    if (wishlist.length === 0) {
      body.innerHTML = `
        <div class="custom-wishlist-drawer__empty">
          <svg viewBox="0 0 24 24" width="44" height="44" fill="none" stroke="#eeddbb" stroke-width="1.8">
            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
          </svg>
          <p>Your wishlist is empty</p>
          <a href="/#catalog" class="custom-wishlist-drawer__empty-btn">Shop Now</a>
        </div>
      `;
      if (totalPriceEl) totalPriceEl.textContent = '₹0';
      if (totalCompareEl) totalCompareEl.textContent = '';
      return;
    }

    let totalPrice = 0;
    let totalComparePrice = 0;
    let html = '';

    wishlist.forEach((item) => {
      const priceNum = parseInt((item.price || '').replace(/[^0-9]/g, ''), 10) || 0;
      const compareNum = parseInt((item.comparePrice || '').replace(/[^0-9]/g, ''), 10) || 0;
      totalPrice += priceNum;
      totalComparePrice += compareNum > 0 ? compareNum : priceNum;

      let discountBadge = '';
      if (compareNum > priceNum) {
        const pct = Math.round(((compareNum - priceNum) / compareNum) * 100);
        discountBadge = `<span class="custom-wishlist-drawer__item-discount">${pct}% OFF</span>`;
      }

      html += `
        <div class="custom-wishlist-drawer__item" data-id="${item.id}">
          <img src="${item.image || '/images/logo.png'}" alt="${item.title || 'Chocolate'}" class="custom-wishlist-drawer__item-img">
          <div class="custom-wishlist-drawer__item-details">
            <h4 class="custom-wishlist-drawer__item-title">${item.title || 'Handcrafted Chocolate'}</h4>
            <div class="custom-wishlist-drawer__item-price-row">
              <span class="custom-wishlist-drawer__item-price">${item.price || '₹299'}</span>
              ${item.comparePrice ? `<span class="custom-wishlist-drawer__item-compare">${item.comparePrice}</span>` : ''}
              ${discountBadge}
            </div>
          </div>
          <div class="custom-wishlist-drawer__item-actions">
            <button class="custom-wishlist-drawer__item-remove" data-id="${item.id}" aria-label="Remove item">✕</button>
            <div class="custom-wishlist-drawer__item-bottom-actions">
              <span class="custom-wishlist-drawer__item-heart">❤️</span>
              <button class="custom-wishlist-drawer__item-cart-btn" data-id="${item.id}" aria-label="Add to Cart">
                <svg viewBox="0 0 24 24" width="14" height="14"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
              </button>
            </div>
          </div>
        </div>
      `;
    });

    body.innerHTML = html;
    if (totalPriceEl) totalPriceEl.textContent = `₹${totalPrice.toLocaleString('en-IN')}`;
    if (totalCompareEl) {
      if (totalComparePrice > totalPrice) {
        totalCompareEl.textContent = `₹${totalComparePrice.toLocaleString('en-IN')}`;
      } else {
        totalCompareEl.textContent = '';
      }
    }
  }

  function openWishlistDrawer() {
    const drawer = document.getElementById('customWishlistDrawer');
    if (drawer) {
      drawer.classList.add('custom-wishlist-drawer--open');
      drawer.setAttribute('aria-hidden', 'false');
      document.body.classList.add('custom-wishlist-drawer-active');
    }
  }

  function closeWishlistDrawer() {
    const drawer = document.getElementById('customWishlistDrawer');
    if (drawer) {
      drawer.classList.remove('custom-wishlist-drawer--open');
      drawer.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('custom-wishlist-drawer-active');
    }
  }

  function initWishlistListeners() {
    document.body.addEventListener('click', function (e) {
      // 1. Open Wishlist Drawer
      const openTrigger = e.target.closest('.rc-wishlist-link, .rc-wishlist-link-mobile, .wishlist-action');
      if (openTrigger) {
        e.preventDefault();
        e.stopPropagation();
        openWishlistDrawer();
        return;
      }

      // 2. Close Wishlist Drawer
      const closeTrigger = e.target.closest('#customWishlistDrawerClose, #customWishlistDrawerOverlay');
      if (closeTrigger) {
        e.preventDefault();
        e.stopPropagation();
        closeWishlistDrawer();
        return;
      }

      // 3. Toggle Wishlist Item on Card
      const toggleBtn = e.target.closest('.wishlist-toggle');
      if (toggleBtn) {
        e.preventDefault();
        e.stopPropagation();
        const product = {
          id: toggleBtn.getAttribute('data-id'),
          title: toggleBtn.getAttribute('data-title'),
          price: toggleBtn.getAttribute('data-price'),
          comparePrice: toggleBtn.getAttribute('data-compare-price') || '',
          image: toggleBtn.getAttribute('data-image'),
          url: toggleBtn.getAttribute('data-url')
        };
        toggleWishlist(product);
        toggleBtn.classList.toggle('active');
        return;
      }

      // 4. Remove Item from Wishlist
      const removeBtn = e.target.closest('.custom-wishlist-drawer__item-remove');
      if (removeBtn) {
        e.preventDefault();
        e.stopPropagation();
        const prodId = removeBtn.getAttribute('data-id');
        let wishlist = getWishlist();
        wishlist = wishlist.filter((item) => item.id != prodId);
        saveWishlist(wishlist);
        return;
      }

      // 5. Move all to cart
      const moveAllBtn = e.target.closest('#wishlistMoveAllToCart');
      if (moveAllBtn) {
        e.preventDefault();
        e.stopPropagation();
        moveAllBtn.textContent = 'Moved to Cart!';
        setTimeout(() => {
          saveWishlist([]);
          closeWishlistDrawer();
          moveAllBtn.textContent = 'Move All to Cart';
        }, 600);
        return;
      }
    });

    // Close with Escape key
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        closeWishlistDrawer();
        const drawer = document.getElementById('rcMobileDrawer');
        if (drawer && drawer.classList.contains('open')) {
          toggleRcMobileDrawer();
        }
      }
    });
  }

  function initBestCollectionsCarousel() {
    const carousel = document.getElementById('bestCollectionsCarousel');
    const prevBtn = document.getElementById('bestCollectionsPrev');
    const nextBtn = document.getElementById('bestCollectionsNext');
    if (!carousel || !prevBtn || !nextBtn) return;

    function getScrollDistance() {
      const card = carousel.querySelector('.best-collections__card');
      if (!card) return 300;
      return card.offsetWidth + 20;
    }

    nextBtn.addEventListener('click', (e) => {
      e.preventDefault();
      carousel.scrollBy({ left: getScrollDistance(), behavior: 'smooth' });
    });

    prevBtn.addEventListener('click', (e) => {
      e.preventDefault();
      carousel.scrollBy({ left: -getScrollDistance(), behavior: 'smooth' });
    });

    function updateArrows() {
      const maxScroll = carousel.scrollWidth - carousel.clientWidth;
      if (carousel.scrollLeft <= 5) {
        prevBtn.style.opacity = '0.35';
        prevBtn.style.pointerEvents = 'none';
      } else {
        prevBtn.style.opacity = '1';
        prevBtn.style.pointerEvents = 'auto';
      }

      if (carousel.scrollLeft >= maxScroll - 5) {
        nextBtn.style.opacity = '0.35';
        nextBtn.style.pointerEvents = 'none';
      } else {
        nextBtn.style.opacity = '1';
        nextBtn.style.pointerEvents = 'auto';
      }
    }

    carousel.addEventListener('scroll', updateArrows);
    window.addEventListener('resize', updateArrows);
    setTimeout(updateArrows, 200);
  }

  function initFaqAccordion() {
    const faqSection = document.getElementById('rcFaqSection');
    if (!faqSection) return;

    const faqItems = faqSection.querySelectorAll('.rc-faq-item');
    faqItems.forEach((item) => {
      const btn = item.querySelector('.rc-faq-btn');
      if (!btn) return;

      btn.addEventListener('click', (e) => {
        e.preventDefault();
        const isOpen = item.classList.contains('is-open');

        // Close other items (one open at a time accordion)
        faqItems.forEach((other) => {
          if (other !== item) {
            other.classList.remove('is-open');
            const otherBtn = other.querySelector('.rc-faq-btn');
            if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
          }
        });

        // Toggle current item
        if (isOpen) {
          item.classList.remove('is-open');
          btn.setAttribute('aria-expanded', 'false');
        } else {
          item.classList.add('is-open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
      initWishlistListeners();
      updateGlobalWishlistStates();
      initBestCollectionsCarousel();
      initFaqAccordion();
    });
  } else {
    initWishlistListeners();
    updateGlobalWishlistStates();
    initBestCollectionsCarousel();
    initFaqAccordion();
  }
})();

