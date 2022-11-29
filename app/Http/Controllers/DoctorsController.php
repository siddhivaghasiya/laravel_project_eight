<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class DoctorsController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctors.index');


    }

    public function ajaxlisting(Request $request)
    {
        $sql = \App\Models\Doctors::select("*");


        return Datatables::of($sql)

            ->editColumn('id', function ($data) {
                return $data->id;
            })


            ->editColumn('name', function ($data) {
                return $data->name;
            })

            ->editColumn('position', function ($data) {
                return $data->position;
            })

            ->editColumn('description', function ($data) {
                return $data->description;
            })

            ->editColumn('status', function ($data) {

                if ($data->status == 1) {

                    return '<span class="btn btn-success btn-sm">' . trans('lang_data.active_lable') . '</span>';
                } else {

                    return '<span class="btn btn-danger btn-sm">' . trans('lang_data.inactive_lable') . '</span>';
                }
            })

            ->addColumn('action', function ($data) {

                $string = '<a href="' . route('doctors.edit', $data->id) . '" class="btn btn-primary btn-sm">' . trans('lang_data.edit_lable') . '</a> <a href="' . route('doctors.show', $data->id) . '" class="btn btn-danger btn-sm">' . trans('lang_data.delete_lable') . ' </a> ';


                return $string;
            })
            ->filter(function ($query) use ($request) {
            })
            ->rawColumns(['id', 'name', 'position', 'description', 'status', 'action'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.addedit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $obj = \App\Models\Doctors::where('id',$id)->first();

        $obj->delete();

        return redirect()->route('doctors.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editdata = \App\Models\Doctors::where('id',$id)->firstOrfail();

        return view('doctors.addedit',compact('editdata'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $obj =  \App\Models\Doctors::where('id',$id)->first();
        $obj->name = $request->name;
        $obj->position = $request->position;
        $obj->description = $request->description;
        $obj->status = $request->status;

        $obj->save();

        return response()->json(['status'=>'1']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
