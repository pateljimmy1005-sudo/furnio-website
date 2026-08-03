<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('home', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('user is redirected to intended url after login when coming from previous page', function () {
    $user = User::factory()->create();
    $product = \App\Models\Product::create([
        'name' => 'Test Sofa',
        'category' => 'Sofa',
        'price' => 500,
        'description' => 'A nice sofa',
        'image' => 'storage/products/test.jpg',
        'stock' => 10,
    ]);

    $detailUrl = route('image.detail', $product->id);

    // Simulate user viewing product detail page and navigating to login
    $response = $this->from($detailUrl)->get('/login');
    $response->assertStatus(200);

    // User logs in
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect($detailUrl);
});

test('unauthenticated buy now action saves intended product detail page and redirects to intended page after login', function () {
    $user = User::factory()->create();
    $product = \App\Models\Product::create([
        'name' => 'Test Sofa',
        'category' => 'Sofa',
        'price' => 500,
        'description' => 'A nice sofa',
        'image' => 'storage/products/test.jpg',
        'stock' => 10,
    ]);

    $detailUrl = route('image.detail', $product->id);

    // Unauthenticated user attempts buy now action from detail page
    $response = $this->from($detailUrl)->post(route('buy.now', $product->id));
    $response->assertRedirect(route('login'));

    // User logs in
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect($detailUrl);
});




