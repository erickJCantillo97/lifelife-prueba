<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Departament;
use App\Models\Employee;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $departament_id = $request->departament;
        $departaments = Departament::orderBy('name')->get();
        $employees = Employee::where('departament_id', 'LIKE',$departament_id)
        ->where(function ($query) use ($search){
            $query->where('firstname', 'LIKE', '%'.$search.'%')
            ->orWhere('lastname', 'LIKE', '%'.$search.'%')
            ->orWhere('employee_id', 'like', '%'.$search.'%');
        })->orderBy('employee_id')->get();

        // $employees = Employee::where('departament_id', $departament_id)
        //     ->orWhere('lastname', 'like', '%'.$search.'%')
        //     ->orWhere('lastname', 'like', '%'.$search.'%')
        //     ->orWhere('employee_id', 'like', '%'.$search.'%')
        // ->get();
       
        return view('dashboard', compact('departaments', 'employees', 'search', 'departament_id'));
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
        
        $data_validate = request()->validate([
            'employee_id' => ['required', 'unique:employees,employee_id', 'numeric'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            'departament' => ['nullable'],
            'newDepartament' => ['nullable'],
        ]);

    
        $departament_id = $request->newDepartament == null ?  $data_validate['departament']: Departament::firstOrCreate([
            'name' => $data_validate['newDepartament'],
        ])->id;

        unset($data_validate['departament'], $data_validate['newDepartament']);

        $data_validate['departament_id'] = $departament_id;
        
        Employee::create($data_validate);

        $departaments = Departament::orderBy('name')->get();
        $employees = Employee::orderBy('employee_id')->get();
        
        return view('dashboard', compact('departaments', 'employees'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee, Request $request)
    {
        $access = Access::where('employee_id', $employee->id)->get();
        if(isset($request->start) && isset($request->end)){
            $access = Access::where('employee_id', $employee->id)->whereBetween('datetime', [$request->start, $request->end])->get();
        }
        return view('access-details', compact('employee', 'access'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        $data_validate = request()->validate([
            'employee_id' => ['required', 'unique:employees,employee_id,'.$employee->id, 'numeric'],
            'firstname' => ['required'],
            'lastname' => ['required'],
            'departament' => ['nullable'],
            'newDepartament' => ['nullable'],
        ]);

    
        $departament_id = $request->newDepartament == null ?  $data_validate['departament']: Departament::firstOrCreate([
            'name' => $data_validate['newDepartament'],
        ])->id;

        unset($data_validate['departament'], $data_validate['newDepartament']);

        $data_validate['departament_id'] = $departament_id;
        $employee->update($data_validate);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back();
    }

    public function loadMasive(Request $request){
        $file = $request->file('file');
       
        $content = utf8_encode(file_get_contents($file));
        $Data = str_getcsv($content, "\n"); //parse the rows
        foreach($Data as &$data) {
        $datos[] = str_getcsv($data, ";"); //parse the items in rows
        }
        for($i=1; $i<sizeof($datos); $i++){
            Employee::create([
                'employee_id' => $datos[$i][0],
                'firstname' => $datos[$i][1],
                'lastname' => $datos[$i][2],
                'departament' => Departament::firstOrCreate(['name' => $datos[$i][3]])->id,
            ]);
        }
        return back();
    }
}
