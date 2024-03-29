<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class Media extends Component
{
    /**
     * The image source and alt text
     *
     * @var string
     */
    public $src, $alt;

    /**
     * Create a new component instance.
     *
     * @param $id
     */
    public function __construct($id)
    {
        // Fetch the image
        $image = $this->fetchImage($id);

        // Set the src and alt
        if (!is_null($image)) {
            $this->src = 'https://media.bakku.cloud/' . $image['attributes']['url'];
            $this->alt = $image['attributes']['title'];
        } else {
            $this->src = 'https://via.placeholder.com/300';
            $this->alt = 'Placeholder';
        }
    }

    /**
     * Connect to the API
     *
     * @param $id
     * @return mixed|null
     */
    public function fetchImage($id)
    {
        // Set the cache key and time
        $cacheKey = 'api_image-' . $id;
        $time = 1500;

        // Check if the cache exists
        Cache::remember($cacheKey, $time, function () use ($id) {
            // Fetch the data
            $data = $this->connectToApi($id);
            // Return the data
            return $data;
        });

        // Get the image from the cache
        $image = Cache::get($cacheKey);

        // If the image is not null, set the src and alt
        if (!is_null($image)) {
            return $image;
        } else {
            return null;
        }

    }

    /**
     * Connect to the API
     *
     * @param $id
     * @return mixed|null
     */
    public function connectToApi($id)
    {
        // Set the URL and token
        $url = env('BAKKU_API_URL') .env('BAKKU_SITE_ID'). '/media/' . $id;
        $token = env('BAKKU_API_TOKEN');

        // Make the request
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->get($url);

        // Ensure the request was successful
        if ($response->successful()) {
            // Return the data
            return $response->json()['data'];
        } else {
            // Handle the errors
            return null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.media');
    }
}
