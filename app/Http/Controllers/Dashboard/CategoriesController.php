<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $categories->first();
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
    public function show(string $id)
    {
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
    public function update(Request $request, string $id)
    {

        $category = Category::findOrFail($id);
        $oldImage = $category->image;
        $data = $request->except('image');

        $data['image'] = $this->upleadImage($request);

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
        if ($oldImage && isset($data['image'])) {
            Storage::disk('public')->delete($oldImage);
        }
        return redirect()->route('dashboard.categories.index')->with('sucsess', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //  Category::destroy($id);
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('dashboard.categories.index')->with('sucsess', 'Category deleted successfully.');
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
}
