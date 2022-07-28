<?php

namespace App\Http\Controllers;

use App\Models\Partners;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'parent_id' => 'required',
            'name' => 'required',
        ]);

        $partner = new Partners;

        $partner->parent_id = $request->input('parent_id');
        $partner->name = $request->input('name');

        $partner->save();
        return response()->json(['status' => '200', 'data' => $partner]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $all_partners = Partners::Where('parent_id', $id)->get();
        if (count($all_partners) > 0) {
            $partners = $all_partners;
        } else {
            $partners = 'No Partner';
        }
        return response()->json(['status' => '200', 'data' => $partners]);
    }
}
