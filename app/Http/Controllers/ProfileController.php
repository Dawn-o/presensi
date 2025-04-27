<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => auth()->user()
        ]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withInput()
                ->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
        }

        try {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            
            return back()->with('success', 'Password berhasil diubah');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan. Silakan coba lagi.']);
        }
    }
}