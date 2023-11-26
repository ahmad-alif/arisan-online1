<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = '';
        return view('category.index', ['active' => 'data-category', 'categories' => $categories , 'search' => $search]);
    }

    public function search(Request $request)
    {
        $search = $request->query('search');

        $categories = Category::when($search, function ($query) use ($search) {
            return $query->where('nama_kategori', 'like', "%$search%");
        })->paginate(10);

        return view('category.index', ['active' => 'data-category'], compact('categories', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.add-category', ['active' => 'add-category']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari formulir
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
            'slug' => 'required',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        // Simpan data ke dalam database
        Category::create($validatedData);

        // Redirect kembali ke halaman data-category atau sesuai kebutuhan
        return redirect('/data-category')->with('success', 'Kategori telah ditambahkan.');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);

        return view('category.edit-category', ['active' => 'edit-category', 'category' => $category]);
    }

    public function processEditCategory(Request $request, $id)
    {
        // Validasi input dari formulir
        $validatedData = $request->validate([
            'nama_kategori' => 'required',
            'slug' => 'required',
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        // Temukan kategori yang akan diedit
        $category = Category::find($id);

        if (!$category) {
            return redirect('/data-category')->with('error', 'Kategori tidak ditemukan.');
        }

        // Update data kategori
        $category->update($validatedData);

        return redirect('/data-category')->with('success', 'Kategori telah diperbarui.');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return redirect('/data-category')->with('success', 'Kategori telah dihapus.');
        }

        return redirect('/data-category')->with('error', 'Kategori tidak ditemukan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
