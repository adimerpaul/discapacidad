<?php

namespace App\Http\Controllers;


use App\Models\Pago;
use App\Models\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller{
    public function dia(Request $request)
    {
        return Pago::whereDate('fechapago',$request->dia)
            ->where('estado','PAGADO')
            ->with('responsable')
            ->with('user')
            ->get();
    }
    public function mes(Request $request)
    {
        return Pago::whereYear('fechapago',$request->anio)
            ->whereMonth('fechapago',$request->mes)
            ->where('estado','PAGADO')
            ->with('responsable')
            ->with('user')
            ->get();
    }
    public function anio(Request $request)
    {
        return Pago::whereYear('fechapago',$request->anio)
//            ->whereMonth('fechapago',$request->mes)
            ->where('estado','PAGADO')
            ->with('responsable')
            ->with('user')
            ->get();
    }
    public function mesfaltante(Request $request)
    {
        return Pago::where('gestion',$request->anio)
            ->where('mes',$request->mes)
            ->where('estado','PENDIENTE')
            ->with('responsable')
            ->with('user')
            ->get();
    }
    public function aniofaltante(Request $request)
    {
        return Pago::where('gestion',$request->anio)
//            ->whereMonth('fechapago',$request->mes)
            ->where('estado','PENDIENTE')
            ->with('responsable')
            ->with('user')
            ->get();
    }
    public function index()
    {
        //
        return DB::table('pagos')->select('nro','razon')->distinct('nro')->get();
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
        //return $request;
        if($request->responsable['ci']!=null)
        {   $res=Responsable::find($request->responsable['id']);
            if(!$res){
            $responsable = new Responsable;
            $responsable->ci=$request->responsable['ci'];
            $responsable->nombre=$request->responsable['nombre'];
            $responsable->relacion=$request->responsable['relacion'];
            $responsable->save();}
        }
        foreach ($request->pend as $uppago) {
            $pago=Pago::find($uppago['id']);
            $pago->fechapago=date('Y-m-d H:i:s');
            $pago->user_id=$request->user()->id;
            $pago->foto=$request->foto;
            $pago->estado='PAGADO';
            if($request->responsable['ci']!=null && !$res)
                $pago->responsable_id=$responsable->id;
            if($request->responsable['ci']!=null && $request->responsable['id']!=null)
                $pago->responsable_id=$request->responsable['id'];
            $pago->save();
        }
        return true;
    }
    public function verpendiente(Request $request){
        return Pago::where('nro',$request->nro)->where('estado','PENDIENTE')->get();
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
        return Pago::where('nro',$request->nro)->where('estado','PENDIENTE')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //

    }

    public function actualizapago(Request $request){
        if($request->responsable=='')
            {
                $responsable = new Responsable;

            }
            else $responsable='';
        foreach ($request->pagos as $uppago) {
            $pago=Pago::find($uppago->id);
            $pago->fechapago=date('Y-m-d');
            $pago->user_id=Auth::user()->id;
            $pago->foto=$request->foto;
            $pago->estado='PAGADO';
            if($responsable!='')
                $pago->responsable_id=$responsable->id;
            $pago->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }
    public function upload(Request $request){
        $this->validate($request, [
            'imagen'=>'required'
        ]);
//        return $request->imagen;
        if ($request->hasFile('imagen')) {
//            return "si";
            $file=$request->file('imagen');
            $nombreArchivo = time().".".$file->getClientOriginalExtension();
//        return $nombreArchivo;
            $file->move(\public_path('imagenes'), $nombreArchivo);
            return $nombreArchivo;
        }

    }
}
