@extends('admin.menuprincipal')
@section('tittle', 'Administración activo fijo/Traslado de activos')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>AGREGAR TRASLADO</Strong></h3>
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
    {!! Form::open(['route'=>'agregartraslado', 'method'=>'POST','class'=>'form-horizontal']) !!}
    {!! Form::hidden('destino_id',null,['id'=>'destino_id']) !!}
    {!! Form::hidden('procedencia_id',$procedencia->id) !!}
    {!! Form::hidden('activo_id',$activo->id) !!}
     
        <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechatraslado',null,['class'=>'form-control pull-right calendario','data-mask'=>'','placeholder'=>'Fecha de traslado','required']) !!}
            </div> 
          </div> 
           </div><!--fin form group-->       
        <div class="form-group"> 
          {!! Form::label('lbtipoTRASLADO', 'Motivo de traslado',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('tipotraslado_id',$tipotraslado, null,['class'=>'form-control'])!!}
          </div> 
        </div><!--fin form group-->       
        <div class="form-group">                                           
          {!! Form::label('lborigen', 'Origen',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtorigen',$procedencia->v_codigoinfraestructura .' - '.$procedencia->v_nombrecentro,['class'=>'form-control pull-right','placeholder'=>'Origen del activo','readonly']) !!}
          </div>
           </div><!--fin form group-->       
        <div class="form-group"> 
          {!! Form::label('lbdestino', 'Destino',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            <div class="input-group">
              {!! Form::text('txtdestino',null,['class'=>'form-control pull-right','placeholder'=>'Destino del activo','readonly','required','id'=>'destino']) !!}
              <span class="input-group-btn">
                <a data-toggle="modal" data-target="#instituciones" class="btn btn-primary">Buscar</a>
              </span>
            </div>
          </div>                                                                 
        </div>
    
        <div class="form-group">                                           
          {!! Form::label('lbcodigo', 'Código',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtcodigo',$activo->v_codigoactivo,['class'=>'form-control pull-right','placeholder'=>'Código activo','readonly']) !!}
          </div>
           </div><!--fin form group-->       
        <div class="form-group"> 
          {!! Form::label('lbdescrip', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtdescrip',$activo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción','readonly']) !!}
          </div>
        </div>
    
        <div class="form-group">                                           
          {!! Form::label('lbcondicion', 'Condición actual',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_condicionactivo',['Bueno'=>'Bueno','Malo'=>'Malo'], $activo->v_condicionactivo,['class'=>'form-control','disabled'])!!}
          </div>
           </div><!--fin form group-->       
        <div class="form-group"> 
          {!! Form::label('lbserie', 'Serie',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtserie',$activo->v_serie,['class'=>'form-control pull-right','placeholder'=>'Número de serie','readonly']) !!}
          </div>                                                                 
        </div>
    
        <div class="form-group">                                                             
          {!! Form::label('lbmodelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtmodelo',$activo->v_modelo,['class'=>'form-control pull-right','placeholder'=>'Modelo','readonly']) !!}
          </div>
           </div><!--fin form group-->       
        <div class="form-group"> 
          {!! Form::label('lbmarca', 'Marca',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtmarca',$activo->v_marca,['class'=>'form-control pull-right','placeholder'=>'Marca','readonly']) !!}
          </div>
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbpautoriza', 'Autoriza',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_personaautoriza',null,['class'=>'form-control pull-right','placeholder'=>'Persona que autoriza traslado','required']) !!}
          </div>
           </div><!--fin form group-->       
        <div class="form-group"> 
          {!! Form::label('lbrecibe', 'Recibe',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_personarecibe',null,['class'=>'form-control pull-right','placeholder'=>'Persona que recibe','required']) !!}
          </div>
        </div>
      
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones','']) !!}
          </div>
        </div>
      </div>                                                       
       
      <div class="box-footer" align="right">                
        {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
        <a href="{{route('activofijo')}}" class="btn btn-default">Cancelar</a>
      </div>
    {!! Form::close() !!}
    <!-- /.box-footer -->
    <div class="modal fade" id="instituciones">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">BUSCAR INSTITUCION DESTINO</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered table-striped" id="tablaBusqueda">
              <thead>
                <th>CODIGO</th> 
                <th>NOMBRE</th>
                <th>DIRECCION</th>
                <th>TELEFONO</th>
                <th>ACEPTAR</th>
              </thead>
              <tbody>
                @foreach($destinos as $destino)          
                  <tr>            
                    <td>{{ $destino->codigo_institucion }}</td>
                    <td>{{ $destino->nombre_institucion }}</td>
                    <td>{{ $destino->direccion }}</td>
                    <td>{{ $destino->telefono }}</td>
                    <td>
                      <a data-type="{{$destino->codigo_institucion. ' ' .$destino->nombre_institucion}}" data-type2="{{$destino->id}}" class="btn btn-primary seleccionarI"><i class="fa fa-check"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('script')
<script>
$(document).ready(function() {

//Seleccionar Institucion  
  $('.seleccionarI').on('click', function(){
    $('#destino_id').val($(this).data('type2')); 
    $('#destino').val($(this).data('type')); 
    $('#instituciones').modal('hide');
  }); 

});

</script>
@endsection