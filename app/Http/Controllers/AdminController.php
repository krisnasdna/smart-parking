<?php

namespace App\Http\Controllers;

use App\Models\ParkingSlot;
use Illuminate\Http\Request;
use App\Models\RegisteredCard;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    // Menampilkan form pendaftaran kartu
    public function showRegisterCardForm()
    {
        return view('admin.register-card');  // Menampilkan form pendaftaran kartu
    }
    // Menyimpan data kartu yang baru
    public function storeCard(Request $request)
    {
        $request->validate([
            'card_id' => 'required|unique:registered_cards,card_id',
            'nim'=>'required|integer',
            'name' => 'required|string',
            'prodi' => 'required|string',
            'tgl_lahir' => 'required|date',
        ]);

        // Menyimpan data kartu yang baru
        RegisteredCard::create([
            'card_id' => $request->card_id,
            'nim'=> $request->nim,
            'name' => $request->name,
            'prodi' => $request->prodi,
            'tgl_lahir' => $request->tgl_lahir,
        ]);

        return redirect()->route('admin.register_cards')->with('success', 'Card successfully registered');
    }

    public function showParkingSlots()
    {
        $slots = ParkingSlot::all();
        return view('admin.slots', compact('slots'));
    }
}
