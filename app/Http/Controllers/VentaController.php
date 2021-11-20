<?php

namespace App\Http\Controllers;

use App\DetalleVenta;
use Illuminate\Support\Facades\DB;
use App\Venta;
use App\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::all();
        return view('ventas.index')->with('ventas', $ventas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $last_id = $this->generarFolio();
        return view("ventas.create", compact('last_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request['data'];
        $productos = $data['lista'];

        $venta = new Venta();
        $venta->empleado_id = Auth()->User()->empleado->id;
        $venta->save();

        foreach($productos as $producto){
            $this->storeDetalleVenta($producto, $venta->id);
        }

    }

    public function storeDetalleVenta($productoAux, $folio_venta){
        $producto = Producto::find($productoAux['id_producto']);

        $producto->reducirStock($productoAux['cantidad']);

        $ventaD = new DetalleVenta();
        $ventaD->venta_id = $folio_venta;
        $ventaD->producto_id = $producto->id;
        $ventaD->articulos = $productoAux['cantidad'];
        $ventaD->costo = $producto->precio_venta;
        $ventaD->Save();
      }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }

    public function generarFolio(){
        $last_id = DB::table('ventas')->latest('id')->first();

        //$last_id ?? "0";
        if(!isset($last_id))
        return "1";

        return $last_id->id + 1;
    }
}
