<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historias;

class HistoriaController extends Controller
{
    //
	public function index(){
		$historias = Historias::all();
		return Response()->json($historias);
	}
	
	public function crearHistoria(Request $request){
		$historia = new Historias;
		$historia->medico_id = $request->medico_id;
		$historia->paciente_id = $request->paciente_id;
		$historia->estado = $request->estado;
		$historia->antecedentes = $request->antecedentes;
		$historia->evolucion = $request->evolucion;
		$historia->concepto = $request->concepto;
		$historia->recomendaciones = $request->recomendaciones;
		$historia->consecutivo = $request->consecutivo;
		$historia->save();
		return response()->json([
		"message"=>"Historia Agregada"], 201);
		
	}
	
	public function actualizarHistoria(Request $request, $id){
		if(Historias::where($id)->exists()){
		$historia->medico_id = is_null($request->medico_id)? $historia->medico_id : $request->medico_id;
		$historia->paciente_id = $request->paciente_id;
		$historia->medico_id = is_null($request->medico_id)? $historia->medico_id : $request->medico_id;
		$historia->estado = $request->estado;
		$historia->medico_id = is_null($request->medico_id)? $historia->medico_id : $request->medico_id;
		$historia->antecedentes = $request->antecedentes;
		$historia->medico_id = is_null($request->medico_id)? $historia->medico_id : $request->medico_id;
		$historia->evolucion = $request->evolucion;
		$historia->medico_id = is_null($request->medico_id)? $historia->medico_id : $request->medico_id;
		$historia->concepto = $request->concepto;
		$historia->medico_id = is_null($request->medico_id)? $historia->medico_id : $request->medico_id;
		$historia->recomendaciones = $request->recomendaciones;
		$historia->medico_id = is_null($request->medico_id)? $historia->medico_id : $request->medico_id;
		$historia->consecutivo = $request->consecutivo;
		$historia->medico_id = is_null($request->medico_id)? $historia->medico_id : $request->medico_id;
		$historia->save();
		return response()->json([
		"message"=>"Historia Actualizada"], 201);
		}else{
			return response()->json(["message"=>"historia no encontrada"],404);
		}
		
	}
	
	public function mostrarHistoria($id){
		$historia = Historias::find($id);
		if(!empty($historia)){
			return response()->json($historia);
		}else{
			return response()->json(["message"=>"historia no encontrada"],404);
		}		
	}
	
	public function borrarHistoria($id){
		if(Historias::where($id)->exists()){
			$historia = Historias::find($id); 
			$historia->delete();
			return response()->json([
		"message"=>"Historia Borrada"], 202);
		}else{
			return response()->json(["message"=>"historia no encontrada"],404);
		}	
	}
}
