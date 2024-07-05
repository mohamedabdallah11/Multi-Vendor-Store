<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Rules\filter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.   
     */
    public function index(Request $request)
    {

        $categories = Category::leftJoin('categories as parent', 'parent.id', '=', 'categories.parent_id')
            ->select('categories.*', 'parent.name as parent_name')->filter($request->query())->paginate(10);
        //  $categories=Category::active()->paginate();
        //  $categories=Category::active('active')->paginate();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $category = new Category();
        $parentCategories = Category::all();
        return view('dashboard.categories.create', compact('category', 'parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*  if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', ['disk' => 'public']);
        }
        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'description' => $request->Description,
            'image' => $request->hasFile('image')? $path: null,    
            'slug' => Str::slug($request->name),
            'status' => $request->status ]);
        return redirect()->route('dashboard.categories.index')->with('sucsess', 'Category created successfully.');*/
        $request->validate(Category::rules(), [
            'name.required' => 'Category [:attribute ]is required',
        ]);

        $request->merge(
            ['slug' => Str::slug($request->post('name'))]
        );
        $data = $request->except('image');

        $data['image'] = $this->uploadImage($request);

        $Category = Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('sucsess', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $parentCategories = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })

            ->get();
        return view('dashboard.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $categoryRequest, string $id)
    {
        //  $request->validate(Category::rules($id)); now the category request is returned back and work without calling 

        $category = Category::findOrFail($id);
        $oldImage = $categoryRequest->image;
        $data = $categoryRequest->except('image');

        $newimage = $this->uploadImage($categoryRequest);
        if ($newimage) {
            $data['image'] = $newimage;
        }
        /* 
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'description' => $request->Description,
            'image' => $request->$path,
            'slug' => Str::slug($request->name),
            'status' => $request->status

        ]); */
        $category->update($data);
        if ($oldImage && $newimage) {
            Storage::disk('public')->delete($oldImage);
        }
        return redirect()->route('dashboard.categories.index')->with('sucsess', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //  Cary::destroy($id);
        $category = Category::findOrFail($id);
        $category->delete();
        /*   if ($category->image) {
            Storage::disk('public')->delete($category->image);
        } */ //softDelete
        return redirect()->route('dashboard.categories.index')->with('sucsess', 'Category deleted successfully and moved to trash.');
    }
    public function deleteAllCategories()
    {
        Category::truncate();
        Storage::disk('public')->deleteDirectory('uploads');
        return redirect()->route('dashboard.categories.index');
    }
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image'))
            return;

        $file = $request->file('image');
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;
    }
    public function trash(Request $request)
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trashed', compact('categories'));
    }
    public function restore(Request $request,$id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')->with('sucsess', 'Category restored successfully.');
    }
    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.trash')->with('sucsess', 'Category deleted successfully.');
    }
}
