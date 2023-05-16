<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();

        return view('admin-panel.students.index', compact('students'));
    }

    // to create student count
    public function create(Request $request) {
        Student::create([
            'count' => $request->count,
        ]);

        return back()->with('successMsg', 'Successfully created students count!');
    }

    // to add student count
    public function add(Request $request, $id) {

        $studentCount = Student::find($id);
        $oldCount = $studentCount->count;

        $studentCount->update([
            'count' => $oldCount + $request->count,
        ]);

        return back()->with('successMsg', 'Successfully added!');
    }
}
