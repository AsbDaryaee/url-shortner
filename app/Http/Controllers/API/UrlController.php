<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Url;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $user_urls_list = $user->urls()->paginate(30);

        return response()->json($user_urls_list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1024',
            'url' => 'required|url|max:4080',
        ]);

        $user = $request->user();

        $url = $user->urls()->create($validated);

        return response()->json($url);
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url): JsonResponse
    {
        $url->addView();
        return response()->json($url);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Url $url): JsonResponse
    {
        Gate::authorize('update', $url);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string|max:1024',
            'url' => 'sometimes|string|max:4080',
        ]);

        $url->update($validated);

        return response()->json($url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url): JsonResponse
    {
        Gate::authorize('update', $url);

        $url->delete();

        return response()->json([
            'message' => 'URL deleted successfully'
        ]);
    }

    public function redirectTo(Url $url): RedirectResponse
    {
        // validate the URL before redirecting
        if (!filter_var($url->url, FILTER_VALIDATE_URL)) {
            abort(400, 'Invalid URL');
        }

        $url->addView();
        return redirect($url->url);
    }
}
