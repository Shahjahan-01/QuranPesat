<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RobloxController extends Controller
{
    /**
     * Tampilkan profil pemain Roblox berdasarkan username atau default
     */
    public function index(Request $request)
    {
        $searchUsername = trim($request->query('username', 'Roblox'));
        if (empty($searchUsername)) {
            $searchUsername = 'Roblox';
        }

        $userId = null;
        $profile = null;
        $avatarHeadshot = null;
        $avatarFull = null;
        $followersCount = 0;
        $friendsCount = 0;
        $error = null;

        try {
            // 1. Dapatkan User ID dari Username
            $searchResponse = Http::timeout(6)->post('https://users.roblox.com/v1/usernames/users', [
                'usernames' => [$searchUsername],
                'excludeBannedUsers' => false
            ]);

            if ($searchResponse->successful() && !empty($searchResponse->json()['data'])) {
                $matchedUser = $searchResponse->json()['data'][0];
                $userId = $matchedUser['id'];
            } else {
                $error = "Pengguna Roblox dengan nama \"{$searchUsername}\" tidak ditemukan.";
            }

            // Jika User ID ditemukan, ambil data pelengkap
            if ($userId) {
                // Detail profil (bio, created_at, dll)
                $userResponse = Http::timeout(6)->get("https://users.roblox.com/v1/users/{$userId}");
                if ($userResponse->successful()) {
                    $profile = $userResponse->json();
                }

                // Avatar Headshot
                $headshotResponse = Http::timeout(6)->get("https://thumbnails.roblox.com/v1/users/avatar-headshot?userIds={$userId}&size=150x150&format=Png&isCircular=false");
                if ($headshotResponse->successful() && !empty($headshotResponse->json()['data'])) {
                    $avatarHeadshot = $headshotResponse->json()['data'][0]['imageUrl'] ?? null;
                }

                // Avatar Full Body
                $fullResponse = Http::timeout(6)->get("https://thumbnails.roblox.com/v1/users/avatar?userIds={$userId}&size=352x352&format=Png&isCircular=false");
                if ($fullResponse->successful() && !empty($fullResponse->json()['data'])) {
                    $avatarFull = $fullResponse->json()['data'][0]['imageUrl'] ?? null;
                }

                // Followers Count
                $followersResponse = Http::timeout(5)->get("https://friends.roblox.com/v1/users/{$userId}/followers/count");
                if ($followersResponse->successful()) {
                    $followersCount = $followersResponse->json()['count'] ?? 0;
                }

                // Friends Count
                $friendsResponse = Http::timeout(5)->get("https://friends.roblox.com/v1/users/{$userId}/friends/count");
                if ($friendsResponse->successful()) {
                    $friendsCount = $friendsResponse->json()['count'] ?? 0;
                }
            }
        } catch (\Exception $e) {
            $error = "Terjadi kendala saat menghubungi API Roblox: " . $e->getMessage();
        }

        return view('roblox', [
            'searchUsername' => $searchUsername,
            'profile'        => $profile,
            'avatarHeadshot' => $avatarHeadshot,
            'avatarFull'     => $avatarFull,
            'followersCount' => $followersCount,
            'friendsCount'   => $friendsCount,
            'error'          => $error,
        ]);
    }
}
