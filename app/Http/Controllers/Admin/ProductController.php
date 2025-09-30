<?php

namespace App\Http\Controllers\Admin; // Namespace yang sesuai dengan struktur folder Anda

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Jenis; // Hanya Jenis yang diimpor
use Illuminate\Http\Request; // Impor Request
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth; // Untuk mengambil ID user yang sedang login

class ProductController extends Controller // Nama kelas ProductController
{
    public function index(Request $request) // <--- TAMBAHKAN Request $request DI SINI
    {
        $query = Product::with('jenis', 'user'); // Load relasi jenis dan user

        // Logika untuk fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('sku', 'like', '%' . $request->search . '%'); // Opsional: cari juga berdasarkan SKU
        }

        // Logika untuk Filter Status
        if ($request->has('status') && ($request->status === '0' || $request->status === '1')) {
            $query->where('status', (bool) $request->status);
        }

        // Logika untuk Filter Jenis (jika Anda mengaktifkan ini di view)
        if ($request->has('jenis_id') && $request->jenis_id != '') {
            $query->where('jenis_id', $request->jenis_id);
        }


        // <--- UBAH BAGIAN INI: Gunakan paginate() alih-alih get()
        $products = $query->paginate(10); // Menampilkan 10 produk per halaman

        // Ambil data jenis untuk dropdown filter di view (jika Anda mengaktifkan filter jenis)
        $jenis = Jenis::all(); // <--- TAMBAHKAN INI UNTUK MENGIRIM DATA JENIS KE VIEW

        // <--- KIRIM JUGA $jenis KE VIEW JIKA ANDA MENGGUNAKAN FILTER JENIS
        return view('admin.products.index', compact('products', 'jenis'));
    }

    public function create()
    {
        $jenis = Jenis::all(); // Ambil semua jenis
        return view('admin.products.create', compact('jenis'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'jenis_id' => 'required|exists:jenis,id',
            'title' => 'required|string|max:255',
            'meta_desc' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048', // Sesuaikan jika ada upload file
            'status' => 'nullable|boolean',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Menyimpan langsung ke disk 'public' di folder 'articles'
            $imagePath = $request->file('image')->store('product', 'public');
        }

        Product::create([
            'user_id' => Auth::id(), // ID user yang login
            'jenis_id' => $request->jenis_id,
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->boolean('status'),
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'sku' => $request->sku ?? strtoupper(Str::random(5)),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $jenis = Jenis::all();
        return view('admin.products.edit', compact('product', 'jenis'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'jenis_id' => 'required|exists:jenis,id',
            'title' => 'required|string|max:255',
            'meta_desc' => 'nullable|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048', // Sesuaikan jika ada upload file
            'status' => 'nullable|boolean',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:255|unique:products,sku',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product', 'public');
            $product->image = $imagePath;
        }


        $product->update([
            'user_id' => Auth::id(), // ID user yang login
            'jenis_id' => $request->jenis_id,
            'title' => $request->title,
            'meta_desc' => $request->meta_desc,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->boolean('status'),
            'price' => $request->price,
            'discount' => $request->discount,
            'stock' => $request->stock,
            'sku' => $request->sku ?? strtoupper(Str::random(5)),
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
