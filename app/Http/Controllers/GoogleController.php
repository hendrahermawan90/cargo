<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google untuk autentikasi
     */
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')
                ->stateless()
                ->scopes(['openid', 'profile', 'email'])
                ->redirectUrl(config('services.google.redirect'))
                ->redirect();
        } catch (Exception $e) {
            logger()->error('Google Redirect Error: '.$e->getMessage());
            return redirect()
                ->route('login')
                ->with('error', 'Gagal menghubungkan ke Google. Silakan coba lagi.');
        }
    }

    /**
     * Handle callback dari Google setelah login
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            // Validasi data dari Google
            if (empty($googleUser->email)) {
                throw new Exception('Akun Google tidak menyediakan alamat email');
            }

            // Cari atau buat user baru
            $user = User::firstOrCreate(
                ['email' => $googleUser->email],
                [
                    'name' => $this->getUserName($googleUser),
                    'id_google' => $googleUser->id,
                    'password' => bcrypt(Str::random(32)),
                    'email_verified_at' => now(),
                    'avatar' => $googleUser->avatar ?? null,
                ]
            );

            // Update data jika diperlukan
            $this->updateUserIfNeeded($user, $googleUser);

            Auth::login($user, true);
            
            return redirect()
                ->intended(route('dashboard'))
                ->with('success', 'Login dengan Google berhasil');

        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            return redirect()
                ->route('login')
                ->with('error', 'Sesi login telah habis. Silakan coba lagi.');

        } catch (Exception $e) {
            logger()->error('Google Auth Error: '.$e->getMessage());
            return redirect()
                ->route('login')
                ->with('error', 'Login dengan Google gagal: '.$e->getMessage());
        }
    }

    /**
     * Mendapatkan nama user dari data Google
     */
    private function getUserName($googleUser): string
    {
        return $googleUser->name ?? $googleUser->nickname ?? explode('@', $googleUser->email)[0] ?? 'Pengguna Google';
    }

    /**
     * Update data user jika diperlukan
     */
    private function updateUserIfNeeded(User $user, $googleUser): void
    {
        $updates = [];
        
        if (empty($user->id_google)) {
            $updates['id_google'] = $googleUser->id;
        }
        
        if (empty($user->avatar) && !empty($googleUser->avatar)) {
            $updates['avatar'] = $googleUser->avatar;
        }
        
        if (!empty($updates)) {
            $user->update($updates);
        }
    }
}