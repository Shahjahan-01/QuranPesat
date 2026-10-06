<?php

namespace Tests\Feature;

use Tests\TestCase;

class QuranPesatTest extends TestCase
{
    public function test_home_page_is_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Nurul Qur\'an', false);
    }

    public function test_quran_index_page_is_accessible()
    {
        $response = $this->get('/quran');
        $response->assertStatus(200);
        $response->assertSee('Al-Qur\'an Al-Karim', false);
        $response->assertSee('Al-Fatihah', false);
    }

    public function test_quran_detail_page_is_accessible()
    {
        $response = $this->get('/quran/surat/1');
        $response->assertStatus(200);
        $response->assertSee('Al-Fatihah', false);
        $response->assertSee('Tafsir Kemenag RI', false);
    }

    public function test_doa_index_page_is_accessible()
    {
        $response = $this->get('/doa');
        $response->assertStatus(200);
        $response->assertSee('Kumpulan Doa Harian', false);
    }

    public function test_doa_detail_page_is_accessible()
    {
        $response = $this->get('/doa/1');
        $response->assertStatus(200);
        $response->assertSee('Doa Sebelum Tidur', false);
    }

    public function test_sholat_page_is_accessible()
    {
        $response = $this->get('/jadwal-sholat');
        $response->assertStatus(200);
        $response->assertSee('Jadwal Shalat', false);
    }

    public function test_laporan_page_is_accessible()
    {
        $response = $this->get('/laporan');
        $response->assertStatus(200);
        $response->assertSee('LEMBAR KERJA PESERTA DIDIK', false);
        $response->assertSee('Jawaban Pertanyaan Laporan LKPD', false);
    }
}
