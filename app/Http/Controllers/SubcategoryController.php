<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubcategory;
use App\Http\Requests\UpdateSubcategory;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.subcategories.index', [
            'subcategories' => Subcategory::with('category')->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategories.create', [
            'categories' => Category::orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubcategory $request)
    {
        $data = $request->validated();

        if ($request->icon) {
            $data['icon'] = $request->file('icon')->store('images', 'public');
        }

        Subcategory::create($data);

        return redirect()->route('subcategories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        return view('admin.subcategories.edit', [
            'categories' => Category::orderBy('name')->get(),
            'subcategory' => $subcategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubcategory $request, Subcategory $subcategory)
    {
        $data = $request->validated();

        if ($request->icon) {
            $data['icon'] = $request->file('icon')->store('images', 'public');
        }

        if ($request->icon && $subcategory->icon) {
            Storage::disk('public')->delete($subcategory->icon);
        }

        $subcategory->update($data);

        return redirect()->route('subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();

        if ($subcategory->icon) {
            Storage::disk('public')->delete($subcategory->icon);
        }

        return redirect()->route('subcategories.index');
    }
}
