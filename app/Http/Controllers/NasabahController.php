<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class NasabahController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $nasabahs = Nasabah::latest()
            ->when($search, function ($query, $search) {
                $query->where('nik', 'like', "%{$search}%")
                      ->orWhere('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('no_hp', 'like', "%{$search}%")
                      ->orWhere('alamat', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->appends(['search' => $search]);

        return view('admin.data-nasabah', compact('nasabahs', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|unique:nasabahs,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|unique:nasabahs,no_hp',
            'alamat' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Password default menggunakan format DDMMYYYY dari tanggal lahir
            $password = Carbon::parse($request->tanggal_lahir)->format('dmY');

            $user = User::create([
                'nama' => $request->nama_lengkap,
                'username' => $request->nik,
                'password' => Hash::make($password),
                'role' => 'nasabah',
                'status' => 'aktif',
            ]);

            Nasabah::create([
                'user_id' => $user->id,
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Data nasabah berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function update(Request $request, Nasabah $nasabah)
    {
        $request->validate([
            'nik' => 'required|string|unique:nasabahs,nik,' . $nasabah->id,
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|unique:nasabahs,no_hp,' . $nasabah->id,
            'alamat' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $nasabah->update([
                'nik' => $request->nik,
                'nama_lengkap' => $request->nama_lengkap,
                'tanggal_lahir' => $request->tanggal_lahir,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            // Update juga data user terkait
            if ($nasabah->user) {
                $password = Carbon::parse($request->tanggal_lahir)->format('dmY');
                $nasabah->user->update([
                    'nama' => $request->nama_lengkap,
                    'username' => $request->nik,
                    'password' => Hash::make($password),
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Data nasabah berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }
}
