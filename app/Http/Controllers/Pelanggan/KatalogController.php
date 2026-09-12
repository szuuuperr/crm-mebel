<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\WoodType;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['kategori', 'jenisKayu', 'coverImage'])
            ->where('visibilitas', 'aktif');

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter by wood type
        if ($request->filled('jenis_kayu')) {
            $query->where('jenis_kayu_id', $request->jenis_kayu);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Sort
        $sort = $request->input('sort', 'terbaru');
        if ($sort === 'harga_terendah') {
            $query->orderBy('harga', 'asc');
        } elseif ($sort === 'harga_tertinggi') {
            $query->orderBy('harga', 'desc');
        } elseif ($sort === 'nama_az') {
            $query->orderBy('nama_produk', 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(18)->withQueryString();

        $categories = Category::withCount(['products' => function ($q) {
            $q->where('visibilitas', 'aktif');
        }])->get();

        $woodTypes = WoodType::withCount(['products' => function ($q) {
            $q->where('visibilitas', 'aktif');
        }])->get();

        return view('pelanggan.katalog.index', [
            'activePage' => 'katalog',
            'products' => $products,
            'categories' => $categories,
            'woodTypes' => $woodTypes,
        ]);
    }

    public function show($id)
    {
        $product = Product::with(['kategori', 'jenisKayu', 'images'])
            ->where('visibilitas', 'aktif')
            ->findOrFail($id);

        return view('pelanggan.katalog.show', [
            'activePage' => 'katalog',
            'product' => $product,
        ]);
    }
}
