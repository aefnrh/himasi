<?php

namespace App\Http\Controllers;

use App\Models\Aspiration;
use App\Models\Setting;
use Illuminate\Http\Request;

class AspirationController extends Controller
{
    /**
     * Display the aspiration list.
     */
    public function index()
    {
        $settings = Setting::pluck('setting_value', 'setting_key')->toArray();
        
        return view('pages.aspirations', compact('settings'));
    }

    /**
     * Display the aspiration form.
     */
    public function create()
    {
        $settings = Setting::pluck('setting_value', 'setting_key')->toArray();
        
        return view('pages.aspirations.create', compact('settings'));
    }

    /**
     * Store a newly created aspiration in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // Tambahkan user_id jika user sedang login
        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        Aspiration::create($validated);

        // Redirect ke halaman user aspirations jika user login, jika tidak ke halaman aspirasi publik
        if (auth()->check()) {
            return redirect()->route('user.aspirations.index')
                ->with('success', 'Aspirasi Anda telah berhasil dikirim. Terima kasih atas masukan Anda!');
        } else {
            return redirect()->route('aspirations.index')
                ->with('success', 'Aspirasi Anda telah berhasil dikirim. Terima kasih atas masukan Anda!');
        }
    }
}
