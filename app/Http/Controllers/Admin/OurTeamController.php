<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class OurTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = OurTeam::orderByDesc('id')->paginate(10);
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        // Inisialisasi avatarPath
        $avatarPath = null;

        // Cek jika ada file avatar yang di-upload
        if ($request->hasFile('avatar')) {
            // Meng-upload file avatar dengan nama acak
            $avatarFile = $request->file('avatar');
            $avatarFileName = Str::random(40) . '.' . $avatarFile->getClientOriginalExtension();
            $avatarPath = $avatarFile->storeAs('teams', $avatarFileName, 'public');
        }

        // Menyimpan data ke database
        $team = new OurTeam();
        $team->name = $request->name;
        $team->occupation = $request->occupation;
        $team->location = $request->location;
        $team->avatar = $avatarPath;
        $team->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Dibuat');
        return redirect()->route('admin.teams.index');
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
        $team = OurTeam::findOrFail($id);
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, string $id)
    {
        // Mencari data OurTeam berdasarkan ID
        $team = OurTeam::findOrFail($id);

        // Inisialisasi avatarPath
        $avatarPath = $team->avatar;

        // Cek jika ada file avatar yang di-upload
        if ($request->hasFile('avatar')) {
            // Menghapus avatar lama jika ada
            if ($avatarPath && Storage::disk('public')->exists($avatarPath)) {
                Storage::disk('public')->delete($avatarPath);
            }

            // Meng-upload file avatar baru dengan nama acak
            $avatarFile = $request->file('avatar');
            $avatarFileName = Str::random(40) . '.' . $avatarFile->getClientOriginalExtension();
            $avatarPath = $avatarFile->storeAs('teams', $avatarFileName, 'public');
        }

        // Mengupdate data tim di database
        $team->name = $request->name;
        $team->occupation = $request->occupation;
        $team->location = $request->location;
        $team->avatar = $avatarPath;
        $team->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Diperbarui');
        return redirect()->route('admin.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mencari data OurTeam berdasarkan ID
            $team = OurTeam::findOrFail($id);

            // Menghapus file avatar jika ada
            if ($team->avatar && Storage::disk('public')->exists($team->avatar)) {
                Storage::disk('public')->delete($team->avatar);
            }

            // Menghapus data OurTeam dari database
            $team->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'Team berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus team!']);
        }
    }
}
