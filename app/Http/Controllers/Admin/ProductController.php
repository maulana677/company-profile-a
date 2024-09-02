<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderByDesc('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.products.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // Inisialisasi thumbnailPath
        $thumbnailPath = null;

        // Cek jika ada file thumbnail yang di-upload
        if ($request->hasFile('thumbnail')) {
            // Meng-upload file thumbnail dengan nama acak
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailFileName = Str::random(40) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs('products', $thumbnailFileName, 'public');
        }

        // Menyimpan data ke database
        $product = new Product();
        $product->name = $request->name;
        $product->about = $request->about;
        $product->tagline = $request->tagline;
        $product->thumbnail = $thumbnailPath;
        $product->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Dibuat');
        return redirect()->route('admin.products.index');
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
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        // Mencari data produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Inisialisasi thumbnailPath
        $thumbnailPath = $product->thumbnail;

        // Cek jika ada file thumbnail yang di-upload
        if ($request->hasFile('thumbnail')) {
            // Hapus file thumbnail lama jika ada
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            // Meng-upload file thumbnail baru dengan nama acak
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailFileName = Str::random(40) . '.' . $thumbnailFile->getClientOriginalExtension();
            $thumbnailPath = $thumbnailFile->storeAs('products', $thumbnailFileName, 'public');
        }

        // Update data produk
        $product->name = $request->name;
        $product->about = $request->about;
        $product->tagline = $request->tagline;
        $product->thumbnail = $thumbnailPath;
        $product->save();

        // Redirect ke halaman index dengan pesan sukses
        toastr()->success('Data Berhasil Diperbarui');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Mencari data Product berdasarkan ID
            $product = Product::findOrFail($id);

            // Menghapus file thumbnail jika ada
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            // Menghapus data Product dari database
            $product->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'Product berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus product!']);
        }
    }
}
