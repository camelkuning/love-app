@extends('layouts.app')

@section('title', '🖼️ Gallery — My Sweetheart')

@section('styles')
    <style>
        .gallery-page {
            padding: 60px 24px 80px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-hero {
            text-align: center;
            padding: 40px 0 60px;
        }

        .gallery-hero-emoji {
            font-size: 4rem;
            display: block;
            margin-bottom: 16px;
            animation: bounce 2s ease-in-out infinite;
        }

        /* =========== FILTER TABS =========== */
        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .filter-tab {
            padding: 10px 24px;
            border-radius: var(--radius-full);
            border: 2.5px solid var(--pink-light);
            background: white;
            color: var(--text-mid);
            font-family: 'Nunito', sans-serif;
            font-size: 0.9rem;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-tab:hover,
        .filter-tab.active {
            background: linear-gradient(135deg, var(--pink-main), var(--pink-deep));
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(255, 107, 157, 0.4);
        }

        /* =========== MASONRY GRID =========== */
        .masonry-grid {
            columns: 4;
            column-gap: 16px;
        }

        .masonry-item {
            break-inside: avoid;
            margin-bottom: 16px;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            display: block;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-card);
            border: 3px solid white;
        }

        .masonry-item:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 16px 40px rgba(255, 107, 157, 0.3);
            z-index: 2;
        }

        .masonry-item img {
            width: 100%;
            display: block;
        }

        .masonry-item .ph-block {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-weight: 700;
            color: var(--text-mid);
            font-size: 0.85rem;
        }

        .ph-block .ph-icon {
            font-size: 2.5rem;
        }

        .masonry-item.tall .ph-block {
            aspect-ratio: 2/3;
        }

        .masonry-item.wide .ph-block {
            aspect-ratio: 4/3;
        }

        .masonry-item.square .ph-block {
            aspect-ratio: 1;
        }

        .bg-pink {
            background: linear-gradient(135deg, #FFD6E7, #FFB5CC);
        }

        .bg-lavender {
            background: linear-gradient(135deg, #EDE8FF, #C9B8FF);
        }

        .bg-mint {
            background: linear-gradient(135deg, #E0FBF3, #B8F0E0);
        }

        .bg-peach {
            background: linear-gradient(135deg, #FFE5D0, #FFB085);
        }

        .bg-yellow {
            background: linear-gradient(135deg, #FFF8CC, #FFE566);
        }

        .masonry-item .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(255, 107, 157, 0.8), transparent);
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .masonry-item:hover .overlay {
            opacity: 1;
        }

        .overlay-label {
            color: white;
            font-weight: 800;
            font-size: 0.9rem;
            font-family: 'Dancing Script', cursive;
            font-size: 1.2rem;
        }

        /* =========== LIGHTBOX =========== */
        .lightbox {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 2000;
            background: rgba(30, 10, 40, 0.9);
            backdrop-filter: blur(8px);
            align-items: center;
            justify-content: center;
            padding: 20px;
            animation: fadeIn 0.3s ease;
        }

        .lightbox.open {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .lightbox-inner {
            max-width: 700px;
            width: 100%;
            background: white;
            border-radius: var(--radius-xl);
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
            animation: scaleIn 0.3s ease;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .lightbox-img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            display: block;
        }

        .lightbox-ph {
            width: 100%;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
        }

        .lightbox-info {
            padding: 24px 28px;
        }

        .lightbox-title {
            font-family: 'Dancing Script', cursive;
            font-size: 1.6rem;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .lightbox-desc {
            color: var(--text-mid);
            font-size: 0.9rem;
            margin-bottom: 16px;
        }

        .lightbox-close {
            position: fixed;
            top: 24px;
            right: 24px;
            width: 44px;
            height: 44px;
            background: white;
            border: none;
            border-radius: 50%;
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            transition: all 0.2s;
            z-index: 2001;
        }

        .lightbox-close:hover {
            background: var(--pink-light);
            transform: scale(1.1);
        }

        /* =========== RESPONSIVE =========== */
        @media (max-width: 900px) {
            .masonry-grid {
                columns: 3;
            }
        }

        @media (max-width: 640px) {
            .masonry-grid {
                columns: 2;
            }
        }

        @media (max-width: 380px) {
            .masonry-grid {
                columns: 1;
            }
        }
    </style>
@endsection

@section('content')
    <div class="gallery-page">
        <!-- Hero -->
        <div class="gallery-hero anim-fade-up">
            <span class="gallery-hero-emoji">📸</span>
            <div class="section-title">Gallery Foto Kita</div>
            <p class="section-subtitle">Setiap foto menyimpan cerita indah yang tak terlupakan 💕</p>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all">❤️ Semua</button>
            <button class="filter-tab" data-filter="selfie">🤳 Selfie</button>
            <button class="filter-tab" data-filter="travel">✈️ Jalan-Jalan</button>
            <button class="filter-tab" data-filter="food">🍜 Makan Bareng</button>
            <button class="filter-tab" data-filter="special">⭐ Spesial</button>
        </div>

        <!-- Masonry Grid -->
        <div class="masonry-grid" id="galleryGrid">

            <!-- Ganti semua .ph-block dengan <img src="..." alt="..."> untuk foto nyata -->

            <div class="masonry-item tall bg-pink" data-cat="selfie" data-title="Selfie Lucuk 💕"
                 data-img="{{ asset('images/foto44.jpeg') }}">
                <img src="{{ asset('images/foto44.jpeg') }}" alt="Selfie Lucuk 💕">
                <div class="overlay"><span class="overlay-label">Selfie Lucuk 💕</span></div>
            </div>

            <div class="masonry-item square bg-lavender" data-cat="travel" data-title="Nonton Konser 🌸"
                data-desc="Waktu itu tidak ada uang banyak, tapi pengen nonton TULUS" data-img="{{ asset('images/foto4.jpeg') }}">
                <img src="{{ asset('images/foto4.jpeg') }}" alt="Nonton Konser 🌸">
                <div class="overlay"><span class="overlay-label">Nonton Konser 🌸</span></div>
            </div>

            <div class="masonry-item wide bg-peach" data-cat="food" data-title="Makan Bareng 🍜"
               data-desc="Makannn di Los Chicken, Pesannya pasti chicken nanbannn" data-img="{{ asset('images/foto45.jpeg') }}">
                <img src="{{ asset('images/foto45.jpeg') }}" alt="Makan Bareng 🍜">
                <div class="overlay"><span class="overlay-label">Makan Bareng 🍜</span></div>
            </div>

            <div class="masonry-item square bg-mint" data-cat="special" data-title="Ibadah di Ganjurann ⭐"
                data-desc="Ini spesial karena waktu itu sayang pertama kali ibadah di Ganjuran ⭐" data-img="{{ asset('images/foto42.jpeg') }}">
                <img src="{{ asset('images/foto42.jpeg') }}" alt="Ibadah di Ganjurann ⭐">
                <div class="overlay"><span class="overlay-label">Ibadah di Ganjurann ⭐</span></div>
            </div>

            <div class="masonry-item tall bg-yellow" data-cat="selfie" data-title="Senyum Manismu"
                data-desc="Senyum yg menawaaaann 😊" data-img="{{ asset('images/foto29.jpeg') }}">
                <img src="{{ asset('images/foto29.jpeg') }}" alt="Senyum Manismu">
                <div class="overlay"><span class="overlay-label">Senyum Manismu 😊</span></div>
            </div>

            <div class="masonry-item square bg-pink" data-cat="travel" data-title="Foto di Photobooth 🌸"
                data-desc="KITA KE PHOTOBOOTH Yeayyyyy" data-img="{{ asset('images/foto32.jpeg') }}">
                <img src="{{ asset('images/foto32.jpeg') }}" alt="Foto di Photobooth 🌸">
                <div class="overlay"><span class="overlay-label">Foto di Photobooth 🌸</span></div>
            </div>

            <div class="masonry-item wide bg-lavender" data-cat="selfie" data-title="Foto Berdua 💕" data-desc="Foto berduaaa xixi"
                data-img="{{ asset('images/foto14.jpeg') }}">
                <img src="{{ asset('images/foto14.jpeg') }}" alt="Foto Berdua 💕">
                <div class="overlay"><span class="overlay-label">Foto Berdua 💕</span></div>
            </div>

            <div class="masonry-item tall bg-mint" data-cat="special" data-title="Wisuda 🎓"
                data-desc="Hari itu sayang datang ke sa punya wisudaaa" data-img="{{ asset('images/foto15.jpeg') }}">
                <img src="{{ asset('images/foto15.jpeg') }}" alt="Wisuda 🎓">
                <div class="overlay"><span class="overlay-label">Wisuda 🎓</span></div>
            </div>

        </div>
    </div>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <button class="lightbox-close" id="lightboxClose">✕</button>
        <div class="lightbox-inner">

            {{-- Foto (muncul kalau ada gambar) --}}
            <img class="lightbox-img" id="lightboxImg" src="" alt="" style="display:none;">

            {{-- Placeholder emoji (muncul kalau tidak ada foto) --}}
            <div class="lightbox-ph" id="lightboxPhoto" style="display:none;">📸</div>

            <div class="lightbox-info">
                <div class="lightbox-title" id="lightboxTitle">Foto</div>
                <div class="lightbox-desc" id="lightboxDesc">Deskripsi foto</div>
                <div style="display:flex;gap:8px;">
                    <span style="font-size:1.4rem;">💕</span>
                    <span style="font-size:1.4rem;">⭐</span>
                    <span style="font-size:1.4rem;">🌸</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Filter tabs
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const filter = tab.dataset.filter;
                document.querySelectorAll('.masonry-item').forEach(item => {
                    if (filter === 'all' || item.dataset.cat === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Lightbox
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightboxImg');
        const lightboxPh = document.getElementById('lightboxPhoto');

        document.querySelectorAll('.masonry-item').forEach(item => {
            item.addEventListener('click', () => {
                const imgSrc = item.dataset.img;
                const ph = item.querySelector('.ph-icon');

                // Tampilkan foto atau emoji
                if (imgSrc) {
                    lightboxImg.src = imgSrc;
                    lightboxImg.style.display = 'block';
                    lightboxPh.style.display = 'none';
                } else {
                    lightboxImg.style.display = 'none';
                    lightboxPh.textContent = ph ? ph.textContent : '📸';
                    lightboxPh.style.display = 'flex';
                }

                document.getElementById('lightboxTitle').textContent = item.dataset.title || '';
                document.getElementById('lightboxDesc').textContent = item.dataset.desc || '';
                lightbox.classList.add('open');
            });
        });

        document.getElementById('lightboxClose').addEventListener('click', () => lightbox.classList.remove('open'));
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) lightbox.classList.remove('open');
        });

        // document.getElementById('lightboxClose').addEventListener('click', () => lightbox.classList.remove('open'));
        // lightbox.addEventListener('click', (e) => {
        //     if (e.target === lightbox) lightbox.classList.remove('open');
        // });
    </script>
@endsection
