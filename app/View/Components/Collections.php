<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\View\Component;

class Collections extends Component
{
    /**
     * The results and type of the component. The type is public so it can be used in the view.
     *
     * @var
     */
    public $results, $type;

    /**
     * Create a new component instance.
     *
     * @param $type
     * @param $limit
     */
    public function __construct($type, $limit = null)
    {
        // Set the type for the view
        $this->type = $type;

        // Example of getting collections from the API. This can be used for employees, cases, etc. Whatever collections you have in the API.
        if ($type == 'employees') {
            // Fetch the data
            $this->fetchData($type, $limit);
        } elseif ($type == 'casesSlider') {
            // Set the filter because the API uses a different name than the component
            $filter = 'case';
            // Fetch the data
            $this->fetchData($filter, $limit, 'casesSlider');
        }
    }

    /**
     * Fetch the data from the API
     *
     * @param $type
     * @param $limit
     * @param $filter
     * @return mixed
     */
    public function fetchData($type, $limit, $filter = null)
    {
        // Set the filter and limit
        if ($filter) {
            $type = $filter;
        }

        // Set the cache key and time
        $cacheKey = 'api_' . $type;
        $cacheTime = 1500;

        // Check if the cache exists
        Cache::remember($cacheKey, $cacheTime, function () use ($filter, $limit) {
            // Fetch the data
            $data = $this->connectToApi($filter, $limit);
            // Return the data
            return $data;
        });

        // Set the data
        return $this->results = Cache::get($cacheKey);
    }

    /**
     * Connect to the API
     *
     * @param $type
     * @param $limit
     * @return array|mixed|null
     */
    public function connectToApi($type, $limit = null)
    {
        // Set the URL and token
        $url = env('BAKKU_API_URL') . env('BAKKU_SITE_ID') . '/documents?filter[template]=' . $type . '&sort=position';
        $token = env('BAKKU_API_TOKEN');

        // Make the request
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->get($url);

        // Ensure the request was successful
        if ($response->successful()) {
            // Return the data
            return $limit ? array_slice($response->json()['data'], 0, $limit) : $response->json()['data'];
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
        return view('components.collections');
    }
}
