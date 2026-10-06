<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $singleQuote = [
            'quote' => 'Hidup adalah petualangan yang berani atau tidak sama sekali.',
            'author' => 'Helen Keller'
        ];

        try {
            $response = Http::timeout(5)->get('https://dummyjson.com/quotes');
            if ($response->successful()) {
                $quotes = $response->json()['quotes'] ?? [];
                if (!empty($quotes)) {
                    $singleQuote = $quotes[array_rand($quotes)];
                }
            }
        } catch (\Exception $e) {
            // Gunakan fallback jika request gagal / timeout
        }

        return view('welcome', ['quotes' => $singleQuote]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
