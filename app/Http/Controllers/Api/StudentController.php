<?php

namespace App\Http\Controllers\Api;

use App\DTOs\StudentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();

        $studentDtos = $students->map(fn($student) => new StudentDTO($student->toArray()));

        return response()->json($studentDtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $validate = $request->validated();

        $student = Student::create($validate);

        $studentDto = new StudentDTO($student->toArray());

        return response()->json([
            'message' => 'Student created successfully.',
            'data'    => $studentDto
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::query()->find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $studentDto = new StudentDTO($student->toArray());

        return response()->json($studentDto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, string $id)
    {
        $student = Student::query()->find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $validate = $request->validated();

        $student->update($validate);

        $studentDto = new StudentDTO($student->toArray());

        return response()->json([
            'message' => 'Student updated successfully.',
            'data' => $studentDto
        ], 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::query()->find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully.'
        ], 202);
    }
}
