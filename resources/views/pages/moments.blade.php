@extends('layouts.app')

@section('title', '⭐ Moments — My Sweetheart')

@section('styles')
<style>
.moments-page {
    max-width: 1100px;
    margin: 0 auto;
    padding: 60px 24px 80px;
}

.moments-hero {
    text-align: center;
    margin-bottom: 70px;
}

.moments-hero-icon {
    font-size: 4rem;
    display: block;
    margin-bottom: 16px;
    animation: spin 8s linear infinite;
}

/* =========== TIMELINE =========== */
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(to bottom, var(--pink-light), var(--lavender), var(--mint-light));
    border-radius: 4px;
    transform: translateX(-50%);
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    gap: 30px;
    margin-bottom: 60px;
    position: relative;
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
}

.timeline-item:nth-child(odd) { flex-direction: row; }
.timeline-item:nth-child(even) { flex-direction: row-reverse; }

.timeline-item:nth-child(1) { animation-delay: 0.1s; }
.timeline-item:nth-child(2) { animation-delay: 0.2s; }
.timeline-item:nth-child(3) { animation-delay: 0.3s; }
.timeline-item:nth-child(4) { animation-delay: 0.4s; }
.timeline-item:nth-child(5) { animation-delay: 0.5s; }
.timeline-item:nth-child(6) { animation-delay: 0.6s; }

.timeline-card {
    width: calc(50% - 50px);
    background: white;
    border-radius: var(--radius-xl);
    padding: 28px;
    box-shadow: var(--shadow-card);
    border: 2.5px solid var(--pink-light);
    position: relative;
    transition: all 0.3s;
}

.timeline-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-soft);
    border-color: var(--pink-mid);
}

.timeline-item:nth-child(odd) .timeline-card::after {
    content: '';
    position: absolute;
    right: -16px;
    top: 28px;
    border: 8px solid transparent;
    border-left-color: var(--pink-light);
}

.timeline-item:nth-child(even) .timeline-card::after {
    content: '';
    position: absolute;
    left: -16px;
    top: 28px;
    border: 8px solid transparent;
    border-right-color: var(--pink-light);
}

.timeline-center {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
    border: 4px solid white;
    box-shadow: 0 4px 16px rgba(255, 107, 157, 0.3);
    z-index: 2;
    flex-shrink: 0;
}

.center-pink { background: linear-gradient(135deg, var(--pink-main), var(--pink-deep)); }
.center-lavender { background: linear-gradient(135deg, var(--lavender), #9B6FDB); }
.center-mint { background: linear-gradient(135deg, var(--mint), #4AC8A0); }
.center-peach { background: linear-gradient(135deg, var(--peach), #E87A3C); }
.center-yellow { background: linear-gradient(135deg, var(--yellow), #E8B800); }

.timeline-spacer { width: calc(50% - 50px); }

.tl-date {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--pink-light);
    color: var(--pink-deep);
    padding: 5px 14px;
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 800;
    margin-bottom: 12px;
}

.tl-title {
    font-family: 'Dancing Script', cursive;
    font-size: 1.6rem;
    color: var(--text-dark);
    margin-bottom: 10px;
    line-height: 1.3;
}

.tl-desc {
    color: var(--text-mid);
    font-size: 0.92rem;
    line-height: 1.7;
    margin-bottom: 16px;
}

.tl-photo {
    width: 100%;
    aspect-ratio: 16/9;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 14px;
}

.tl-photo img { width: 100%; height: 100%; object-fit: cover; }

.tl-photo-ph {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
}

.tl-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.tl-tag {
    background: var(--lavender-light);
    color: #6B4FBB;
    padding: 4px 12px;
    border-radius: var(--radius-full);
    font-size: 0.78rem;
    font-weight: 700;
}

/* =========== MEMORIES GRID =========== */
.memories-section {
    margin-top: 80px;
    padding-top: 60px;
    border-top: 3px dashed var(--pink-light);
}

.memories-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 40px;
}

.memory-card {
    background: white;
    border-radius: var(--radius-xl);
    padding: 24px;
    text-align: center;
    box-shadow: var(--shadow-card);
    border: 2.5px solid var(--pink-light);
    transition: all 0.3s;
    cursor: default;
}

.memory-card:hover {
    transform: translateY(-8px) rotate(1deg);
    box-shadow: var(--shadow-soft);
}

.memory-card:nth-child(even):hover { transform: translateY(-8px) rotate(-1deg); }

.memory-emoji { font-size: 3rem; margin-bottom: 12px; display: block; }

.memory-title {
    font-family: 'Dancing Script', cursive;
    font-size: 1.3rem;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.memory-text {
    color: var(--text-mid);
    font-size: 0.85rem;
    line-height: 1.6;
}

/* =========== RESPONSIVE =========== */
@media (max-width: 768px) {
    .timeline::before { left: 28px; }
    .timeline-item, .timeline-item:nth-child(even) { flex-direction: column !important; padding-left: 70px; }
    .timeline-card { width: 100%; }
    .timeline-card::after, .timeline-item:nth-child(even) .timeline-card::after { display: none; }
    .timeline-center { left: 28px; }
    .timeline-spacer { display: none; }
    .memories-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 480px) {
    .memories-grid { grid-template-columns: 1fr; }
}
</style>
@endsection

@section('content')
<div class="moments-page">

    <!-- Hero -->
    <div class="moments-hero anim-fade-up">
        <span class="moments-hero-icon">⭐</span>
        <div class="section-title">Momen Kita Bersama</div>
        <p class="section-subtitle">Setiap momen bersamamu adalah kenangan yang tak ternilai 💕</p>
    </div>

    <!-- Timeline -->
    <div class="timeline">

        @php
        $moments = [
            [
                'emoji' => '💕', 'center_class' => 'center-pink',
                'date' => '1 Januari 2024', 'date_emoji' => '📅',
                'title' => 'Awal Dari Segalanya',
                'desc' => 'Hari pertama kita kenal, rasanya biasa aja, tapi ternyata menjadi awal dari sesuatu yang luar biasa indah. Siapa yang tahu ya? 😊',
                'photo_bg' => 'linear-gradient(135deg, #FFD6E7, #FFAAC9)',
                'photo_icon' => '💕',
                'tags' => ['Pertemuan', 'Awal', '2024'],
            ],
            [
                'emoji' => '☕', 'center_class' => 'center-lavender',
                'date' => 'Februari 2024', 'date_emoji' => '☕',
                'title' => 'Date Pertama Kita',
                'desc' => 'Coffee date pertama yang bikin aku sadar — aku suka banget ngobrol sama kamu. Waktu terasa terbang cepat banget!',
                'photo_bg' => 'linear-gradient(135deg, #EDE8FF, #C9B8FF)',
                'photo_icon' => '☕',
                'tags' => ['Date', 'Kafe', 'Spesial'],
            ],
            [
                'emoji' => '🌸', 'center_class' => 'center-mint',
                'date' => 'Maret 2024', 'date_emoji' => '🌸',
                'title' => 'Jalan-Jalan Pertama',
                'desc' => 'Kita jalan bareng untuk pertama kalinya — seru banget! Kamu lucu kalau lagi excited nemenin aku foto-foto 📸',
                'photo_bg' => 'linear-gradient(135deg, #E0FBF3, #B8F0E0)',
                'photo_icon' => '🌸',
                'tags' => ['Jalan', 'Seru', 'Foto'],
            ],
            [
                'emoji' => '⭐', 'center_class' => 'center-yellow',
                'date' => 'Juni 2024', 'date_emoji' => '⭐',
                'title' => 'Resmi Jadi Kita',
                'desc' => 'Dari teman, jadi lebih dari teman. Hari ini jadi salah satu hari terbaik dalam hidupku 💖',
                'photo_bg' => 'linear-gradient(135deg, #FFF8CC, #FFE566)',
                'photo_icon' => '⭐',
                'tags' => ['Resmi', 'Spesial', 'Bahagia'],
            ],
            [
                'emoji' => '✈️', 'center_class' => 'center-peach',
                'date' => 'Agustus 2024', 'date_emoji' => '✈️',
                'title' => 'Liburan Bareng',
                'desc' => 'Liburan pertama kita! Semua jadi lebih berwarna dan menyenangkan kalau ada kamu di sampingku 🌈',
                'photo_bg' => 'linear-gradient(135deg, #FFE5D0, #FFB085)',
                'photo_icon' => '✈️',
                'tags' => ['Liburan', 'Petualangan', 'Kenangan'],
            ],
        ];
        @endphp

        @foreach($moments as $i => $moment)
        <div class="timeline-item">
            @if($i % 2 == 0)
                <div class="timeline-card">
                    <div class="tl-date">
                        <span>{{ $moment['date_emoji'] }}</span>
                        {{ $moment['date'] }}
                    </div>
                    <h3 class="tl-title">{{ $moment['title'] }}</h3>
                    <div class="tl-photo">
                        <div class="tl-photo-ph" style="background: {{ $moment['photo_bg'] }};">
                            {{ $moment['photo_icon'] }}
                        </div>
                        {{-- Ganti dengan: <img src="{{ asset('images/moment-'.$loop->iteration.'.jpg') }}" alt="{{ $moment['title'] }}"> --}}
                    </div>
                    <p class="tl-desc">{{ $moment['desc'] }}</p>
                    <div class="tl-tags">
                        @foreach($moment['tags'] as $tag)
                            <span class="tl-tag">#{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="timeline-center {{ $moment['center_class'] }}">{{ $moment['emoji'] }}</div>
                <div class="timeline-spacer"></div>
            @else
                <div class="timeline-spacer"></div>
                <div class="timeline-center {{ $moment['center_class'] }}">{{ $moment['emoji'] }}</div>
                <div class="timeline-card">
                    <div class="tl-date">
                        <span>{{ $moment['date_emoji'] }}</span>
                        {{ $moment['date'] }}
                    </div>
                    <h3 class="tl-title">{{ $moment['title'] }}</h3>
                    <div class="tl-photo">
                        <div class="tl-photo-ph" style="background: {{ $moment['photo_bg'] }};">
                            {{ $moment['photo_icon'] }}
                        </div>
                    </div>
                    <p class="tl-desc">{{ $moment['desc'] }}</p>
                    <div class="tl-tags">
                        @foreach($moment['tags'] as $tag)
                            <span class="tl-tag">#{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        @endforeach

    </div>

    <!-- Memories Section -->
    <div class="memories-section">
        <div class="section-title">Hal-Hal Kecil Yang Kusuka 💖</div>
        <p class="section-subtitle">Detail kecil tentangmu yang bikin aku makin sayang</p>

        <div class="memories-grid">
            <div class="memory-card">
                <span class="memory-emoji">😂</span>
                <div class="memory-title">Tawa Kamu</div>
                <p class="memory-text">Cara kamu tertawa sampai nangis adalah hal paling lucu dan menggemaskan yang pernah aku lihat</p>
            </div>
            <div class="memory-card">
                <span class="memory-emoji">🤗</span>
                <div class="memory-title">Pelukanmu</div>
                <p class="memory-text">Pelukan kamu bikin semua masalah terasa menghilang seketika. Rasanya aman banget</p>
            </div>
            <div class="memory-card">
                <span class="memory-emoji">🎵</span>
                <div class="memory-title">Playlist Kita</div>
                <p class="memory-text">Lagu-lagu yang kita dengar bareng sekarang punya makna tersendiri untukku</p>
            </div>
            <div class="memory-card">
                <span class="memory-emoji">🍜</span>
                <div class="memory-title">Makan Bareng</div>
                <p class="memory-text">Makanan apapun terasa lebih enak kalau dimakan bareng kamu</p>
            </div>
            <div class="memory-card">
                <span class="memory-emoji">💬</span>
                <div class="memory-title">Ngobrol Tengah Malam</div>
                <p class="memory-text">Ngobrolin hal random sampai lupa waktu — ini salah satu bagian favorit aku dari kita</p>
            </div>
            <div class="memory-card">
                <span class="memory-emoji">🌅</span>
                <div class="memory-title">Setiap Hari Bareng</div>
                <p class="memory-text">Nggak perlu momen spesial — setiap hari biasa bersamamu sudah sangat berarti bagiku</p>
            </div>
        </div>
    </div>

</div>
@endsection
