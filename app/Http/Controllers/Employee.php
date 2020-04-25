<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use \App\EmployeeModel;

class Employee extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.employee.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ // <---
            'name' => 'required|max:255|min:10',
            'cpf' => 'numeric|digits:11',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        } else {

            $employee = new EmployeeModel();

            $employee->name = $request->name;
            $employee->cpf = $request->cpf;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->adress = $request->adress;
            $employee->adressNumber = $request->adressNumber;
            $employee->adressNumberInfo = $request->adressNumberInfo;

            $employee->save();
            return redirect()->back()->with('message', 'Colaborador adicionado com sucesso.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
