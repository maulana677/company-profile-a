<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateFooterInfoRequest;
use App\Models\FooterInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FooterInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footerInfo = FooterInfo::first();
        return view('admin.footer-info.index', compact('footerInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFooterInfoRequest $request, string $id)
    {
        // Mencari data FooterInfo berdasarkan ID
        $footerInfo = FooterInfo::findOrFail($id);

        // Menghapus file logo lama jika ada
        if ($request->hasFile('logo')) {
            if ($footerInfo->logo && Storage::disk('public')->exists($footerInfo->logo)) {
                Storage::disk('public')->delete($footerInfo->logo);
            }

            // Meng-upload file logo baru dengan nama acak
            $logoFile = $request->file('logo');
            $logoFileName = Str::random(40) . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('footer_info', $logoFileName, 'public');
            $footerInfo->logo = $logoPath;
        }

        // Menyimpan data lainnya
        $footerInfo->description = $request->description;
        $footerInfo->copyright = $request->copyright;

        // Simpan perubahan ke database
        $footerInfo->save();

        toastr()->success('Data Berhasil Diperbarui');
        return redirect()->route('admin.footer-info.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
