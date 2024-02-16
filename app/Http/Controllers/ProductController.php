<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();

        if($search = $request->search)
        {
            $products->where('nom','like', '%'.$search.'%')
                    ->orWhere('description','like', '%'.$search.'%');
        }

        return view('products.index', ['products' => $products->latest()->paginate(3),]);

    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
        ]);

        Product::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect(route('product.index'))->with('status', 'produit ajouté avec succès');
    }

    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('picture'))
        {
            $picture = $request->file('picture')->store('pictures');

            $picture = Storage::disk('public')->put('pictures', $request->file('picture'));
        }

        $product->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'picture' => $picture ??= null,
        ]);

        return redirect(route('product.index'))->with('status','le produit à été mis à jour');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect(route('product.index'))->with('status', 'Produit supprime');
    }
}
