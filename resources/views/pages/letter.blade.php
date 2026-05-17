@extends('layouts.app')

@section('title', '💌 Surat Cinta — My Sweetheart')

@section('styles')
<style>
.letter-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 60px 24px 80px;
}

.letter-hero {
    text-align: center;
    margin-bottom: 60px;
}

/* =========== ENVELOPE ANIMATION =========== */
.envelope-wrap {
    display: flex;
    justify-content: center;
    margin-bottom: 50px;
}

.envelope-container {
    position: relative;
    width: 280px;
    height: 180px;
    cursor: pointer;
    perspective: 1000px;
}

.envelope {
    position: relative;
    width: 100%;
    height: 100%;
}


.env-body {
    position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #FF6B9D, #E8437A);
    border-radius: 8px;
    box-shadow: 0 16px 48px rgba(255, 107, 157, 0.4);
    z-index: 1;
}

/* Segitiga bawah dalam amplop */
.env-body::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 0;
    border-left: 140px solid transparent;
    border-right: 140px solid transparent;
    border-bottom: 90px solid rgba(255, 255, 255, 0.15);
}

/* Segitiga kiri & kanan */
.env-body::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        linear-gradient(135deg, rgba(255,255,255,0.12) 50%, transparent 50%),
        linear-gradient(225deg, rgba(255,255,255,0.12) 50%, transparent 50%);
    background-size: 50% 100%;
    background-position: left, right;
    background-repeat: no-repeat;
}


.env-flap {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 0;
    border-left: 140px solid transparent;
    border-right: 140px solid transparent;
    border-top: 100px solid #FF8EB5;
    transform-origin: top center;
    transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 3;
}
/* Animasi buka flap */
.envelope-container.open .env-flap {
    transform: rotateX(-180deg);
}

/* Kertas surat di dalam */
.env-letter {
    position: absolute;
    bottom: 10px;
    left: 20px;
    right: 20px;
    height: 100px;
    background: white;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    z-index: 2;
    transition: transform 0.6s ease, bottom 0.6s ease;
    box-shadow: 0 4px 16px rgba(0,0,0,0.15);
}

.envelope-container.open .env-letter {
    transform: translateY(-80px);
    bottom: 40px;
}

/* Stempel/seal */
.env-seal {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 44px;
    height: 44px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    z-index: 4;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: opacity 0.3s;
}

.envelope-container.open .env-seal {
    opacity: 0;
}

.envelope-hint {
    text-align: center;
    margin-top: 16px;
    color: var(--text-light);
    font-size: 0.85rem;
    font-weight: 700;
    animation: bounce 1.5s ease-in-out infinite;
}

/* =========== LETTER CARD =========== */
.letter-card {
    background: white;
    border-radius: var(--radius-xl);
    padding: 50px 48px;
    box-shadow: var(--shadow-soft);
    border: 3px solid var(--pink-light);
    position: relative;
    margin-bottom: 32px;
    display: none;
    animation: fadeInUp 0.6s ease forwards;
}

.letter-card.visible { display: block; }

.letter-card::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 20px;
    right: 20px;
    bottom: 20px;
    border: 1.5px dashed var(--pink-light);
    border-radius: 20px;
    pointer-events: none;
}

.letter-watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 10rem;
    opacity: 0.04;
    pointer-events: none;
}

.letter-header {
    text-align: center;
    margin-bottom: 36px;
}

.letter-date {
    color: var(--text-light);
    font-size: 0.85rem;
    font-weight: 700;
    margin-bottom: 16px;
}

.letter-to {
    font-family: 'Dancing Script', cursive;
    font-size: 1.8rem;
    color: var(--pink-main);
    margin-bottom: 8px;
}

.letter-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    color: var(--pink-light);
    font-size: 1.2rem;
}

.letter-divider::before,
.letter-divider::after {
    content: '';
    flex: 1;
    max-width: 80px;
    height: 2px;
    background: linear-gradient(to right, transparent, var(--pink-light));
}

.letter-divider::after {
    background: linear-gradient(to left, transparent, var(--pink-light));
}

.letter-body {
    font-family: 'Nunito', sans-serif;
    font-size: 1.05rem;
    line-height: 1.9;
    color: var(--text-dark);
    margin-bottom: 32px;
}

.letter-body p { margin-bottom: 20px; }

.letter-closing {
    text-align: right;
}

.letter-closing-text {
    font-family: 'Dancing Script', cursive;
    font-size: 1.4rem;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.letter-signature {
    font-family: 'Dancing Script', cursive;
    font-size: 2rem;
    color: var(--pink-main);
}

.letter-hearts {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 2px dashed var(--pink-light);
    font-size: 1.5rem;
}

/* =========== POLAROIDS =========== */
.polaroids-section {
    margin-top: 60px;
}

.polaroids-grid {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 40px;
}

.polaroid {
    background: white;
    padding: 16px 16px 40px;
    border-radius: 4px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    transform: rotate(-3deg);
    transition: all 0.3s ease;
    cursor: pointer;
    max-width: 200px;
}

.polaroid:nth-child(2) { transform: rotate(2deg); }
.polaroid:nth-child(3) { transform: rotate(-1.5deg); }
.polaroid:nth-child(4) { transform: rotate(3deg); }

.polaroid:hover {
    transform: rotate(0deg) scale(1.08) translateY(-8px);
    box-shadow: 0 20px 48px rgba(0,0,0,0.2);
    z-index: 10;
}

.polaroid-photo {
    width: 168px;
    height: 168px;
    border-radius: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    margin-bottom: 12px;
}

.polaroid-caption {
    font-family: 'Dancing Script', cursive;
    font-size: 1.1rem;
    color: var(--text-dark);
    text-align: center;
}

/* =========== REASONS =========== */
.reasons-section {
    margin-top: 60px;
    background: linear-gradient(135deg, var(--pink-light), var(--lavender-light));
    border-radius: var(--radius-xl);
    padding: 50px 40px;
    border: 3px solid var(--pink-mid);
}

.reasons-title {
    font-family: 'Dancing Script', cursive;
    font-size: 2rem;
    color: var(--text-dark);
    margin-bottom: 32px;
    text-align: center;
}

.reasons-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.reason-item {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background: white;
    border-radius: var(--radius-lg);
    padding: 16px;
    box-shadow: var(--shadow-card);
    transition: transform 0.2s;
}

.reason-item:hover { transform: scale(1.03); }

.reason-num {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--pink-main), var(--pink-deep));
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
    font-weight: 800;
    flex-shrink: 0;
}

.reason-text {
    color: var(--text-dark);
    font-size: 0.9rem;
    line-height: 1.6;
    font-weight: 600;
}

/* =========== RESPONSIVE =========== */
@media (max-width: 640px) {
    .letter-card { padding: 32px 24px; }
    .polaroids-grid { gap: 16px; }
    .polaroid { max-width: 150px; }
    .polaroid-photo { width: 118px; height: 118px; }
    .reasons-list { grid-template-columns: 1fr; }
    .reasons-section { padding: 32px 24px; }
}
</style>
@endsection

@section('content')
<div class="letter-page">

    <!-- Hero -->
    <div class="letter-hero anim-fade-up">
        <div class="section-title">Surat Cintaku Untukmu</div>
        <p class="section-subtitle">Klik amplop di bawah untuk membaca suratnya, sayang ✨</p>
    </div>

    <!-- Envelope -->
    <div class="envelope-wrap">
        <div>
            <div class="envelope-container" id="envelopeBtn">
                <div class="envelope">
                    <div class="env-flap"></div>
                    <div class="env-seal">💌</div>
                    <div class="env-letter">📝</div>
                    <div class="env-body"></div>
                </div>
            </div>
            <p class="envelope-hint" id="envelopeHint">👆 Klik untuk membuka</p>
        </div>
    </div>

    <!-- Letter Card (hidden until envelope opened) -->
    <div class="letter-card" id="letterCard">
        <div class="letter-watermark">💕</div>

        <div class="letter-header">
            <div class="letter-date">📅 {{ date('d F Y') }}</div>
            <div class="letter-to">Untuk Kamu, Sayangku 🌸</div>
            <div class="letter-divider">💕</div>
        </div>

        <div class="letter-body">
            <p>
                Hai nona, 😊
            </p>
            <p>
                Terima kasih sayang sudah selalu ada untuk saya, selalu mau memaafkan saya ketika salah, selalu mau untuk menerima saya dalam keadaan apa pun.  💕
            </p>
            <p>
                Sayang semangat terus ya menjalani hari - harinyaaa, semoga sayang diberikan kesehatan, kepintaran, dan juga kekayaan. Juga sayang semakin mencintai diri sendiri dan terlebih sayaaaaa hehe  🌸
            </p>
            <p>
                Sa akan selalu ada untuk sayang kapanpun sayang butuh saya, ada apa-apa sayang boleh ceritaa, sa akan mencoba menjadi yang terbaik bagi sayang, sa mengusahakan selalu sayang agar menjadi lebih baik lagi. ✨
            </p>
            <p>
                Love u always nonaaa 💖
            </p>
        </div>

        <div class="letter-closing">
            <div class="letter-closing-text">Dengan segenap hati,</div>
            <div class="letter-signature"> Nyong Gagah 💕</div>
        </div>

        <div class="letter-hearts">
            <span>💕</span>
            <span>🌸</span>
            <span>⭐</span>
            <span>🌺</span>
            <span>💖</span>
        </div>
    </div>

    <!-- Polaroids -->
    <div class="polaroids-section">
        <div class="section-title">Foto Polaroid Kita</div>
        <div class="polaroids-grid">
            <div class="polaroid">
                <div class="polaroid-photo" >
                    <img src="{{ asset('images/foto13.jpeg') }}" alt="Foto Berdua 💕" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2px;">
                </div>

                <div class="polaroid-caption"></div>
            </div>
            <div class="polaroid">
                <div class="polaroid-photo" >
                    <img src="{{ asset('images/foto40.jpeg') }}" alt="Foto Berdua 💕" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2px;">
                </div>
                <div class="polaroid-caption"></div>
            </div>
            <div class="polaroid">
                <div class="polaroid-photo" >
                    <img src="{{ asset('images/foto14.jpeg') }}" alt="Foto Berdua 💕" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2px;">
                </div>
                <div class="polaroid-caption"></div>
            </div>
            <div class="polaroid">
                <div class="polaroid-photo" >
                    <img src="{{ asset('images/foto1.jpeg') }}" alt="Foto Berdua 💕" style="width: 100%; height: 100%; object-fit: cover; border-radius: 2px;">
                </div>
                <div class="polaroid-caption"></div>
            </div>
        </div>
    </div>

    {{-- <!-- 10 Reasons I Love You -->
    <div class="reasons-section">
        <div class="reasons-title">💖 Alasan Aku Sayang Kamu</div>
        <div class="reasons-list">
            @php
            $reasons = [
                'Senyummu yang selalu bisa bikin hari-hariku lebih cerah',
                'Cara kamu perhatian ke orang-orang sekitarmu',
                'Kamu selalu ada saat aku butuh seseorang untuk bicara',
                'Tawa kamu yang sangat menular dan menggemaskan',
                'Cara kamu melihat hal-hal dari sudut pandang yang berbeda',
                'Kamu berani jadi diri sendiri, itu sangat menginspirasi',
                'Rasa empatimu yang besar terhadap orang lain',
                'Cara kamu menyemangati aku di momen-momen sulit',
                'Kamu selalu berhasil membuatku tertawa bahkan saat down',
                'Hanya karena kamu adalah kamu — dan itu sudah cukup',
            ];
            @endphp
            @foreach($reasons as $i => $reason)
            <div class="reason-item">
                <div class="reason-num">{{ $i + 1 }}</div>
                <div class="reason-text">{{ $reason }}</div>
            </div>
            @endforeach
        </div>
    </div> --}}

</div>
@endsection

@section('scripts')
<script>
const envelopeBtn = document.getElementById('envelopeBtn');
const letterCard = document.getElementById('letterCard');
const envelopeHint = document.getElementById('envelopeHint');
let opened = false;

envelopeBtn.addEventListener('click', () => {
    if (!opened) {
        envelopeBtn.classList.add('open');
        envelopeHint.textContent = '💌 Surat sudah terbuka!';
        setTimeout(() => {
            letterCard.classList.add('visible');
            letterCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 700);
        opened = true;
    }
});
</script>
@endsection
