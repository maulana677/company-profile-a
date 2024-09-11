<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\ProjectClient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = ProjectClient::orderByDesc('id')->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        // Inisialisasi variabel untuk path file
        $avatarPath = null;
        $logoPath = null;

        // Mengupload avatar jika ada file yang diunggah
        if ($request->hasFile('avatar')) {
            $avatarFile = $request->file('avatar');
            $avatarFileName = Str::random(40) . '.' . $avatarFile->getClientOriginalExtension();
            $avatarPath = $avatarFile->storeAs('avatars', $avatarFileName, 'public');
        }

        // Mengupload logo jika ada file yang diunggah
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoFileName = Str::random(40) . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('logos', $logoFileName, 'public');
        }

        // Menyimpan data ke database
        $client = new ProjectClient();
        $client->name = $request->name;
        $client->occupation = $request->occupation;
        $client->avatar = $avatarPath;  // Jika tidak ada file, ini akan menjadi null
        $client->logo = $logoPath;      // Jika tidak ada file, ini akan menjadi null
        $client->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Dibuat');
        return redirect()->route('admin.clients.index');
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
        $client = ProjectClient::findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, string $id)
    {
        // Mengambil data client berdasarkan ID
        $client = ProjectClient::findOrFail($id);

        // Menghapus file avatar lama jika ada dan meng-upload avatar baru
        if ($request->hasFile('avatar')) {
            // Menghapus file avatar lama jika ada
            if ($client->avatar && Storage::disk('public')->exists($client->avatar)) {
                Storage::disk('public')->delete($client->avatar);
            }

            // Meng-upload file avatar baru dengan nama acak
            $avatarFile = $request->file('avatar');
            $avatarFileName = Str::random(40) . '.' . $avatarFile->getClientOriginalExtension();
            $avatarPath = $avatarFile->storeAs('avatars', $avatarFileName, 'public');
            $client->avatar = $avatarPath;
        }

        // Menghapus file logo lama jika ada dan meng-upload logo baru
        if ($request->hasFile('logo')) {
            // Menghapus file logo lama jika ada
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }

            // Meng-upload file logo baru dengan nama acak
            $logoFile = $request->file('logo');
            $logoFileName = Str::random(40) . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('logos', $logoFileName, 'public');
            $client->logo = $logoPath;
        }

        // Memperbarui data lainnya
        $client->name = $request->name;
        $client->occupation = $request->occupation;
        $client->save();

        toastr()->success('Data Berhasil Diperbarui');
        return redirect()->route('admin.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mencari data ProjectClient berdasarkan ID
            $client = ProjectClient::findOrFail($id);

            // Menghapus file avatar jika ada
            if ($client->avatar && Storage::disk('public')->exists($client->avatar)) {
                Storage::disk('public')->delete($client->avatar);
            }

            // Menghapus file logo jika ada
            if ($client->logo && Storage::disk('public')->exists($client->logo)) {
                Storage::disk('public')->delete($client->logo);
            }

            // Menghapus data ProjectClient dari database
            $client->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'Project Client berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus Project Client!']);
        }
    }
}
