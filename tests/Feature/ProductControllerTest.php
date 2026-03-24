<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('products page is protected for guests', function () {
    $response = $this->get(route('products.index'));

    $response->assertRedirect(route('login'));
});

test('authenticated user can access products page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('products.index'));

    $response->assertStatus(200);
    $response->assertViewIs('products.index');
    $response->assertSee('Gestión de Productos');
    $response->assertSee('Agregar Producto');
});

test('authenticated user can access product creation page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get(route('products.create'));

    $response->assertStatus(200);
    $response->assertViewIs('products.create');
    $response->assertSee('Agregar Producto');
    $response->assertSee('Detalles del Producto');
});

test('authenticated user can store a new product', function () {
    $user = User::factory()->create();

    \Illuminate\Support\Facades\DB::table('categories')->insert(['id' => 1, 'name' => 'Test Category']);
    \Illuminate\Support\Facades\DB::table('distributors')->insert(['id' => 1, 'name' => 'Test Distributor']);

    $productData = [
        'name' => 'Test Product',
        'barcode' => '1234567890123',
        'category_id' => 1,
        'distributor_id' => 1,
        'price' => 15.50,
        'cost' => 10.00,
        'stock' => 50,
        'stock_min' => 10,
        'iva' => 18,
        'description' => 'A test description',
        'is_active' => 1,
    ];

    $response = $this->actingAs($user)->post(route('products.store'), $productData);

    $response->assertRedirect(route('products.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('products', [
        'name' => 'Test Product',
        'barcode' => '1234567890123',
        'price' => 15.50,
        'cost' => 10.00,
        'stock' => 50,
        'is_active' => 1,
    ]);
});

test('validate required fields on product creation', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('products.store'), []);

    $response->assertSessionHasErrors(['name', 'price', 'cost', 'stock']);
});
