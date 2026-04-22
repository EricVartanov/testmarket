<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductIndexRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(ProductIndexRequest $request)
    {
        $perPage = $request->integer('per_page', 15);

        $query = Product::query()
            ->when($request->filled('q'), fn ($q) =>
                $q->where('name', 'like', "%{$request->q}%")
            )
            ->when($request->filled('category_id'), fn ($q) =>
                $q->whereCategoryId($request->category_id)
            )
            ->when($request->filled('price_from'), fn ($q) =>
                $q->where('price', '>=', $request->price_from)
            )
            ->when($request->filled('price_to'), fn ($q) =>
                $q->where('price', '<=', $request->price_to)
            )
            ->when($request->filled('in_stock'), fn ($q) =>
                $q->where('in_stock', $request->in_stock)
            )
            ->when($request->filled('rating_from'), fn ($q) =>
                $q->where('rating', '>=', $request->rating_from)
            );

            $this->applySorting($query, $request->input('sort'));

        return $query->paginate($perPage);
    }

    private function applySorting($query, ?string $sort): void
    {
        match ($sort) {
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating_desc' => $query->orderBy('rating', 'desc'),
            default => $query->orderBy('created_at', 'desc'),
        };
    }
}
