<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class StudentsController extends Controller
{
    public function index()
    {
        $students = Student::all();
        if($students->count() > 0){
            //$data = ['status' => 200, 'students' => $students ];
            return response()->json($students, 200);
        }else{
            $data = ['status' => 404, 'message' => 'no records found' ];
            return response()->json($data, 404);
        }
    }

    public function create(Request $request)
    {

    }

    public function store(Request $request){
        $data  = $request->all();

        $rules = [
            'username'  => 'required',
            'course'    => 'required',
            'age'       => 'required',
            'score'     => 'required',
        ];

        $messages  = [];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 422,
                'message'   => 'Validation failed',
                'errors'    => $validator->errors(),
            ]);
        }

        $student = Student::create($data);

        return response()->json([
            'status' => 200,
            'message' => 'student created successfully',
        ], 200);
    }

    public function show($id){
        $student = Student::where('id', $id)->first();
        if(isset($student) && !empty($student)){
            //return response()->json($student, 200);

            return response()->json([
                'status' => 200,
                'student' => $student
            ], 200);
            
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No such student found',
            ], 404);
        }
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'course' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        if(Student::where('id', $id)->exists()){
            $input = $request->except(['id', 'updated_at', 'created_at']);
            $status = Student::where('id', $id)->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'student updated successfully'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'this student does not exist'
            ], 404);
        }
    }

    public function destroy(string $id){
        if(Student::where('id', $id)->exists()){
            $status = Student::where('id', $id)->delete();
            return response()->json([
                'status' => 200,
                'message' => 'student deleted successfully',
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'this student does not exist',
            ]);
        }
    }
}
