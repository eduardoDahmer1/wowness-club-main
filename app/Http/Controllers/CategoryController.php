<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategory;
use App\Http\Requests\UpdateCategory;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Category::class);

        return view('admin.categories.index', [
            'categories' => Category::filter($request->toArray())->orderByDesc('id')->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Category::class);

        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $this->authorize('create', Category::class);

        $data = $request->validated();

        if ($request->icon) {
            $data['icon'] = $request->file('icon')->store('images', 'public');
        }

        $category = Category::create($data);

        collect($data['subcategories'] ?? [])->each(function ($subcategory) use ($category) {
            if (!isset($subcategory['icon']) || empty($subcategory['name'] || $subcategory['icon'])) {
                return true;
            }

            $subcategory['icon'] = $subcategory['icon']->store('subcategories', 'public');
            $category->subcategories()->create($subcategory);
        });

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection return the related subcategories not updated or created
     */
    protected function syncSubcategories(Category $category, Collection $subcategories): EloquentCollection
    {
        $subcategoriesModels = new Collection();
        $subcategories->each(function ($subcategory) use ($category, &$subcategoriesModels) {
            if (empty($subcategory['name'])) {
                return true;
            }

            // Store a new icon if sended by request
            if (isset($subcategory['icon']) && !empty($subcategory['icon'])) {
                $subcategory['icon'] = $subcategory['icon']->store('subcategories', 'public');
            }

            // Update a subcategory if already exist
            if (!empty($subcategory['id'])) {
                $subcategoryModel = Subcategory::firstWhere('id', $subcategory['id']);
                $subcategoryModel->update($subcategory);
                $subcategoriesModels->push($subcategoryModel);
                return true;
            }

            // Create a subcategory
            $subcategoriesModels->push($category->subcategories()->create($subcategory));
        });

        return $category->subcategories()->whereNotIn('id',
            $subcategoriesModels->map(fn (Subcategory $item) => $item->id)->all()
        )->withCount('services')->get();
    }

    protected function deleteSubcategories(EloquentCollection $subcategories)
    {
        $this->authorize('delete', Subcategory::class);

        $subcategories->each(
            fn ($subcategory) => $subcategory->services_count > 0
                ? throw ValidationException::withMessages(["subcategories." . $subcategory->id . '.destroy' => __('Subcategory has services associated')])
                : $subcategory->delete()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategory $request, Category $category)
    {
        $this->authorize('update', $category);

        $data = $request->validated();

        if ($request->icon) {
            $data['icon'] = $request->file('icon')->store('images', 'public');
        }

        if ($request->icon && $category->icon) {
            Storage::disk('public')->delete($category->icon);
        }

        $subcategoriesToDelete = $this->syncSubcategories($category, collect($data['subcategories'] ?? []));

        $this->deleteSubcategories($subcategoriesToDelete);

        $category->update($data);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();

        if ($category->icon) {
            Storage::disk('public')->delete($category->icon);
        }

        return redirect()->route('categories.index');
    }
}
