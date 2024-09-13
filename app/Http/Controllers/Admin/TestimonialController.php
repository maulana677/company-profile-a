<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Models\ProjectClient;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderByDesc('id')->paginate(10);
        $projectClients = ProjectClient::all();
        return view('admin.testimonials.index', compact('testimonials', 'projectClients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = ProjectClient::all();
        return view('admin.testimonials.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request)
    {
        // Inisialisasi thumbnailPath
        $thumbnailPath = null;

        // Cek jika ada file thumbnail yang di-upload
        if ($request->hasFile('thumbnail')) {
            // Meng-upload file thumbnail dengan nama acak
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailFileName = Str::random(40) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs('testimonials', $thumbnailFileName, 'public');
        }

        // Menyimpan data ke database
        $testimonial = new Testimonial();
        $testimonial->message = $request->message;
        $testimonial->project_client_id = $request->project_client_id;
        $testimonial->thumbnail = $thumbnailPath;
        $testimonial->save();

        toastr()->success('Data Berhasil Dibuat');
        return redirect()->route('admin.testimonials.index');
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
        $testimonial = Testimonial::findOrFail($id);
        $projectClients = ProjectClient::all();
        return view('admin.testimonials.edit', compact('testimonial', 'projectClients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, string $id)
    {
        // Mencari data Testimonial berdasarkan ID
        $testimonial = Testimonial::findOrFail($id);

        // Inisialisasi path thumbnail
        $thumbnailPath = $testimonial->thumbnail;

        // Cek jika ada file thumbnail yang di-upload
        if ($request->hasFile('thumbnail')) {
            // Menghapus file thumbnail lama jika ada
            if ($testimonial->thumbnail && Storage::disk('public')->exists($testimonial->thumbnail)) {
                Storage::disk('public')->delete($testimonial->thumbnail);
            }

            // Meng-upload file thumbnail baru dengan nama acak
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailFileName = Str::random(40) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs('testimonials', $thumbnailFileName, 'public');
        }

        // Memperbarui data Testimonial
        $testimonial->project_client_id = $request->project_client_id;
        $testimonial->message = $request->message;
        $testimonial->thumbnail = $thumbnailPath;
        $testimonial->save();

        // Menampilkan pesan sukses
        toastr()->success('Data Berhasil Diperbarui');
        return redirect()->route('admin.testimonials.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mencari data Testimonial berdasarkan ID
            $testimonial = Testimonial::findOrFail($id);

            // Menghapus file thumbnail jika ada
            if ($testimonial->thumbnail && Storage::disk('public')->exists($testimonial->thumbnail)) {
                Storage::disk('public')->delete($testimonial->thumbnail);
            }

            // Menghapus data Testimonial dari database
            $testimonial->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'Testimonial berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus testimonial!']);
        }
    }
}
