<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFaqQuestionRequest;
use App\Models\FaqQuestion;
use Illuminate\Http\Request;

class FaqQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqQuestion = FaqQuestion::all();
        return view('admin.faq-question.index', compact('faqQuestion'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq-question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqQuestionRequest $request)
    {
        $faqQuestion = new FaqQuestion();
        $faqQuestion->question = $request->question;
        $faqQuestion->answer = $request->answer;
        $faqQuestion->save();

        toastr()->success('Pertanyaan FAQ berhasil dibuat');
        return redirect()->route('admin.faq-question.index');
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
        $faqQuestion = FaqQuestion::findOrFail($id);
        return view('admin.faq-question.edit', compact('faqQuestion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFaqQuestionRequest $request, string $id)
    {
        $faqQuestion = FaqQuestion::findOrFail($id);

        // Memperbarui data FAQ Question
        $faqQuestion->question = $request->question;
        $faqQuestion->answer = $request->answer;
        $faqQuestion->save();

        // Mengarahkan kembali dengan pesan sukses
        toastr()->success('Pertanyaan FAQ berhasil diperbarui');
        return redirect()->route('admin.faq-question.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $faqQuestion = FaqQuestion::findOrFail($id);
            $faqQuestion->delete();

            // Mengembalikan respon sukses
            return response(['status' => 'success', 'message' => 'FAQ Question berhasil dihapus!']);
        } catch (\Throwable $th) {
            // Menangani kesalahan dan mengembalikan respon error
            return response(['status' => 'error', 'message' => 'Terjadi kesalahan saat menghapus FAQ Question!']);
        }
    }
}
