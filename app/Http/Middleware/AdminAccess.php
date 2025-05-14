<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Siswa;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // Izinkan super_admin dan guru
        if ($user->hasRole('super_admin') || $user->hasRole('guru')) {
            return $next($request);
        }

        // Jika siswa, cek apakah sudah di-approve
        if ($user->hasRole('siswa')) {
            $siswa = Siswa::where('email', $user->email)->first();

            if ($siswa && $siswa->is_approved) {
                return $next($request);
            }
        }

        // Jika tidak memenuhi kondisi apa pun, tolak
        abort(403, 'Access denied');
    }
}
