<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Get the documents from the API
$url = env('BAKKU_API_URL') . env('BAKKU_SITE_ID') . '/documents';
$token = env('BAKKU_API_TOKEN');

// Cache settings
$cacheKey = 'api_documents';
$cacheTime = 1500;

// Get the documents from the cache or make a request to the API
Cache::remember($cacheKey, $cacheTime, function () use ($url, $token) {
    // Make a request to the API
    $response = Http::withHeaders([
        'Authorization' => $token,
    ])->get($url);

    // Check if the request was successful
    if ($response->successful()) {
        return $response->json()['data'];
    } else {
        // Return null if the request was not successful
        return null;
    }
});

// Get the documents from the cache
$documents = Cache::get($cacheKey);

// Check if the documents are not null
if (!is_null($documents)) {
    // Loop through the documents and create routes
    foreach ($documents as $document) {
        // Check if the document is the home page or a standard page
        if ($document['attributes']['slug'] === 'home') {
            Route::get('/', function () use ($document) {
                return view('pages.home-page')->with('blocks', $document['attributes']['blocks'])->with('props', $document['attributes']['props'])->with('slug', $document['attributes']['slug']);
            });
        } elseif ($document['attributes']['parent_slug'] === 'diensten') {
            Route::get('/diensten/' . $document['attributes']['slug'], function () use ($document) {
                return view('pages.service-page')->with('blocks', $document['attributes']['blocks'])->with('props', $document['attributes']['props'])->with('slug', $document['attributes']['slug']);
            });
        } elseif ($document['attributes']['parent_slug'] === 'cases') {
            Route::get('/cases/' . $document['attributes']['slug'], function () use ($document) {
                return view('pages.case-page')->with('blocks', $document['attributes']['blocks'])->with('props', $document['attributes']['props'])->with('slug', $document['attributes']['slug']);
            });
        } else {
            Route::get('/' . $document['attributes']['slug'], function () use ($document) {
                return view('pages.standard-page')->with('blocks', $document['attributes']['blocks'])->with('props', $document['attributes']['props'])->with('slug', $document['attributes']['slug']);
            });
        }
    }
} else {
    // If the documents are null, return a 404 page
    Route::fallback(function () {
        return view('errors.404');
    });
}

// Contact form route
Route::post('/send', function () {
    // Validate the form data
    request()->validate([
        'name' => 'required',
        'email' => 'required|email',
        'content' => 'required'
    ]);

    // Custom error messages
    $messages = [
        'name.required' => 'The name field is required',
        'email.required' => 'The email field is required',
        'email.email' => 'The email field must be a valid email address',
        'content.required' => 'The message field is required'
    ];

    // Get the form data
    $data = request()->all();

    // Write your send mail logic here
    Mail::send('emails.contact', $data, function ($message) use ($data) {
        $message->to('testW@test.com', 'Test')->subject('Contact Form');
    });
})->name('sendForm');

// Redirect to the admin panel
Route::get('/admin', function () {
    return redirect('https://admin.bakku.cloud');
});
