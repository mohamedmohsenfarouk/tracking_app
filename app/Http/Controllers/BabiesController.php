<?php

namespace App\Http\Controllers;

use App\Models\Babies;
use App\Models\Partners;
use Illuminate\Http\Request;

class BabiesController extends Controller
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

        $partner_id = $request->partner_id;
        $parent_id = $request->parent_id;
        $partner = Partners::find($partner_id);
        if ($partner) {

            if ($partner->parent_id !=  $parent_id) {

                return response()->json(['status' => '200', 'error' => "Partner id not valid"]);
            }
        }

        $baby = new Babies();

        $baby->partner_id = $partner_id;
        $baby->parent_id = $parent_id;
        $baby->name = $request->input('name');

        $baby->save();
        return response()->json(['status' => '200', 'data' => $baby]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $baby = Babies::find($request->baby_id);
        return response()->json(['status' => '200', 'data' => $baby]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showAll(Request $request)
    {
        $babies = Babies::where('parent_id', $request->parent_id)->get();
        return response()->json(['status' => '200', 'data' => $babies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $request, $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $baby = Babies::find($id);
        if ($baby->parent_id == $request->parent_id) {
            if ($request->name != '') {
                $baby->update([
                    'name' => $request->name
                ]);
            }
            return response()->json(['status' => '200', 'data' => 'Baby updated']);
        } else {
            return response()->json(['status' => '200', 'data' => 'Parent not the one who added the baby']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $request, $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $baby = Babies::find($id);
        if ($baby->parent_id == $request->parent_id) {
            $baby->delete();
            return response()->json(['status' => '200', 'data' => 'Baby deleted']);
        } else {
            return response()->json(['status' => '200', 'data' => 'Parent not the one who added the baby']);
        }
    }
}
