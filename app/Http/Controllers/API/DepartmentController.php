<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\If_;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $d =Department::all();
      //  $d =Department::find(2);
     // $d = Department::select('id','name')->orderBy('id','desc')->get();


   //  $d =DB::select('select * from departments order by id desc');
  //    $total =Department::count();

        $page_size = request()->query('page_size');
        $pageSize = $page_size == null ? 2 : $page_size;

      //  $d = Department::paginate(2);
      //  $d = Department::orderBy('id', 'desc')->with(['officers'])->get();
       // $d = Department::orderBy('id', 'desc')->with(['officers'])->paginate($pageSize);

        $d = Department::orderBy('id', 'desc')->with(['officers' => function($query){
            $query->orderBy('salary', 'desc');
        }])->paginate($pageSize);


        return response()->json($d, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(){
        $query = request()->query('name');
        $keyword = '%'.$query.'%';
        $d = Department::where('name','like', $keyword)->get();

        if ($d->isEmpty()) {
            return response()->json([
                'errors' => [
                    'status_code' => 404,
                    'message' => 'ไม่พบข้อมูล'
                ]
            ],404);
        }

        return response()->json([
            'data' => $d
        ], 200);
    }





    public function store(Request $request)
    {
        $d = new Department();
        $d->name = $request->name;
        $d->save();

        return response()->json([
            'message' => 'เพิ่มข้อมูลสำเร็จ',
            'data' => $d
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        $d = Department::find($id);

        if ($d == null) {
            return response()->json([
               'errors' => [
                 'status_code' => 404,
                 'message' => 'ไม่พบข้อมูลนี้'
               ]
            ], 404);//http status code
        }

        return response()->json($d, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id != $request->id){
            return response()->json([
                'errors' => [
                  'status_code' => 400,
                  'message' => 'รหัสแผนกไม่ตรงกัน'
                ]
             ], 400);//http status code
         }

        $d = Department::find($id);
        $d->name =$request->name;
        $d->save();
        return response()->json([
            'message' => 'แก้ไข้อมูลเรียบร้อย',
            'data' => $d
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $d = Department::find($id);

        if ($d == null) {
            return response()->json([
               'errors' => [
                 'status_code' => 404,
                 'message' => 'ไม่พบข้อมูลนี้'
               ]
            ], 404);//http status code
        }
        $d->delete();
        return response()->json([

            'ลบข้อมูลเรียบร้อยแล้ว'
        ], 200);
    }
}
