<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqSectionSetting;
use Illuminate\Http\Request;

class FaqSectionSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqSection = FaqSectionSetting::first();
        return view('admin.faq-sections.index', compact('faqSection'));
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'btn_text' => 'required|string|max:255',
        ]);

        FaqSectionSetting::updateOrCreate(
            ['id' => $id],
            [
                'title' => $request->title,
                'btn_text' => $request->btn_text,
            ]
        );

        toastr()->success('FAQ Section berhasil diperbarui!');
        return redirect()->route('admin.faq-section-setting.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
