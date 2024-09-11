<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHeroSectionRequest;
use App\Http\Requests\UpdateHeroSectionRequest;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroSections = HeroSection::orderBy('created_at', 'desc')->get();
        return view('admin.hero-section.index', compact('heroSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hero-section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHeroSectionRequest $request)
    {
        // Inisialisasi path banner
        $bannerPath = null;

        // Cek jika ada file banner yang di-upload
        if ($request->hasFile('banner')) {
            // Meng-upload file banner dengan nama acak
            $bannerFile = $request->file('banner');
            $bannerFileName = Str::random(40) . '.' . $bannerFile->getClientOriginalExtension();
            $bannerPath = $bannerFile->storeAs('hero_banners', $bannerFileName, 'public');
        }

        // Membuat instance baru dari model HeroSection
        $heroSection = new HeroSection();
        $heroSection->achievement = $request->achievement;
        $heroSection->subheading = $request->subheading;
        $heroSection->heading = $request->heading;
        $heroSection->path_video = $request->path_video;
        $heroSection->banner = $bannerPath;

        // Menyimpan data ke database
        $heroSection->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Hero Section berhasil dibuat!');
        return redirect()->route('admin.hero-sections.index');
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
        $heroSections = HeroSection::findOrFail($id);
        return view('admin.hero-section.edit', compact('heroSections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHeroSectionRequest $request, string $id)
    {
        // Mencari data HeroSection berdasarkan ID
        $heroSection = HeroSection::findOrFail($id);

        // Inisialisasi bannerPath
        $bannerPath = $heroSection->banner;

        // Cek jika ada file banner yang di-upload
        if ($request->hasFile('banner')) {
            // Menghapus banner lama jika ada
            if ($bannerPath && Storage::disk('public')->exists($bannerPath)) {
                Storage::disk('public')->delete($bannerPath);
            }

            // Meng-upload file banner baru dengan nama acak
            $bannerFile = $request->file('banner');
            $bannerFileName = Str::random(40) . '.' . $bannerFile->getClientOriginalExtension();
            $bannerPath = $bannerFile->storeAs('hero_banners', $bannerFileName, 'public');
        }

        // Mengupdate data HeroSection di database
        $heroSection->achievement = $request->achievement;
        $heroSection->subheading = $request->subheading;
        $heroSection->heading = $request->heading;
        $heroSection->path_video = $request->path_video;
        $heroSection->banner = $bannerPath;
        $heroSection->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Hero Section berhasil diperbarui!');
        return redirect()->route('admin.hero-sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mencari data HeroSection berdasarkan ID
            $heroSection = HeroSection::findOrFail($id);

            // Menghapus file banner jika ada
            if ($heroSection->banner && Storage::disk('public')->exists($heroSection->banner)) {
                Storage::disk('public')->delete($heroSection->banner);
            }

            // Menghapus data HeroSection dari database
            $heroSection->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'Hero Section berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus Hero Section!']);
        }
    }
}
