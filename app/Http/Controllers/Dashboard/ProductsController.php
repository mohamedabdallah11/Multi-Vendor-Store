<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Category;
use illuminate\Support\Str;
class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products=Product::with(['category','store'])->paginate();
        return view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $product=Product::findOrFail($id); 
        $tags=implode(',',$product->tags()->pluck('name')->toArray()) ;
        return view('dashboard.products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Product $product)
    {
       // dd($request->all());
        $product->update($request->except('tags'));

        // Extract the tags from the request
        $tags = explode(',', $request->input('tags'));
    
        // Process and sync tags
        $tag_ids = [];
        foreach ($tags as $t_name) {
            $slug = Str::slug($t_name);
            $tag = Tag::where('slug', $slug)->first();
    
            if (!$tag) {
                $tag = Tag::create(['name' => $t_name, 'slug' => $slug]);
            }
    
            $tag_ids[] = $tag->id;  
        }
    
        // Sync the tags with the product
        $product->tags()->sync($tag_ids);
    
        return redirect()->route('dashboard.products.index')->with(['success' => 'Product updated successfully']);
    } 
   /*  public function update(Request $request, Product $product)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'compare_price' => 'nullable|numeric',
            'tags' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|in:active,draft,archived',
        ]);
    
        // Update product excluding the 'tags' field
        $product->update($request->except('tags', 'image'));
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $product->update([
                'image' => $request->file('image')->store('products', 'public'),
            ]);
        }
    
        // Handle tags
        $tag_ids = [];
        if ($request->filled('tags')) {
            $tags = explode(',', $request->input('tags'));
            foreach ($tags as $t_name) {
                $slug = Str::slug($t_name);
                $tag = Tag::firstOrCreate(['slug' => $slug], ['name' => $t_name]);
                $tag_ids[] = $tag->id;
            }
        }
        $product->tags()->sync($tag_ids);
    
        return redirect()->route('dashboard.products.index')->with(['success' => 'Product updated successfully']);
    } */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
