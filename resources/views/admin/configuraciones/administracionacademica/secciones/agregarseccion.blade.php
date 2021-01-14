@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Secciones')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>REGISTRAR SECCION</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
     @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif 
       
              <div class="box-body">

                 {!! Form::open(['guardarseccion', 'method'=>'POST', 'class'=>'form-horizontal']) !!}

                            <div class="form-group">
                          {!! Form::label('grado', 'Grado *',['class'=>'col-sm-4 control-label']) !!}
                          <div class="col-sm-4">
                          {!! Form::select('grado_id',$grados,null,['class'=>'form-control','required'])!!}
                          </div> 
                          </div>
                          
                            <div class="form-group">                                           
                                                {!! Form::label('seccion', 'Sección *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('seccion',null,['class'=>'form-control pull-right','placeholder'=>'A','required']) !!}
                                                </div>
                             </div>
                             <div class="form-group">
                                                                    
                                              {!! Form::label('seccion', 'Código * ',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('codigo',null,['class'=>'form-control pull-right','placeholder'=>'Código sección para plantillas SIGES']) !!}
                                                </div>
                            </div>

                             <div class="form-group">
                                                                    
                                              {!! Form::label('seccion', 'Descripción *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('descripcion',null,['class'=>'form-control pull-right','placeholder'=>'ejemplo: PRIMERO A ','required']) !!}
                                                </div>
                            </div> 
                             <div class="form-group">                                           
                                                {!! Form::label('cupomaximo', 'Cupo máximo *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('cupo_maximo',null,['class'=>'form-control pull-right','placeholder'=>'Cupo máximo','required']) !!}
                                                </div>
                                                 </div>
                             
                             <div class="form-group">                    
                              {!! Form::label('seccion', 'Ubicación *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('aula_ubicacion',null,['class'=>'form-control pull-right','placeholder'=>'ejemplo: AULA 1-1 LOCAL 1 ','required']) !!}
                                                </div>
                            </div> 

                          
                          <div class="form-group">
                          {!! Form::label('grado', 'Turnos *',['class'=>'col-sm-4 control-label']) !!}
                          <div class="col-sm-4">
                          {!! Form::select('turno_id',$turnos,null,['class'=>'form-control','required'])!!}
                          </div> 
                          </div>

        <div class="form-group">
                          {!! Form::label('nivel', 'Nivel *',['class'=>'col-sm-4 control-label']) !!}
                          <div class="col-sm-4">
                          {!! Form::select('nivel',['0'=>'0','1'=>'1','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9'],null,['class'=>'form-control','required'])!!}
                          </div> 
         </div>


         <div class="form-group">                                           
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
          {!! Form::checkbox('seccionintegrada', '0',false,['id'=>'super'])!!}
          {!! Form::label('lb', 'Es sección integrada',['class'=>'control-label']) !!}<br> 
          </div> 
          </div>
                           <div class="form-group">
                          {!! Form::label('asesor', 'Asesor de sección *',['class'=>'col-sm-4 control-label']) !!}
                          <div class="col-sm-4">
                          {!! Form::select('empleado_id',$asesor,null,['class'=>'form-control','placeholder'=>'Sin asignar','id'=>'empleado_id'])!!}
                          </div> 
                           </div>
                             
                             <div class="form-group">
                               <div class="col-sm-4">
                                 
                               </div>
                            <div class="col-sm-3">
                               <a href="" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Lista de asesores por sección</a>
                            </div>
                          </div>

          </div>
         
                
              <div class="box-footer" align="right">                
                 {!! Form::submit('Registrar',['class'=>'btn btn-primary']) !!}
                  <a href="{{route('listasecciones')}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->


              <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">ASIGNACION DE ASESORES POR SECCION</h4>
              </div>
              <div class="modal-body">
                <form class="form-horizontal" method="POST">

                  <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                  <th>GRADO</th>
                  <th>SECCION</th>                                                
                  <th>TURNO</th>
                  <th>ASESOR</th>
                
              </thead>
              <tbody>
                @foreach($listasecciones as $listasecciones)
                <tr> 
                  <td>{{$listasecciones->seccion_grado->grado}}</td>
                   <td>{{$listasecciones->seccion}}</td>
                   <td>{{$listasecciones->seccion_turno->turno}}</td>
                    @if($listasecciones->seccion_empleado==null) 
                 <td><span class="label label-warning">Sin asignar</span></td> 
                   @endif 
                @if($listasecciones->seccion_empleado!=null) 
                 <td>{{$listasecciones->seccion_empleado->v_nombres}} {{$listasecciones->seccion_empleado->v_apellidos}}</td>
                   @endif                    
                </tr>
               @endforeach
              </tbody>
            </table>
            </div>                 

                </form>
               
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->            
          </div>
@endsection
@section('script')
<script>
   $('#super').change(function() {
    //alert('cambio');

if(this.checked) {
 $('#empleado_id').empty();
$('#empleado_id').append('<option value="'+ '' +'" >'+ 'Sin asignar' +'</option>');
$.get('asesorseccionintegrada',function(asesor){
  $(asesor).each(function (key,value){   
$('#empleado_id').append('<option value="'+value.id+'" >'+value.nombrecompleto+'</option>');
  });
});
//fin 
$('.check').prop('checked', false);
          }  
else{
  $('#empleado_id').empty();
$('#empleado_id').append('<option value="'+ '' +'" >'+ 'Sin asignar' +'</option>');
$.get('asesorseccionnormal',function(asesor){
  $(asesor).each(function (key,value){   
$('#empleado_id').append('<option value="'+value.id+'" >'+value.nombrecompleto+'</option>');
  });
});
//fin
}    
      });
</script>
@endsection