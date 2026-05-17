import './bootstrap';
// ============================================
// SWEETHEART WEBSITE — Global JavaScript
// ============================================

document.addEventListener('DOMContentLoaded', () => {

    // ========== FLOATING HEARTS BACKGROUND ==========
    const heartsBg = document.getElementById('heartsBg');
    const heartEmojis = ['💕', '💖', '💗', '🌸', '⭐', '✨', '💝', '🌺', '💞'];

    function createHeart() {
        const heart = document.createElement('div');
        heart.classList.add('floating-heart');
        heart.textContent = heartEmojis[Math.floor(Math.random() * heartEmojis.length)];

        const size = Math.random() * 1.2 + 0.6;
        const left = Math.random() * 100;
        const duration = Math.random() * 10 + 8;
        const delay = Math.random() * 5;

        heart.style.cssText = `
            left: ${left}%;
            font-size: ${size}rem;
            animation-duration: ${duration}s;
            animation-delay: ${delay}s;
        `;

        if (heartsBg) {
            heartsBg.appendChild(heart);
            setTimeout(() => heart.remove(), (duration + delay) * 1000);
        }
    }

    // Generate hearts periodically
    setInterval(createHeart, 800);
    for (let i = 0; i < 6; i++) createHeart(); // Initial batch

    // ========== HAMBURGER MENU ==========
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');

    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('open');
            }
        });
    }

    // ========== NAVBAR SCROLL EFFECT ==========
    const navbar = document.querySelector('.navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            navbar.style.boxShadow = '0 6px 30px rgba(255, 107, 157, 0.18)';
        } else {
            navbar.style.boxShadow = '0 4px 24px rgba(255, 107, 157, 0.1)';
        }
    });

    // ========== SCROLL REVEAL ==========
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.anim-fade-up').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

});
