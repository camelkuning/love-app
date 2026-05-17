@extends('layouts.app')

@section('title', '💕 Home — My Sweetheart')

@section('styles')
    <style>
        /* =========== HERO =========== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            position: relative;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 20% 50%, rgba(255, 170, 201, 0.3) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 20%, rgba(201, 184, 255, 0.3) 0%, transparent 60%),
                radial-gradient(ellipse at 60% 80%, rgba(255, 229, 102, 0.2) 0%, transparent 60%),
                var(--cream);
        }

        .hero-inner {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-text {
            animation: fadeInLeft 0.9s ease forwards;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--pink-light), var(--peach-light));
            border: 2px solid var(--pink-mid);
            padding: 8px 20px;
            border-radius: var(--radius-full);
            font-size: 0.9rem;
            font-weight: 800;
            color: var(--pink-deep);
            margin-bottom: 20px;
        }

        .hero-title {
            font-family: 'Dancing Script', cursive;
            font-size: 4rem;
            line-height: 1.15;
            color: var(--text-dark);
            margin-bottom: 16px;
        }

        .hero-title .highlight {
            background: linear-gradient(135deg, var(--pink-main), var(--lavender));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-desc {
            font-size: 1.05rem;
            color: var(--text-mid);
            line-height: 1.7;
            margin-bottom: 32px;
            font-weight: 600;
        }

        .hero-buttons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        /* Hero Visual */
        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            animation: fadeInRight 0.9s ease forwards;
        }

        .hero-photo-frame {
            width: 360px;
            height: 380px;
            border-radius: 40% 60% 60% 40% / 50% 40% 60% 50%;
            background: linear-gradient(135deg, var(--pink-light), var(--lavender-light));
            border: 4px solid var(--pink-mid);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            position: relative;
            animation: blobMorph 6s ease-in-out infinite;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(255, 107, 157, 0.25);
        }

        .hero-photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: inherit;
        }

        .hero-photo-placeholder {
            font-size: 5rem;
            margin-bottom: 12px;
        }

        .hero-photo-label {
            font-family: 'Dancing Script', cursive;
            font-size: 1.1rem;
            color: var(--pink-main);
            font-weight: 700;
        }

        @keyframes blobMorph {

            0%,
            100% {
                border-radius: 40% 60% 60% 40% / 50% 40% 60% 50%;
            }

            33% {
                border-radius: 60% 40% 50% 50% / 40% 60% 40% 60%;
            }

            66% {
                border-radius: 50% 50% 40% 60% / 60% 40% 50% 50%;
            }
        }

        .deco-sticker {
            position: absolute;
            font-size: 1.8rem;
            animation: bounce 2s ease-in-out infinite;
        }

        .sticker-1 {
            top: -10px;
            right: -10px;
            animation-delay: 0s;
        }

        .sticker-2 {
            bottom: 10px;
            left: -15px;
            animation-delay: 0.5s;
        }

        .sticker-3 {
            top: 50%;
            right: -20px;
            animation-delay: 1s;
        }

        /* =========== LOVE COUNTER =========== */
        .love-counter {
            background: linear-gradient(135deg, var(--pink-main), var(--pink-deep));
            padding: 60px 24px;
            position: relative;
            overflow: hidden;
        }

        .love-counter::before {
            content: '';
            position: absolute;
            top: -40px;
            left: 0;
            right: 0;
            height: 80px;
            background: var(--cream);
            border-radius: 0 0 50% 50%;
        }

        .love-counter::after {
            content: '';
            position: absolute;
            bottom: -40px;
            left: 0;
            right: 0;
            height: 80px;
            background: var(--cream);
            border-radius: 50% 50% 0 0;
        }

        .counter-inner {
            max-width: 900px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            position: relative;
            z-index: 1;
        }

        .counter-box {
            text-align: center;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.4);
            border-radius: var(--radius-xl);
            padding: 28px 16px;
            transition: transform 0.3s;
        }

        .counter-box:hover {
            transform: scale(1.05);
        }

        .counter-num {
            font-family: 'Pacifico', cursive;
            font-size: 3rem;
            color: white;
            display: block;
        }

        .counter-label {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9rem;
            font-weight: 700;
            margin-top: 8px;
        }

        .counter-emoji {
            font-size: 1.6rem;
            margin-bottom: 8px;
        }

        /* =========== ABOUT SECTION =========== */
        .about-section {
            padding: 80px 24px;
            background: var(--cream);
        }

        .about-inner {
            max-width: 1000px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .about-photo-wrap {
            position: relative;
        }

        .about-photo-main {
            width: 100%;
            aspect-ratio: 4/5;
            border-radius: 30px;
            background: linear-gradient(135deg, var(--lavender-light), var(--mint-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            box-shadow: var(--shadow-soft);
            border: 3px solid var(--lavender);
        }

        .about-photo-main img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 28px;
        }

        .about-photo-small {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 130px;
            height: 130px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--pink-light), var(--peach-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            box-shadow: 0 8px 24px rgba(255, 107, 157, 0.2);
            border: 3px solid white;
            animation: wiggle 3s ease-in-out infinite;
        }

        .about-photo-small img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 18px;
        }

        .about-text {}

        .about-title {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--text-dark);
            margin-bottom: 16px;
            line-height: 1.2;
        }

        .about-desc {
            color: var(--text-mid);
            line-height: 1.8;
            margin-bottom: 24px;
            font-size: 1rem;
        }

        .love-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 28px;
        }

        .love-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: var(--radius-full);
            font-size: 0.85rem;
            font-weight: 700;
            transition: transform 0.2s;
            cursor: default;
        }

        .love-tag:hover {
            transform: scale(1.08);
        }

        .love-tag-pink {
            background: var(--pink-light);
            color: var(--pink-deep);
        }

        .love-tag-lavender {
            background: var(--lavender-light);
            color: #6B4FBB;
        }

        .love-tag-peach {
            background: var(--peach-light);
            color: #C06820;
        }

        .love-tag-mint {
            background: var(--mint-light);
            color: #1A7A5C;
        }

        .love-tag-yellow {
            background: var(--yellow-light);
            color: #8B7000;
        }

        /* =========== MINI GALLERY PREVIEW =========== */
        .mini-gallery {
            padding: 80px 24px;
            background: linear-gradient(180deg, var(--lavender-light) 0%, var(--pink-light) 100%);
        }

        .mini-gallery-grid {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 40px;
        }

        .mini-photo {
            aspect-ratio: 1;
            border-radius: 20px;
            overflow: hidden;
            border: 3px solid white;
            box-shadow: var(--shadow-card);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .mini-photo:hover {
            transform: scale(1.05) rotate(2deg);
            box-shadow: var(--shadow-soft);
        }

        .mini-photo:nth-child(even):hover {
            transform: scale(1.05) rotate(-2deg);
        }

        .mini-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mini-photo .ph-wrap {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-mid);
            font-size: 0.8rem;
        }

        .mini-photo .ph-wrap .ph-icon {
            font-size: 2rem;
        }

        .mini-photo-1 {
            background: linear-gradient(135deg, #FFD6E7, #FFC0D5);
        }

        .mini-photo-2 {
            background: linear-gradient(135deg, #C9B8FF, #B8A8F5);
        }

        .mini-photo-3 {
            background: linear-gradient(135deg, #FFE566, #FFD040);
        }

        .mini-photo-4 {
            background: linear-gradient(135deg, #B8F0E0, #80E0C0);
        }

        .gallery-cta {
            text-align: center;
        }

        /* =========== CUTE QUOTE =========== */
        .quote-section {
            padding: 80px 24px;
            background: var(--cream);
            text-align: center;
        }

        .quote-card {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            border-radius: var(--radius-xl);
            padding: 50px 40px;
            box-shadow: var(--shadow-soft);
            position: relative;
            border: 3px solid var(--pink-light);
        }

        .quote-card::before {
            content: '❝';
            position: absolute;
            top: -20px;
            left: 40px;
            font-size: 4rem;
            color: var(--pink-main);
            line-height: 1;
        }

        .quote-text {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            color: var(--text-dark);
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .quote-author {
            color: var(--pink-main);
            font-weight: 800;
            font-size: 0.95rem;
        }

        .quote-decorations {
            display: flex;
            justify-content: center;
            gap: 12px;
            margin-top: 24px;
            font-size: 1.3rem;
        }

        .quote-deco {
            animation: bounce 2s ease-in-out infinite;
        }

        .quote-deco:nth-child(2) {
            animation-delay: 0.3s;
        }

        .quote-deco:nth-child(3) {
            animation-delay: 0.6s;
        }

        /* =========== RESPONSIVE =========== */
        @media (max-width: 900px) {
            .hero-inner {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 40px;
            }

            .hero-title {
                font-size: 3rem;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-visual {
                order: -1;
            }

            .hero-photo-frame {
                width: 280px;
                height: 300px;
            }

            .counter-inner {
                grid-template-columns: 1fr;
                max-width: 340px;
            }

            .about-inner {
                grid-template-columns: 1fr;
            }

            .mini-gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .quote-text {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.4rem;
            }

            .counter-num {
                font-size: 2.2rem;
            }
        }
    </style>
@endsection

@section('content')

    <!-- HERO -->
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="hero-inner">
            <div class="hero-text">
                <div class="hero-eyebrow">
                    <span>✨</span> Halo Nona Manis !!
                </div>
                <h1 class="hero-title">
                    Setiap Hari Bersamamu<br>
                    adalah <span class="highlight">Keajaiban</span> ✨
                </h1>
                <p class="hero-desc">
                    Website ini dibuat menggunakan 100000000000000% cinta, sayang 💕<br>
                    Isinya Banyaaakkk, ada kumpulan foto, dan surat cinta yang sa bikin. Semoga sayang sukakk!!!
                </p>
                <div class="hero-buttons">
                    <a href="{{ route('gallery') }}" class="btn-primary">🖼️ Lihat Gallery</a>
                    <a href="{{ route('letter') }}" class="btn-secondary">💌 Baca Suratku</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-photo-frame">
                    <img src="{{ asset('images/foto5.jpeg') }}" alt="Foto Kita">
                    {{-- <div class="hero-photo-placeholder">📸</div>
                <div class="hero-photo-label">Foto Kita Di Sini</div> --}}
                </div>
                <div class="deco-sticker sticker-1">🌸</div>
                <div class="deco-sticker sticker-2">💖</div>
                <div class="deco-sticker sticker-3">⭐</div>
            </div>
        </div>
    </section>

    <!-- LOVE COUNTER -->
    <section class="love-counter">
        <div class="counter-inner">
            <div class="counter-box anim-fade-up delay-1">
                <div class="counter-emoji">💕</div>
                <span class="counter-num" id="daysCount">0</span>
                <div class="counter-label">Hari Bersama</div>
            </div>
            <div class="counter-box anim-fade-up delay-2">
                <div class="counter-emoji">📸</div>
                <span class="counter-num">{{ $photoCount ?? '42' }}</span>
                <div class="counter-label">Foto Kenangan</div>
            </div>
            <div class="counter-box anim-fade-up delay-3">
                <div class="counter-emoji">🌟</div>
                <span class="counter-num">∞</span>
                <div class="counter-label">Rasa Sayangku</div>
            </div>
        </div>
    </section>

    <!-- ABOUT / INTRO -->
    <section class="about-section">
        <div class="about-inner">
            <div class="about-photo-wrap anim-fade-left">
                <div class="about-photo-main">
                    <img src="{{ asset('images/foto10.jpeg') }}" alt="Foto">
                </div>
                <div class="about-photo-small">
                    <img src="{{ asset('images/foto1.jpeg') }}" alt="">

                </div>
            </div>
            <div class="about-text anim-fade-right">
                <div class="badge">💝 Tentang Dirimuuu</div>
                <h2 class="about-title">
                    Olivia Liptiay<br>Pacar Saya Yang Cantik 🌸
                </h2>
                <p class="about-desc">
                    Nama : Olivia Liptiay <br>
                    Umur : 23 Tahun <br>
                    Zodiak : Taurus Bulan Meiiii<br>
                    Hobi : Dengar musik, jalan-jalan, makan enak, foto-foto lucu, dan ngobrol sampai malam 🌟<br>
                </p>
                <div class="love-tags">
                    <span class="love-tag love-tag-pink">🎵 Suka musik bareng</span>
                    <span class="love-tag love-tag-lavender">🍜 Makan enak</span>
                    <span class="love-tag love-tag-peach">📸 Foto-foto lucu</span>
                    <span class="love-tag love-tag-mint">🌿 Jalan santai</span>
                    <span class="love-tag love-tag-yellow">⭐ Ngobrol sampai malam</span>
                </div>
                <a href="{{ route('moments') }}" class="btn-primary">⭐ Lihat Momen Kita</a>
            </div>
        </div>
    </section>

    <!-- MINI GALLERY PREVIEW -->
    <section class="mini-gallery">
    <div class="section-title">Cuplikan Kenangan 📷</div>
    <div class="section-subtitle">Beberapa foto favorit dari kita berdua 💕</div>
    <div class="mini-gallery-grid">
        <div class="mini-photo mini-photo-1">
            <img src="{{ asset('images/foto17.jpeg') }}" alt="Foto 1">
        </div>
        <div class="mini-photo mini-photo-2">
            <img src="{{ asset('images/foto2.jpeg') }}" alt="Foto 2">
        </div>
        <div class="mini-photo mini-photo-3">
            <img src="{{ asset('images/foto20.jpeg') }}" alt="Foto 3">
        </div>
        <div class="mini-photo mini-photo-4">
            <img src="{{ asset('images/foto4.jpeg') }}" alt="Foto 4">
        </div>
    </div>
    <div class="gallery-cta">
        <a href="{{ route('gallery') }}" class="btn-primary">🖼️ Lihat Semua Foto</a>
    </div>
</section>

    <!-- QUOTE -->
    <section class="quote-section">
        <div class="quote-card anim-fade-up">
            <p class="quote-text">

                "Semoga Sayang Selalu Happyyyy Yakkkk Lopyuuu"
            </p>
            <div class="quote-author">— Dari Lelaki paling tampan, untuk nona manis 💕</div>
            <div class="quote-decorations">
                <span class="quote-deco">🌸</span>
                <span class="quote-deco">💖</span>
                <span class="quote-deco">🌟</span>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        // Love counter days
        const startDate = new Date('{{ $startDate ?? '2024-01-01' }}');
        const today = new Date();
        const diffTime = Math.abs(today - startDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        // Animate counter
        let current = 0;
        const interval = setInterval(() => {
            current += Math.ceil(diffDays / 50);
            if (current >= diffDays) {
                current = diffDays;
                clearInterval(interval);
            }
            document.getElementById('daysCount').textContent = current;
        }, 20);
    </script>
@endsection
