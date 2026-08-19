<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Data\Student\StudentData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\CreateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->input('perPage', 20);
        $search = $request->input('search');

        $students = Student::query()
            ->orderBy('name')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('nis', 'like', "%{$search}%")
                        ->orWhere('nisn', 'like', "%{$search}%");
                });
            })
            ->paginate($perPage)
            ->withQueryString();

        return Inertia::render('dashboard/admin/students/index', [
            'title' => env('APP_NAME').' | Manajemen siswa',
            'students' => StudentData::collect($students),
            'filter' => compact('perPage', 'search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('dashboard/admin/students/create', [
            'title' => env('APP_ENV').' | Buat siswa baru',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(CreateStudentRequest $request, StudentService $studentService)
     {
        $student = $studentService->create(
            $request->validated(),
            $request->file('avatar')
        );

        if (! $student) {
            Inertia::flash('toast', [
                'message' => 'Gagal menambahkan siswa. Silakan coba lagi.',
                'type'    => 'error',
                'code'    => 500,
            ]);

            return back();
        }

        Inertia::flash('toast', [
            'message' => 'Siswa berhasil ditambahkan!',
            'type'    => 'success',
            'code'    => 201,
        ]);

        if (!$request->boolean('create_another')) {
            return redirect()->route('dashboard.admin.students.show', [
                'student' => $student
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student = $student->load('user');

        return Inertia::render('dashboard/admin/students/show', [
            'title' => env('APP_ENV').' | Data siswa',
            'student' => new StudentResource($student),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
