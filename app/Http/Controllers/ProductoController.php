<?php

namespace App\Http\Controllers;

use App\Producto;
use App\Stock;
use Illuminate\Http\Request;

class ProductoController extends Controller
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
        $productos = Producto::all();

        return view('productos.index')->with('productos', $productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = new Producto();

        $producto->id = $request['id'];
        $producto->nombre = $request['nombre'];
        $producto->costo = $request['costo'];
        $producto->precio_venta = $request['precio_venta'];
        $producto->observaciones = $request['observaciones'];
        $producto->save();

        $stock = new Stock();
        $stock->producto_id = $producto->id;
        $stock->existencia = $request['existencia'];
        $stock->existencia_min = $request['existencia_min'];
        $stock->existencia_max = $request['existencia_max'];
        $stock->save();

        return redirect() -> route('producto.index');
    }

    public function updateStock(Request $request){
        $producto = Producto::find($request['id']);
        $producto->stock->existencia = $producto->stock->existencia + $request['cantidad'];
        $producto->stock->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function searchProducto(Request $request){
        $producto = Producto::find($request['id']);

        if(isset($producto)){ //2
            if(intval($producto->stock->existencia) < intval($request['cantidad']) || intval($request['cantidad']) <= 0)// 3 4
                return response(['noSuficiente' => true,  'cantidad' => $producto->stock->existencia]);// 5

           return response($producto->json()); //6
        }else

     return response(['noFound' => true]); //7

    }

    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
