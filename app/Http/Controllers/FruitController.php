<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use App\Models\Banner;
use App\Models\Category;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    public function index(Request $request)
    {
        $query = Fruit::query();
    
        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }
    
        $fruits = $query->get();
        $categories = Category::all();
        $banners = Banner::all(); // Thêm dòng này để lấy tất cả banner
    
        return view('fruits.index', compact('fruits', 'categories', 'banners'));
    }

    public function show(Fruit $fruit)
    {
        return view('fruits.show', compact('fruit'));
    }

    public function create()
    {
        {
            $categories = Category::all(); // Lấy danh sách danh mục
            return view('fruits.create', compact('categories'));
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fruits', 'public');
            $validated['image'] = $imagePath;
        }
    
        Fruit::create($validated);
    
        return redirect()->route('admin.index')->with('success', 'Thêm thành công');
    }

    public function edit(Fruit $fruit)
    {
        $categories = Category::all(); // Lấy danh sách danh mục
    return view('fruits.edit', compact('fruit', 'categories'));
    }

    public function update(Request $request, Fruit $fruit)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('fruits', 'public');
            $validated['image'] = $imagePath;
        }
    
        $fruit->update($validated);
    
        return redirect()->route('admin.index', $fruit)->with('success', 'Cập nhật thành công');
    }

    public function destroy(Fruit $fruit)
    {
        $fruit->delete();
        return redirect()->route('admin.index')->with('success', 'Xóa thành công');
    }
}