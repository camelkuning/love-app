<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SweetheartController extends Controller
{
    /**
     * Konfigurasi website — sesuaikan di sini!
     */
    private array $config = [
        // Tanggal mulai berpacaran (format: YYYY-MM-DD)
        'start_date' => '2022-12-08',

        // Nama pengirim surat cinta
        'sender_name' => 'Nyong Gagah',

        // Jumlah foto (untuk counter di homepage)
        'photo_count' => 99999999,
    ];

    private array $quotes = [
        'Bersamamu, setiap detik terasa berharga dan indah.',
        'Kamu adalah alasan aku tersenyum setiap pagi.',
        'Mencintaimu adalah hal terbaik yang pernah aku lakukan.',
        'Dengan kamu, rumah bisa berarti di mana saja.',
        'Kamu bukan hanya pacarku, kamu juga sahabat terbaikku.',
        'Setiap hari bersamamu adalah petualangan yang aku tunggu.',
        'Aku tidak butuh bintang-bintang di langit, cukup kamu.',
        'Dalam setiap senyumanmu, aku menemukan kebahagiaanku.',
    ];

    // ============================================================
    //  HOME PAGE
    // ============================================================
    public function home()
    {
        return view('pages.home', [
            'startDate'   => $this->config['start_date'],
            'photoCount'  => $this->config['photo_count'],
            'quotes'      => $this->quotes,
            'randomQuote' => array_rand($this->quotes),
        ]);
    }

    // ============================================================
    //  GALLERY PAGE
    // ============================================================
    public function gallery()
    {
        /**
         * Untuk menambah foto nyata, tambahkan item di array ini:
         *
         * [
         *     'src'   => 'images/foto-1.jpg',  // Path di dalam /public/
         *     'title' => 'Nama Foto',
         *     'desc'  => 'Deskripsi singkat foto ini',
         *     'cat'   => 'selfie',              // selfie | travel | food | special
         *     'size'  => 'tall',                // tall | wide | square
         * ]
         */
        $photos = [
            // Foto kamu dari database/storage bisa di-load di sini
            // Contoh menggunakan Storage::files('public/photos')
        ];

        return view('pages.gallery', compact('photos'));
    }

    // ============================================================
    //  MOMENTS / TIMELINE PAGE
    // ============================================================
    public function moments()
    {
        /**
         * Kamu bisa memindahkan array $moments dari blade ke sini
         * dan pass sebagai variable untuk data yang lebih bersih.
         *
         * Atau load dari database jika sudah ada model Moment.
         */
        return view('pages.moments');
    }

    // ============================================================
    //  LOVE LETTER PAGE
    // ============================================================
    public function letter()
    {
        return view('pages.letter', [
            'senderName' => $this->config['sender_name'],
        ]);
    }
}
