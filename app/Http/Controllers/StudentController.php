<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\Students as StudentCollection;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query('includes') === 'classroom'){
            $student = Student::with('classroom')->paginate(1);
        }else{
            $student = Student::paginate(1);
        }
        return (new StudentCollection($student))
                    ->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\StudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        return Student::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->all());
        return [];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return [];
    }
}
