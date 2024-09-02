<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStatisticRequest;
use App\Http\Requests\UpdateStatisticRequest;
use App\Models\CompanyStatistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompanyStatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statistics = CompanyStatistic::orderByDesc('id')->paginate(10);
        return view('admin.statistics.index', compact('statistics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.statistics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatisticRequest $request)
    {
        // Inisialisasi variabel untuk path file
        $iconPath = null;

        // Mengupload icon jika ada file yang diunggah
        if ($request->hasFile('icon')) {
            $iconFile = $request->file('icon');
            $iconFileName = Str::random(40) . '.' . $iconFile->getClientOriginalExtension();
            $iconPath = $iconFile->storeAs('icons', $iconFileName, 'public');
        }

        // Menyimpan data ke database
        $statistic = new CompanyStatistic();
        $statistic->name = $request->name;
        $statistic->goal = $request->goal;
        $statistic->icon = $iconPath;  // Jika tidak ada file, ini akan menjadi null
        $statistic->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Dibuat');
        return redirect()->route('admin.statistics.index');
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
        $statistic = CompanyStatistic::findOrFail($id);
        return view('admin.statistics.edit', compact('statistic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStatisticRequest $request, string $id)
    {
        // Mengambil data statistic berdasarkan ID
        $statistic = CompanyStatistic::findOrFail($id);

        if ($request->hasFile('icon')) {
            // Menghapus file icon lama jika ada
            if ($statistic->icon && Storage::disk('public')->exists($statistic->icon)) {
                Storage::disk('public')->delete($statistic->icon);
            }

            // Upload file icon baru dengan nama acak
            $file = $request->file('icon');
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $iconPath = $file->storeAs('icons', $fileName, 'public');
            $statistic->icon = $iconPath;
        }

        // Update data lainnya
        $statistic->name = $request->name;
        $statistic->goal = $request->goal;
        $statistic->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Diperbarui');
        return redirect()->route('admin.statistics.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mencari data Statistic berdasarkan ID
            $statistic = CompanyStatistic::findOrFail($id);

            // Menghapus file icon jika ada
            if ($statistic->icon && Storage::disk('public')->exists($statistic->icon)) {
                Storage::disk('public')->delete($statistic->icon);
            }

            // Menghapus data Statistic dari database
            $statistic->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi sesuatu!']);
        }
    }
}
