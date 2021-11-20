<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Direccion;
use App\Puesto;
use App\User;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index')->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usersAvaliables = User::doesntHave('empleado')->get();

        return View('empleados.create')->with('usersAvaliables', $usersAvaliables);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = new Empleado();
        $empleado->user_id = $request['user_id'];
        $empleado->first_name = $request['first_name'];
        $empleado->last_name = $request['last_name'];
        $empleado->birthdate = $request['birthdate'];
        $empleado->sexo = $request['sexo'];
        $empleado->status = $request['status'];
        $empleado->phone_number = $request['phone_number'];
        $empleado->alergias = $request['alergias'];
        $empleado->hire_date = $request['hire_date'];
        $empleado->observation = $request['observation'];

        $empleado->save();

        $direccion =  new Direccion();
        $direccion->empleado_id =  $empleado->id;
        $direccion->calle = $request['calle'];
        $direccion->numero_casa = $request['numero_casa'];
        $direccion->save();

        $puesto = new Puesto();
        $puesto->empleado_id = $empleado->id;
        $puesto->salary = $request['salary'];
        $puesto->comision = $request['comision'];
        $puesto->puesto = $request['puesto'];
        $puesto->funciones = $request['funciones'];
        $puesto->save();

        return redirect() -> route('empleado.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */

    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
}

