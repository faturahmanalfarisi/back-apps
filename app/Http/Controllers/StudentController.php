<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        // View all data
        $student = Student::all();
        $data = [
            'message' => 'Successfully accessed data',
            'data' => $student
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $input = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        $student = Student::create($input);
        $data = [
            'message' => 'Data successfully added',
            'data' => $student
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->nama = $request->nama;
            $student->nim = $request->nim;
            $student->email = $request->email;
            $student->jurusan = $request->jurusan;
            $student->save();

            $data = [
                'message' => 'Data successfully updated',
                'data' => $student
            ];
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return response()->json(['message' => 'Data successfully deleted'], 200);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}
