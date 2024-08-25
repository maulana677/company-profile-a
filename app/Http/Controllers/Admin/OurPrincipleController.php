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
        $principles = OurPrinciple::orderByDesc('id')->paginate(10);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
