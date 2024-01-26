<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Page;
use App\Product;
use App\Vendor;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index() {
        $products = Product::all()->first();
        $categories = Category::all()->first();
        return response()->view('sitemap.index', [
            'product' => $products,
            'category' => $categories
        ])->header('Content-Type', 'text/xml');
    }

    public function products() {
        $product = Product::latest()->get();
        return response()->view('sitemap.product', [
            'products' => $product,
        ])->header('Content-Type', 'text/xml');
    }

    public function categories() {
        $category = Category::latest()->get();
        return response()->view('sitemap.category', [
            'categories' => $category,
        ])->header('Content-Type', 'text/xml');
    }

    public function brands() {
        $brand = Brand::latest()->get();
        return response()->view('sitemap.brand', [
            'brands' => $brand,
        ])->header('Content-Type', 'text/xml');
    }

    public function vendors() {
        $vendor = Vendor::latest()->get();
        return response()->view('sitemap.vendor', [
            'vendors' => $vendor,
        ])->header('Content-Type', 'text/xml');
    }

    public function pages() {
        $page = Page::latest()->get();
        return response()->view('sitemap.page', [
            'pages' => $page,
        ])->header('Content-Type', 'text/xml');
    }
}
