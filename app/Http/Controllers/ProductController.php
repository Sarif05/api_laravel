<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showAll(Request $request)
    {
        $collection = $request->query('collections');

        if (!$collection) {
            return response()->json(['message' => 'Collection parameter is missing'], 400);
        }

        $products = Product::where('collections', $collection)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Data not found for collection: ' . $collection], 404);
        }

        return response()->json($products, 200);
    }

    public function filterByAdvance(Request $request)
    {
        $query = Product::query();

        // Filter berdasarkan nama produk
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        // Filter berdasarkan harga minimum
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        // Filter berdasarkan harga maksimum
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        // Filter berdasarkan kategori
        if ($request->has('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Pengurutan data
        if ($request->has('sort_by')) {
            $sortField = $request->input('sort_by');
            $sortDirection = $request->input('sort_dir', 'asc'); // Default ke ascending
            $query->orderBy($sortField, $sortDirection);
        }

        // Paginasi
        $perPage = $request->input('per_page', 10); // Jumlah item per halaman
        $products = $query->paginate($perPage);

        return response()->json($products);
    }
}
