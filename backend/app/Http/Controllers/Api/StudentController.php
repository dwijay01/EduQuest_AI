<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * List all students for the authenticated parent.
     */
    public function index(Request $request)
    {
        $students = $request->user()->students()
            ->withCount(['learningSessions', 'progress'])
            ->get();

        return response()->json(['students' => $students]);
    }

    /**
     * Create a new student (child).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'grade' => 'required|integer|min:1|max:6',
            'birth_date' => 'nullable|date',
            'interests' => 'nullable|array',
        ]);

        $student = $request->user()->students()->create($validated);

        return response()->json([
            'student' => $student,
            'message' => 'Profil anak berhasil dibuat!',
        ], 201);
    }

    /**
     * Get a specific student.
     */
    public function show(Request $request, Student $student)
    {
        // Ensure parent owns this student
        if ($student->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $student->load([
            'progress.topic.subject',
            'learningSessions' => function ($q) {
                $q->latest()->limit(10);
            }
        ]);

        return response()->json(['student' => $student]);
    }

    /**
     * Save onboarding data for a student.
     */
    public function onboarding(Request $request, Student $student)
    {
        if ($student->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'interests' => 'required|array|min:3',
            'grade' => 'sometimes|integer|min:1|max:6',
        ]);

        $student->update([
            'interests' => $validated['interests'],
            'grade' => $validated['grade'] ?? $student->grade,
        ]);

        return response()->json([
            'student' => $student->fresh(),
            'message' => 'Onboarding selesai!',
        ]);
    }
}
