<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Employee;
use DateTime;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employee = Employee::where('employee_id', $request->id)->first();
        $access = Access::create([
            'employee' => $request->id,
            'datetime' => new DateTime(),
        ]);
        if(isset($employee)){
            $access->employee_id = $employee->id; 
            if(!$employee->dissabled){   
                $access->canAccess = true;   
                $access->save();
                return view('access', compact('employee'));
            }
            $access->save();
        }
        return view('access-denied');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function show(Access $access)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function edit(Access $access)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Access $access)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Access  $access
     * @return \Illuminate\Http\Response
     */
    public function destroy(Access $access)
    {
        //
    }
}
