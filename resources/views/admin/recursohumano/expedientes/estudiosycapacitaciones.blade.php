@extends('admin.menuprincipal')
@section('tittle','Administración de Recurso Humano/Formación')
@section('content')
<div class="box box-primary">
      <div class="box-header with-border box-solid">
          <div class="col-sm-8">
              <h3 class="box-title"><Strong>ESTUDIOS Y CAPACITACIONES </Strong></h3>
          </div>
      </div>
<div class="box-body">
  {!! Form::open(['method'=>'GET','id'=>'form_principal','class'=>'form-horizontal']) !!}
   <input type="hidden" name="empleado_id" id="empleado_id" value="{{$exp->id}}">
  

<div class="form-group"> 
          {!! Form::label('expest', 'Empleado',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                  {!! Form::text('txt_empleado',$exp->v_nombres.' '.$exp->v_apellidos ,['class'=>'form-control pull-right','placeholder'=>'Empleado ','readonly']) !!}
                                                </div>

                                                <div class="col-sm-4">                                             
                                                <div class="input-group input-group">
                                                  <span class="input-group-btn">
                                                        <a href="{{ route('agregarestudios',$exp->id) }}" class="btn btn-primary" id="btn_familiares">Registrar estudio</a>
                                                      </span>
                                                </div>
                                                </div>
                                               
    </div>
{!! Form::close() !!}

   <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
           <th>No.</th>  
          <th>TIPO DE ESTUDIO / CAPACITACION</th> 
          <th>INSTITUCION</th>
          <th>TITULO OBTENIDO</th>          
          <th>INICIO</th> 
          <th>FINALIZACION</th>
          <th>OBSERVACIONES</th>                  
          <th>ACCIONES</th>
        </thead>
        <tbody>
        	@foreach($estudio as $key => $estudio)  
                  
            <tr>
            <td>{{$key+1 }}</td>              
              <td>{{ $estudio->tipoestudio }}</td>
              <td>{{ $estudio->institucion }}</td>
              <td>{{ $estudio->titulo }}</td>
              <td>{{ $estudio->anioinicio}}</td>
              <td>{{ $estudio->aniofin}}</td>
              <td>{{ $estudio->observaciones}}</td>
              <td>
                <a href="{{route('editarestudios',$estudio->id)}}" title="Editar" class="btn btn-primary" ><i class="fa fa-edit"></i></a>
              </td>
              <tr>
             @endforeach
        </tbody>
      </table>
   </div>

<div class="box-footer" align="right">                
      <a href="{{ route('listaexpedientesrh') }}" class="btn btn-default">Finalizar</a>
 </div>

 </div>
  </div>
 @endsection