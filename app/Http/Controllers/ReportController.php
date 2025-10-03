<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function report(Request $request)
    {

        $report = $request->all();

        $allowedReasons = ['misinformation', 'low_quality', 'sexual_content', 'other'];

        $validated = $request->validate([
            'postId' => 'required|integer',
            'reason' => ['required', 'in:' . implode(',', $allowedReasons)],
            'other' => ['required_if:reason,other', 'nullable', 'string', 'min:10', 'max:50']
        ]);

        $postId = $validated["postId"];
        $reason = $validated["reason"];
        $other = $validated['other'] ?? null;

        // if user is not authentizated throw 401 error
        if (!Auth::check()) {
            return response()->json(["message" => "Authentication Required"], 401);
        }

        $reportInsert = Report::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'reason' => $reason,
            'other' => $other
        ]);


        return response()->json([
            'message' => 'Report submitted successfully',
            'report'  => $reportInsert
        ], 201);
    }
}
