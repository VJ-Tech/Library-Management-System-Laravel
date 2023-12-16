<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $students = Student::orderBy("updated_at", "desc")
        ->orderBy("created_at", "desc")
        ->get();

        return view('Student',['students' => $students]);
    }

    public function destroy(Student $student) {
        $student->checkouts->each(function ($checkouts) {
            $checkouts->delete();
        });

        $student->delete();
    }

    public function view($student) {
        $students = Student::find($student);

        return response()->json($students);
    }

    public function update(Request $request, Student $student) {
        $fields = $request->validate([
            'name'=> 'required | string',
            'email'=> 'required | string',
            'phone'=> 'required | string',
        ]);

        $student->update($fields);
    }

    public function store(Request $request ) {
        $fields = $request->validate([
            'name'=> 'required | string',
            'email'=> 'required | string',
            'phone'=> 'required | string',
        ]);

        Student::create($fields);
        return redirect('/students');
    }
}
