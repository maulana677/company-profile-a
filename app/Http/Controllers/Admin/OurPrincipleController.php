<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePrincipleRequest;
use App\Models\OurPrinciple;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OurPrincipleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $principles = OurPrinciple::orderBy('created_at', 'desc')->get();
        return view('admin.principles.index', compact('principles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.principles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePrincipleRequest $request)
    {
        // Inisialisasi variabel untuk path file
        $thumbnailPath = null;
        $iconPath = null;

        // Mengupload thumbnail jika ada file yang diunggah
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailFileName = Str::random(40) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs('thumbnails', $thumbnailFileName, 'public');
        }

        // Mengupload icon jika ada file yang diunggah
        if ($request->hasFile('icon')) {
            $iconFile = $request->file('icon');
            $iconFileName = Str::random(40) . '.' . $iconFile->getClientOriginalExtension();
            $iconPath = $iconFile->storeAs('icons', $iconFileName, 'public');
        }

        // Menyimpan data ke database
        $principle = new OurPrinciple();
        $principle->name = $request->name;
        $principle->thumbnail = $thumbnailPath;  // Jika tidak ada file, ini akan menjadi null
        $principle->icon = $iconPath;            // Jika tidak ada file, ini akan menjadi null
        $principle->subtitle = $request->subtitle;
        $principle->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Dibuat');
        return redirect()->route('admin.principles.index');
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
        $principle = OurPrinciple::findOrFail($id);
        return view('admin.principles.edit', compact('principle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Mencari data OurPrinciple berdasarkan ID
        $principle = OurPrinciple::findOrFail($id);

        // Inisialisasi variabel untuk path file
        $thumbnailPath = $principle->thumbnail;  // Mengambil thumbnail lama
        $iconPath = $principle->icon;            // Mengambil icon lama

        // Cek jika ada file thumbnail yang di-upload
        if ($request->hasFile('thumbnail')) {
            // Menghapus thumbnail lama jika ada
            if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }

            // Meng-upload file thumbnail baru dengan nama acak
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailFileName = Str::random(40) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs('thumbnails', $thumbnailFileName, 'public');
        }

        // Cek jika ada file icon yang di-upload
        if ($request->hasFile('icon')) {
            // Menghapus icon lama jika ada
            if ($iconPath && Storage::disk('public')->exists($iconPath)) {
                Storage::disk('public')->delete($iconPath);
            }

            // Meng-upload file icon baru dengan nama acak
            $iconFile = $request->file('icon');
            $iconFileName = Str::random(40) . '.' . $iconFile->getClientOriginalExtension();
            $iconPath = $iconFile->storeAs('icons', $iconFileName, 'public');
        }

        // Mengupdate data principle di database
        $principle->name = $request->name;
        $principle->thumbnail = $thumbnailPath;  // Jika ada file baru, simpan path baru
        $principle->icon = $iconPath;            // Jika ada file baru, simpan path baru
        $principle->subtitle = $request->subtitle;
        $principle->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Diperbarui');
        return redirect()->route('admin.principles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mencari data OurPrinciple berdasarkan ID
            $principle = OurPrinciple::findOrFail($id);

            // Menghapus file thumbnail jika ada
            if ($principle->thumbnail && Storage::disk('public')->exists($principle->thumbnail)) {
                Storage::disk('public')->delete($principle->thumbnail);
            }

            // Menghapus file icon jika ada
            if ($principle->icon && Storage::disk('public')->exists($principle->icon)) {
                Storage::disk('public')->delete($principle->icon);
            }

            // Menghapus data OurPrinciple dari database
            $principle->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'Our Principle berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus Our Principle!']);
        }
    }
}
