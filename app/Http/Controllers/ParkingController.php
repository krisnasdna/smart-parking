<?php

namespace App\Http\Controllers;

use App\Models\ParkingSlot;
use Illuminate\Http\Request;
use App\Models\RegisteredCard;
use Illuminate\Support\Facades\Http;

class ParkingController extends Controller
{
    public function index()
    {
        // Ambil semua data slot parkir
        $slots = ParkingSlot::all();  

        // Kirim data ke view
        return view('welcome', compact('slots'));
    }
    // Halaman pendaftaran kartu
    public function showRegisterCardForm()
    {
        return view('admin.register-card');  // Menampilkan form pendaftaran kartu
    }
    public function receiveCardId(Request $request)
    {
        $cardId = $request->input('card_id');  // Mengambil ID kartu dari request
        
        // Kirim ID kartu ke view untuk ditampilkan dalam form
        return view('register-card', ['cardId' => $cardId]);
    }
     // Endpoint untuk memulai proses pendaftaran kartu
     public function scanCard()
     {
         // URL ESP32 (sesuaikan dengan IP ESP32 di jaringan lokal)
        $esp32Url = 'http://192.168.1.81/set_mode';

        try {
            // Kirimkan permintaan ke ESP32 untuk scan kartu
            $response = Http::timeout(15)->get($esp32Url);

            if ($response->successful()) {
                $cardID = $response->json('card_id');
                return response()->json([
                    'status' => 'success',
                    'card_id' => $cardID,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No card detected or ESP32 not responding.',
                ], 408);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to connect to ESP32.',
            ], 500);
        }
     }
 
     // Endpoint untuk mendaftarkan kartu
     public function registerCard(Request $request)
     {
         $request->validate([
             'card_id' => 'required|string|unique:registered_cards,card_id',
         ]);
 
         // Simpan ID kartu RFID ke dalam database
         $card = new RegisteredCard();
         $card->card_id = $request->card_id;
         $card->save();
 
         return response()->json(['message' => 'success'], 200);
     }
 
     public function verifyCard($cardID)
    {
        // Cari kartu di database
        $card = RegisteredCard::where('card_id', $cardID)->first();

        if ($card) {
            // Jika kartu terdaftar, kirim response valid
            return response()->json([
                'status' => 'valid',
                'message' => 'Card is valid'
            ]);
        } else {
            // Jika kartu tidak terdaftar, kirim response error
            return response()->json([
                'status' => 'error',
                'message' => 'Card not registered'
            ]);
        }
    }

    // API untuk mengupdate status slot parkir
    public function updateSlotStatus(Request $request)
    {
        $request->validate([
            'slot_id' => 'required|string|exists:parking_slots,slot_id', // Validasi slot_id
            'status' => 'required|boolean', // 0 untuk kosong, 1 untuk terisi
        ]);

        // Menyimpan status terbaru dari slot parkir berdasarkan slot_id
        $slot = ParkingSlot::where('slot_id', $request->slot_id)->first();
        $slot->status = $request->status;
        $slot->save();

        return response()->json(['message' => 'Slot status updated'], 200);
    }
}
