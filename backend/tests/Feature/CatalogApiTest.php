<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_index_returns_active_roots_with_active_sorted_children(): void
    {
        $root = Category::create([
            'category_name' => 'Phụ kiện',
            'slug' => 'phu-kien',
            'status' => true,
            'sort_order' => 2,
        ]);
        Category::create([
            'category_name' => 'Tai nghe',
            'slug' => 'tai-nghe',
            'parent_id' => $root->category_id,
            'status' => true,
            'sort_order' => 2,
        ]);
        Category::create([
            'category_name' => 'Cáp sạc',
            'slug' => 'cap-sac',
            'parent_id' => $root->category_id,
            'status' => true,
            'sort_order' => 1,
        ]);
        Category::create([
            'category_name' => 'Ẩn',
            'slug' => 'an',
            'parent_id' => $root->category_id,
            'status' => false,
        ]);
        Category::create([
            'category_name' => 'Danh mục ẩn',
            'slug' => 'danh-muc-an',
            'status' => false,
        ]);

        $this->getJson('/api/categories')
            ->assertOk()
            ->assertJsonPath('data.0.id', $root->category_id)
            ->assertJsonPath('data.0.name', 'Phụ kiện')
            ->assertJsonPath('data.0.children.0.name', 'Cáp sạc')
            ->assertJsonPath('data.0.children.1.name', 'Tai nghe')
            ->assertJsonCount(2, 'data.0.children')
            ->assertJsonCount(1, 'data');
    }

    public function test_category_detail_uses_slug_and_returns_404_when_missing(): void
    {
        Category::create([
            'category_name' => 'Điện thoại',
            'slug' => 'dien-thoai',
            'status' => true,
        ]);

        $this->getJson('/api/categories/dien-thoai')
            ->assertOk()
            ->assertJsonPath('data.slug', 'dien-thoai');

        $this->getJson('/api/categories/khong-ton-tai')->assertNotFound();
    }

    public function test_brands_returns_only_active_brands_in_sort_order(): void
    {
        Brand::create(['name' => 'Brand B', 'slug' => 'brand-b', 'sort_order' => 2, 'status' => true]);
        Brand::create(['name' => 'Brand A', 'slug' => 'brand-a', 'sort_order' => 1, 'status' => true]);
        Brand::create(['name' => 'Hidden', 'slug' => 'hidden', 'status' => false]);

        $this->getJson('/api/brands')
            ->assertOk()
            ->assertJsonPath('data.0.name', 'Brand A')
            ->assertJsonPath('data.1.name', 'Brand B')
            ->assertJsonCount(2, 'data');
    }

    public function test_products_returns_active_products_paginated_by_twelve(): void
    {
        $category = Category::create([
            'category_name' => 'Điện thoại',
            'slug' => 'dien-thoai',
        ]);

        foreach (range(1, 13) as $number) {
            Product::create([
                'category_id' => $category->category_id,
                'product_name' => "Product {$number}",
                'slug' => "product-{$number}",
                'base_price' => 100000,
                'status' => true,
            ]);
        }

        Product::create([
            'category_id' => $category->category_id,
            'product_name' => 'Hidden product',
            'slug' => 'hidden-product',
            'base_price' => 100000,
            'status' => false,
        ]);

        $this->getJson('/api/products')
            ->assertOk()
            ->assertJsonCount(12, 'data')
            ->assertJsonPath('meta.per_page', 12)
            ->assertJsonPath('meta.total', 13);
    }
}
