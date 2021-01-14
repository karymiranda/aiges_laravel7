@extends('admin.menuprincipal')
@section('tittle', 'Administración activo fijo/Traslados')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>ACTUALIZAR TRASLADO</Strong></h3>
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
    {!! Form::open(['route'=>['actualizartraslado',$traslado->id], 'method'=>'PUT','class'=>'form-horizontal']) !!}
    {!! Form::hidden('destino_id',$traslado->destino_id,['id'=>'destino_id']) !!}
    {!! Form::hidden('procedencia_id',$traslado->procedencia_id) !!}
    {!! Form::hidden('activo_id',$traslado->activo_id,['id'=>'activo_id']) !!}
      
        <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechatraslado',$traslado->f_fechatraslado,['class'=>'form-control pull-right calendario','data-mask'=>'','placeholder'=>'Fecha de traslado','required']) !!}
            </div> 
          </div>
           </div>
    
        <div class="form-group"> 
          {!! Form::label('lbtipoTRASLADO', 'Motivo de traslado',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('tipotraslado_id',$tipotraslado, $traslado->tipotraslado_id,['class'=>'form-control'])!!}
          </div> 
        </div><!--fin form group-->
    
        <div class="form-group">                                           
          {!! Form::label('lborigen', 'Origen',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtorigen',$traslado->procedencia->v_codigoinfraestructura .' - '.$traslado->procedencia->v_nombrecentro,['class'=>'form-control pull-right','placeholder'=>'Origen del activo','readonly']) !!}
          </div>
           </div>
    
        <div class="form-group">
          {!! Form::label('lbdestino', 'Destino',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            <div class="input-group">
              {!! Form::text('txtdestino',$traslado->destino->codigo_institucion .' '. $traslado->destino->nombre_institucion,['class'=>'form-control pull-right','placeholder'=>'Destino del activo','readonly','required','id'=>'destino']) !!}
              <span class="input-group-btn">
                <a data-toggle="modal" data-target="#instituciones" class="btn btn-primary">Buscar</a>
              </span>
            </div>
          </div>                                                                 
        </div>
    
        <div class="form-group">                                           
          {!! Form::label('lbcodigo', 'Código',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            <div class="input-group">
              {!! Form::text('txtcodigo',$traslado->activofijo->v_codigoactivo,['class'=>'form-control pull-right','placeholder'=>'Código activo','readonly','id'=>'codigo']) !!}
              <span class="input-group-btn">
                <a data-toggle="modal" data-target="#activos" class="btn btn-primary">Buscar</a>
              </span>
            </div>
          </div>
           </div>
    
        <div class="form-group">
          {!! Form::label('lbdescrip', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtdescrip',$traslado->activofijo->v_nombre,['class'=>'form-control pull-right','placeholder'=>'Descripción','readonly','id'=>'descripcion']) !!}
          </div>
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbcondicion', 'Condición actual',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::select('v_condicionactivo',['Bueno'=>'Bueno','Malo'=>'Malo'], $traslado->activofijo->v_condicionactivo,['class'=>'form-control','disabled','id'=>'condicion'])!!}
          </div>
           </div>
    
        <div class="form-group">
          {!! Form::label('lbserie', 'Serie',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtserie',$traslado->activofijo->v_serie,['class'=>'form-control pull-right','placeholder'=>'Número de serie','readonly','id'=>'serie']) !!}
          </div>                                                                 
        </div>
     
        <div class="form-group">                                                             
          {!! Form::label('lbmodelo', 'Modelo',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtmodelo',$traslado->activofijo->v_modelo,['class'=>'form-control pull-right','placeholder'=>'Modelo','readonly','id'=>'modelo']) !!}
          </div>
           </div>
    
        <div class="form-group">
          {!! Form::label('lbmarca', 'Marca',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('txtmarca',$traslado->activofijo->v_marca,['class'=>'form-control pull-right','placeholder'=>'Marca','readonly','id'=>'marca']) !!}
          </div>
        </div>
     
        <div class="form-group">                                           
          {!! Form::label('lbpautoriza', 'Autoriza',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_personaautoriza',$traslado->v_personaautoriza,['class'=>'form-control pull-right','placeholder'=>'Persona que autoriza traslado','required']) !!}
          </div>
           </div>
    
        <div class="form-group">
          {!! Form::label('lbrecibe', 'Recibe',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::text('v_personarecibe',$traslado->v_personarecibe,['class'=>'form-control pull-right','placeholder'=>'Persona que recibe','required']) !!}
          </div>
        </div>
    
        <div class="form-group"> 
          {!! Form::label('lbobserv', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
            {!! Form::textarea('v_observaciones',$traslado->v_observaciones,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones']) !!}
          </div>
        </div>
      </div>                                                       
      <div class="box-footer" align="right">                
        {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
        <a href="{{route('listatraslado')}}" class="btn btn-default">Cancelar</a>
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
    <div class="modal fade" id="activos">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">BUSCAR ACTIVO</h4>
          </div>
          <div class="modal-body">
            <table class="table table-bordered table-striped" id="tablaBusqueda">
              <thead>
                <th>CODIGO</th> 
                <th>CLASIFICACION</th>
                <th>DESCRIPCION</th>
                <th>ACEPTAR</th>
              </thead>
              <tbody>
                @foreach($activos as $activo)          
                  <tr>            
                    <td>{{ $activo->v_codigoactivo }}</td>
                    <td>{{ $activo->cuentacatalogo->v_nombrecuenta }}</td>
                    <td>{{ $activo->v_nombre }}</td>
                    <td>
                      <a data-type="{{$activo->id}}" data-type2="{{$activo->v_codigoactivo}}/{{$activo->v_nombre}}/{{$activo->v_condicionactivo}}/ {{$activo->v_serie}}/ {{$activo->v_modelo}}/ {{$activo->v_marca}}" class="btn btn-primary seleccionarA"><i class="fa fa-check"></i></a>
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

//Seleccionar Activo
  $('.seleccionarA').on('click', function(){
    $('#codigo').val('');
    $('#descripcion').val('');
    $('#condicion').val('');
    $('#serie').val('');
    $('#modelo').val('');
    $('#marca').val('');
    var datoactivo=$(this).data('type2').split('/');
    $('#activo_id').val($(this).data('type')); 
    $('#codigo').val(datoactivo[0]);
    $('#descripcion').val(datoactivo[1]);
    $('#condicion').val(datoactivo[2]);
    $('#serie').val(datoactivo[3]);
    $('#modelo').val(datoactivo[4]);
    $('#marca').val(datoactivo[5]);
    $('#activos').modal('hide');
  });

});

</script>
@endsection