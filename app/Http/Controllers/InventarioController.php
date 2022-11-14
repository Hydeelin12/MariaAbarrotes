<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['inventarios']=Inventario::paginate(1);
        return view('inventario.index',$datos );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('inventario.create');
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

        $campos=[

            'Nombre'=>'required|string|max:100',
            'Marca'=>'required|string|max:100',
            'Codigo'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',
               
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto requerida'
        ];

        $this->validate($request, $campos,$mensaje);
        //$datosinventario = request()->all();
        $datosinventario = request()->except('_token');

        if($request->hasFile('Foto')){
            $datosinventario['Foto']=$request->file('Foto')->store('uploads','public');
        }

        inventario::insert($datosinventario);

         //return response()->json($datosinventario);
        return redirect('inventario')->with('mensaje','inventario Agregado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $inventario=Inventario::findOrFail($id);
        return view('inventario.edit', compact('inventario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $campos=[
            'Nombre'=>'required|string|max:100',
            'Marca'=>'required|string|max:100',
            'Codigo'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            
               
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            
           
        ];

        if($request->hasFile('Foto')){
            $campos=['Foto'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=[ 'Foto.required'=>'La foto es requerida' ];
            }

        $this->validate($request, $campos,$mensaje);

        //
        $datosinventario = request()->except(['_token','_method']);

        $inventario=Inventario::findOrFail($id);
        Storage::delete('public/'.$inventario->Foto);

        if($request->hasFile('Foto')){


            $datosinventario['Foto']=$request->file('Foto')->store('uploads','public');
        }


        Inventario::where('id','=',$id)->update($datosinventario);
        $inventario=Inventario::findOrFail($id);
       //return view('inventario.edit', compact('inventario'));
        return redirect('inventario')->with('mensaje',' inventario Modificado ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $inventario=Inventario::findOrFail($id);

        if(Storage::delete('public/'.$inventario->Foto)) {
         
        Inventario::destroy($id); 

        }
        
        

        return redirect('inventario')->with('mensaje',' inventario Borrado ');
    }
}
