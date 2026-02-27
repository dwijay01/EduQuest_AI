<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Topic;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * List all active subjects, optionally filtered by grade.
     */
    public function index(Request $request)
    {
        $query = Subject::active()->orderBy('order_index');

        if ($request->has('grade')) {
            $grade = (int) $request->grade;
            $query->with([
                'topics' => function ($q) use ($grade) {
                    $q->where('grade_level', $grade)
                        ->where('is_active', true)
                        ->orderBy('order_index');
                }
            ]);
        } else {
            $query->withCount('topics');
        }

        return response()->json([
            'subjects' => $query->get(),
        ]);
    }

    /**
     * List topics for a subject, filtered by grade.
     */
    public function topics(Request $request, Subject $subject)
    {
        $request->validate([
            'grade' => 'required|integer|min:1|max:6',
        ]);

        $topics = $subject->topics()
            ->where('grade_level', $request->grade)
            ->where('is_active', true)
            ->orderBy('order_index')
            ->get();

        return response()->json([
            'subject' => $subject,
            'topics' => $topics,
        ]);
    }
}
