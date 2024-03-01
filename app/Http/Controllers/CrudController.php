<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function index() {
        $datos=DB::select(" select * from prueba ");
        return view("welcome")->with("datos", $datos);
    }

    public function create(Request $request){
        try {
            $sql=DB::insert(" insert into prueba(CODIGO,NOMBRE,PRECIO,CANTIDAD)values(?,?,?,?,?) ", [
                $request->txtcodigo, 
                $request->txtnombre, 
                $request->txtprecio,  
                $request->txtcantidad,
                $request->imagen, 
            ]);
        }
        catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Producto registrado correctamente");
        }
        else {
            return back()->with("incorrecto", "Error al registrar");
        }
    }

    public function update(Request $request){
        if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $producto['imagen'] = "$imagenProducto";

            $guardarimagen = 1;
        }
        
        try {
            $sql=DB::update(" update prueba set NOMBRE=?, PRECIO=?, CANTIDAD=?, IMAGEN=? where CODIGO=? ", [
                $request->txtnombre, 
                $request->txtprecio,  
                $request->txtcantidad,
                $imagenProducto,
                $request->txtcodigo, 
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        }
        catch (\Throwable $th) {
            $sql=0;
            $guardarimagen=0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Producto modificado correctamente");
        }
        else {
            if ($guardarimagen == 1){
                return back()->with("incorrecto", "Error al modificar");
            }
            else{
                return back()->with("incorrecto", "Error al subir la imagen");
            }
            
        }
    }

    public function delete($id){
        try {
            $sql=DB::delete(" delete from prueba where CODIGO=$id ");
        }
        catch (\Throwable $th) {
            $sql=0;
        }
        if ($sql == true) {
            return back()->with("correcto", "Producto eliminado correctamente");
        }
        else {
            return back()->with("incorrecto", "Error al eliminar");
        }
    }
}
