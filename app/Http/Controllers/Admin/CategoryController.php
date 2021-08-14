<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;

class CategoryController extends Controller
{
    private $paginate_categories = 10;

    public function index(Request $request)
    {
        if ($request->search) {
            $categories = $this->getSearch($request);
        } else {
            $categories = $this->getCategories();
        }

        return $categories;
    } //end of index


    public function getCategories()
    {
        return Category::withCount('posts')
            ->latest()->paginate($this->paginate_categories);
    } //end of getCategories


    public function getSearch($request)
    {
        return Category::withCount('posts')
            ->where('name', 'like', '%' . $request->search . '%')
            ->latest()->paginate($this->paginate_categories)->toArray();
    } //end of getSearch


    public function store(StoreCategoryRequest $request)
    {
        $request->validated();
        Category::create($request->all());
    } //end of store


    public function edit(Category $category)
    {
        return $category;
    } // end of edit


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => [
                'required', 'string', 'max:255',
                Rule::unique('categories')->ignore($category->id)
            ]
        ]);

        $category->update($request->all());
    } //end of update


    public function destroy(Category $category)
    {
        $category->delete();
    } //end of destroy
}
