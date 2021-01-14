@extends('admin.menuprincipal')
@section('tittle','Docentes/Gestión Académica/Editar Competencias Ciudadanas')
@section('content')
<div class="box box-primary col-sm-6 col-sm-offset-3" style="overflow: auto;width:50%;">
  <div class="box-header">
    <div class="col-sm-12">
      <h2 class="box-title"><strong>Editar Competencias Ciudadanas / {{$estudiante->v_nombres.' '.$estudiante->v_apellidos}}</strong></h2>
    </div>
    <div class="col-sm-8" align="right"></div>
  </div>
  <div class="box-body"> 
    <form action="{{route('updateCompetencia')}}" method="POST">

      {{ csrf_field() }}
      <input type="hidden" name="seccion" value="{{ $seccion }}" />
      <input type="hidden" name="periodo" value="{{ $periodo}}" />
      <input type="hidden" name="id" value="{{ $conducta->id}}" />

        <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
            <th>CRITERIO </th>
            <th>PONDERACION</th>
        </thead>
        <tbody>
          <tr >
          	<td>{{$competencias[0]->competencia}}</td >
          <td >
          	{!! Form::select('grado_id',['E'=>'E','MB'=>'MB','B'=>'B'],$conducta->criterio_1,['class'=>'form-control','required','id'=>'cr1','name'=>'cr1'])!!}         	
		  </td>
          </tr>
           <tr >
          	<td>{{$competencias[1]->competencia}}</td >
          <td >
          	{!! Form::select('grado_id',['E'=>'E','MB'=>'MB','B'=>'B'],$conducta->criterio_2,['class'=>'form-control','required','id'=>'cr2','name'=>'cr2'])!!}         	
		  </td>
          </tr>
 <tr >
          	<td>{{$competencias[2]->competencia}}</td >
          <td >
          	{!! Form::select('grado_id',['E'=>'E','MB'=>'MB','B'=>'B'],$conducta->criterio_3,['class'=>'form-control','required','id'=>'cr3','name'=>'cr3'])!!}         	
		  </td>
          </tr>
 <tr >
          	<td>{{$competencias[3]->competencia}}</td >
          <td >
          	{!! Form::select('grado_id',['E'=>'E','MB'=>'MB','B'=>'B'],$conducta->criterio_4,['class'=>'form-control','required','id'=>'cr4','name'=>'cr4'])!!}         	
		  </td>
          </tr>
             <tr >
          	<td>{{$competencias[4]->competencia}}</td >
          <td >
          	{!! Form::select('grado_id',['E'=>'E','MB'=>'MB','B'=>'B'],$conducta->criterio_5,['class'=>'form-control','required','id'=>'cr5','name'=>'cr5'])!!}         	
		  </td>
          </tr>

          <tr >
            <td class="text-center" colspan="2">
              <a href="{{route('ViewCompetenciasteacher',[$seccion,$periodo])}}" class="btn btn-default pull-left">Cancelar</a>
              <button type="submit" class="btn btn-primary pull-right">Editar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </form> 
  </div>
</div>
@endsection