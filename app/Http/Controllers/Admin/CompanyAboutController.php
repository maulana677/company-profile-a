<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAboutRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Models\CompanyAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = CompanyAbout::orderByDesc('id')->paginate(10);
        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAboutRequest $request)
    {
        // Menginisialisasi path thumbnail
        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $thumbnailPath = $file->storeAs('thumbnails', $fileName, 'public');
        }

        // Membuat instance baru dari model CompanyAbout
        $about = new CompanyAbout();
        $about->name = $request->name;
        $about->type = $request->type;
        $about->thumbnail = $thumbnailPath;

        // Menyimpan data ke database
        $about->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Dibuat');
        return redirect()->route('admin.abouts.index');
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
        $about = CompanyAbout::findOrFail($id);

        // Menampilkan view edit dengan data yang ditemukan
        return view('admin.abouts.edit', compact('companyAbout'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, string $id)
    {
        // Mencari data berdasarkan ID
        $about = CompanyAbout::findOrFail($id);

        // Menginisialisasi path thumbnail jika file baru diunggah
        if ($request->hasFile('thumbnail')) {
            // Menghapus file thumbnail lama jika ada
            if ($about->thumbnail && Storage::disk('public')->exists($about->thumbnail)) {
                Storage::disk('public')->delete($about->thumbnail);
            }

            // Upload file thumbnail baru dengan nama acak
            $file = $request->file('thumbnail');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $thumbnailPath = $file->storeAs('thumbnails', $fileName, 'public');
            $about->thumbnail = $thumbnailPath;
        }

        // Mengupdate field lain pada model
        $about->name = $request->name;
        $about->type = $request->type;
        $about->save();

        // Mengirimkan pesan sukses menggunakan Toastr
        toastr()->success('Data Berhasil Diperbarui');
        return redirect()->route('admin.abouts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mencari data CompanyAbout berdasarkan ID
            $about = CompanyAbout::findOrFail($id);

            // Menghapus file thumbnail jika ada
            if ($about->thumbnail && Storage::disk('public')->exists($about->thumbnail)) {
                Storage::disk('public')->delete($about->thumbnail);
            }

            // Menghapus data CompanyAbout dari database
            $about->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi sesuatu!']);
        }
    }
}
