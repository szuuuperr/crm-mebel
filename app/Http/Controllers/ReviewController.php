<?php

namespace App\Http\Controllers;

use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function show(Request $request, string $identifier)
    {
        $reviewable = $this->reviewService->resolveReviewable($identifier);

        if (! $reviewable) {
            return $this->unavailable();
        }

        if ($this->reviewService->isAlreadyReviewed($reviewable)) {
            return redirect()->route('review.done', $identifier);
        }

        if (! $this->reviewService->isReviewable($reviewable)) {
            return $this->unavailable();
        }

        $type = $this->reviewService->resolveType($reviewable);

        return view('review.show', [
            'reviewable' => $reviewable,
            'type' => $type,
            'identifier' => $identifier,
        ]);
    }

    public function submit(Request $request, string $identifier)
    {
        $reviewable = $this->reviewService->resolveReviewable($identifier);

        if (! $reviewable) {
            return $this->unavailable();
        }

        if ($this->reviewService->isAlreadyReviewed($reviewable)) {
            return redirect()->route('review.done', $identifier);
        }

        if (! $this->reviewService->isReviewable($reviewable)) {
            return $this->unavailable();
        }

        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'keluhan_masukan' => 'required|string|min:10|max:2000',
        ], [
            'rating.required' => 'Silakan pilih rating bintang.',
            'rating.between' => 'Rating harus antara 1 sampai 5.',
            'keluhan_masukan.required' => 'Tuliskan keluhan atau masukan Anda.',
            'keluhan_masukan.min' => 'Masukan minimal 10 karakter.',
            'keluhan_masukan.max' => 'Masukan maksimal 2000 karakter.',
        ]);

        $reviewable->update([
            'rating' => $validated['rating'],
            'keluhan_masukan' => $validated['keluhan_masukan'],
        ]);

        return redirect()->route('review.done', $identifier);
    }

    public function done(string $identifier)
    {
        $reviewable = $this->reviewService->resolveReviewable($identifier);

        if (! $reviewable) {
            return $this->unavailable();
        }

        return view('review.done', [
            'reviewable' => $reviewable,
            'identifier' => $identifier,
        ]);
    }

    protected function unavailable()
    {
        return response()->view('review.unavailable', [], 404);
    }
}
