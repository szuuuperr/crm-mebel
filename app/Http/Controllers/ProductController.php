<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\WoodType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['kategori', 'jenisKayu', 'coverImage']);

        // Filter by visibilitas
        if ($request->filled('visibilitas')) {
            $query->where('visibilitas', $request->visibilitas);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter by wood type
        if ($request->filled('jenis_kayu')) {
            $query->where('jenis_kayu_id', $request->jenis_kayu);
        }

        // Filter by stock status
        if ($request->filled('stok_status')) {
            if ($request->stok_status === 'habis') {
                $query->where('stok', 0);
            } elseif ($request->stok_status === 'menipis') {
                $query->where('stok', '>', 0)->where('stok', '<=', 5);
            } elseif ($request->stok_status === 'aman') {
                $query->where('stok', '>', 5);
            }
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // Sort
        $sort = $request->input('sort', 'terbaru');
        if ($sort === 'harga_terendah') {
            $query->orderBy('harga', 'asc');
        } elseif ($sort === 'harga_tertinggi') {
            $query->orderBy('harga', 'desc');
        } elseif ($sort === 'stok_terendah') {
            $query->orderBy('stok', 'asc');
        } elseif ($sort === 'nama_az') {
            $query->orderBy('nama_produk', 'asc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(18)->withQueryString();

        $categories = Category::withCount('products')->get();
        $woodTypes = WoodType::withCount('products')->get();
        $totalSku = Product::count();
        $lowStock = Product::where('stok', '<=', 5)->where('stok', '>', 0)->count();
        $outOfStock = Product::where('stok', 0)->count();

        return view('pages.products', [
            'activePage' => 'products',
            'products' => $products,
            'categories' => $categories,
            'woodTypes' => $woodTypes,
            'totalSku' => $totalSku,
            'lowStock' => $lowStock,
            'outOfStock' => $outOfStock,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        $woodTypes = WoodType::all();

        return view('pages.products.create', [
            'activePage' => 'products',
            'categories' => $categories,
            'woodTypes' => $woodTypes,
        ]);
    }

    /**
     * Store — Create new product + upload images to Cloudinary
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'jenis_kayu_id' => 'required|exists:wood_types,id',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'berat' => 'nullable|numeric|min:0',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'tinggi' => 'nullable|numeric|min:0',
            'stok' => 'nullable|integer|min:0',
            'finishing' => 'nullable|string|max:255',
            'visibilitas' => 'nullable|in:aktif,draft',
            'is_unggulan' => 'nullable',
            'terima_kustom' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // Generate SKU
        $lastProduct = Product::withTrashed()->latest('id')->first();
        $nextNum = $lastProduct ? ($lastProduct->id + 1) : 1;
        $sku = $request->sku ?: ('PRD-'.str_pad($nextNum, 3, '0', STR_PAD_LEFT));

        $product = Product::create([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'jenis_kayu_id' => $request->jenis_kayu_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'berat' => $request->berat,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
            'stok' => $request->stok ?? 0,
            'sku' => $sku,
            'finishing' => $request->finishing,
            'visibilitas' => $request->visibilitas ?? 'draft',
            'is_unggulan' => $request->has('is_unggulan'),
            'terima_kustom' => $request->has('terima_kustom'),
            'status' => 'tersedia',
        ]);

        // Upload images to Cloudinary
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $image) {
                $url = CloudinaryStorage::upload(
                    $image->getRealPath(),
                    $image->getClientOriginalName()
                );

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $url,
                    'alt_text' => $product->nama_produk,
                    'urutan' => $i,
                    'is_cover' => $i === 0, // first image = cover
                ]);
            }
        }

        return redirect()
            ->route('products.show', $product->id)
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $product = Product::with(['kategori', 'jenisKayu', 'images'])->findOrFail($id);

        return view('pages.products.show', [
            'activePage' => 'products',
            'product' => $product,
        ]);
    }

    public function edit($id)
    {
        $product = Product::with(['kategori', 'jenisKayu', 'images'])->findOrFail($id);
        $categories = Category::all();
        $woodTypes = WoodType::all();

        return view('pages.products.edit', [
            'activePage' => 'products',
            'product' => $product,
            'categories' => $categories,
            'woodTypes' => $woodTypes,
        ]);
    }

    /**
     * Update — Update product data + handle new images upload to Cloudinary
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'jenis_kayu_id' => 'required|exists:wood_types,id',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'berat' => 'nullable|numeric|min:0',
            'panjang' => 'nullable|numeric|min:0',
            'lebar' => 'nullable|numeric|min:0',
            'tinggi' => 'nullable|numeric|min:0',
            'stok' => 'nullable|integer|min:0',
            'sku' => 'nullable|string|max:50',
            'finishing' => 'nullable|string|max:255',
            'visibilitas' => 'nullable|in:aktif,draft',
            'is_unggulan' => 'nullable',
            'terima_kustom' => 'nullable',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $product->update([
            'nama_produk' => $request->nama_produk,
            'kategori_id' => $request->kategori_id,
            'jenis_kayu_id' => $request->jenis_kayu_id,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'berat' => $request->berat,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
            'stok' => $request->stok ?? 0,
            'sku' => $request->sku ?: $product->sku,
            'finishing' => $request->finishing,
            'visibilitas' => $request->visibilitas ?? $product->visibilitas,
            'is_unggulan' => $request->has('is_unggulan'),
            'terima_kustom' => $request->has('terima_kustom'),
        ]);

        // Upload new images to Cloudinary
        if ($request->hasFile('images')) {
            $maxUrutan = $product->images()->max('urutan') ?? -1;

            foreach ($request->file('images') as $i => $image) {
                $url = CloudinaryStorage::upload(
                    $image->getRealPath(),
                    $image->getClientOriginalName()
                );

                $isCover = $product->images()->count() === 0 && $i === 0;

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $url,
                    'alt_text' => $product->nama_produk,
                    'urutan' => $maxUrutan + $i + 1,
                    'is_cover' => $isCover,
                ]);
            }
        }

        return redirect()
            ->route('products.show', $product->id)
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Destroy — Soft-delete product + delete all images from Cloudinary
     */
    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        // Delete all images from Cloudinary
        foreach ($product->images as $image) {
            try {
                CloudinaryStorage::delete($image->path);
            } catch (\Exception $e) {
                // Lanjut delete meskipun Cloudinary gagal
            }
            $image->delete();
        }

        $product->delete(); // soft-delete

        return redirect()
            ->route('products')
            ->with('success', 'Produk "'.$product->nama_produk.'" berhasil dihapus!');
    }

    /**
     * Destroy Image — Delete a single product image from Cloudinary
     */
    public function destroyImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        $productId = $image->product_id;
        $wasCover = $image->is_cover;

        // Delete from Cloudinary
        try {
            CloudinaryStorage::delete($image->path);
        } catch (\Exception $e) {
            // Lanjut delete meskipun Cloudinary gagal
        }

        $image->delete();

        // If deleted image was cover, set next image as cover
        if ($wasCover) {
            $nextImage = ProductImage::where('product_id', $productId)
                ->orderBy('urutan')
                ->first();
            if ($nextImage) {
                $nextImage->update(['is_cover' => true]);
            }
        }

        return redirect()
            ->route('products.edit', $productId)
            ->with('success', 'Gambar berhasil dihapus!');
    }
}
