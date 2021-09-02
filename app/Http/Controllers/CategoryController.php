<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->paginate(5);

        return view('category.index')->with(compact('categories'));
    }

    public function create(Request $request)
    {
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        
        return redirect()->back();
    }

    public function delete($id)
    {
        return $this->category->findOrFail($id)->delete();
    }
}
