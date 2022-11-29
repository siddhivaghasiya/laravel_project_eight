<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ajaxlisting(Request $request)
    {
        $sql = \App\Models\Product::select("*");


        return Datatables::of($sql)

            ->editColumn('id', function ($data) {
                return $data->id;
            })


            ->editColumn('name', function ($data) {
                return $data->name;
            })

            ->editColumn('details', function ($data) {
                return $data->details;
            })


            ->editColumn('status', function ($data) {

                if ($data->status == 1) {

                    return '<span class="btn btn-success btn-sm">' . trans('lang_data.active_lable') . '</span>';
                } else {

                    return '<span class="btn btn-danger btn-sm">' . trans('lang_data.inactive_lable') . '</span>';
                }
            })

            ->addColumn('action', function ($data) {

                $string = '<a href="' . route('product.edit', $data->id) . '" class="btn btn-primary btn-sm editProduct">' . trans('lang_data.edit_lable') . '</a> <a href="javascript:void(0)" data-link="' . route('product.destroy', $data->id) . '" class="btn btn-danger btn-sm delete">' . trans('lang_data.delete_lable') . ' </a> ';


                return $string;
            })
            ->filter(function ($query) use ($request) {
            })
            ->rawColumns(['id', 'name', 'details', 'status', 'action'])
            ->make(true);
    }


    public function create()
    {
        return view('product.addedit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'status' => 'required',
        ]);

        $obj = new \App\Models\Product;
        $obj->name = $request->name;
        $obj->details = $request->details;
        $obj->status = $request->status;

        $obj->save();

        return response()->json(['status' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('product.addedit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $obj = \App\Models\Product::where('id', $id)->first();

        $obj->delete();

        return response()->json(['status' => 0]);
    }
}
