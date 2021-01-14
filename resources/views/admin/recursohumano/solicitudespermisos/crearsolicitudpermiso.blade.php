@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Permisos/Crear solicitud')
@section('content')

  <!-- comienza formulario datos personales -->
  <div class="box box-primary box-solid">
    <div class="box-header with-border">
      <h1 class="box-title">SOLICITUD DE PERMISO</h1>
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
      {!! Form::open(['route'=>'agregarsolicitudespermisorh', 'method'=>'POST','class'=>'form-horizontal']) !!}
      <div class="form-group">                                           
        {!! Form::label('lblfec', 'Fecha solicitud*',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="f_fechasolicitud" value="{{ $hoy }}" class="form-control pull-right nac" readonly="true">
          </div>
        </div>

        </div>

         <div class="form-group">  
        {!! Form::label('exp', 'Expediente *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('expediente',null,['class'=>'form-control pull-right','placeholder'=>'Expediente', 'readonly','id'=>'expediente','required']) !!}
        </div>
      </div>


        <div class="form-group">  
        {!! Form::label('exp', 'NIP *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('nip',null,['class'=>'form-control pull-right','placeholder'=>'Número de Identificaión Personal', 'readonly','id'=>'nip','required']) !!}
        </div>
      </div>




      <div class="form-group">                                           
        {!! Form::label('lbexp', 'Solicitante *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">                                            
          <div class="input-group">
             {!! Form::text('expediente', null, array('placeholder' => 'Número de expediente','class' => 'form-control pull-right','id'=>'search_text','readonly','required')) !!}
             <span class="input-group-btn">
              <a data-toggle="modal" data-target="#listaEmpleados" class="btn btn-primary">Buscar</a>
            </span>
          </div>
        </div>

         </div>
         <div class="form-group"> 
        {!! Form::label('nombre', 'Nombre completo *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::text('nombre',null,['class'=>'form-control pull-right','placeholder'=>'Nombre completo', 'readonly','id'=>'nombre','required']) !!}
        </div>
      </div><!--fin form group-->


         <div class="form-group"> 
        {!! Form::label('lbmotivo', 'Motivo *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::select('motivo_id',$motivos, null,['class'=>'form-control'])!!}
        </div>
      </div>
      <div class="form-group"> 
        {!! Form::label('lblfec', 'Periodo del Permiso *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" name="periodo" class="form-control pull-right rangoPeriodo" readonly="true" required="true">
          </div>
        </div>
         </div>


<div class="form-group">
  <div class="col-sm-4">
   </div>
   <div class="col-sm-5">
  {!! Form::checkbox('duracionhoras', 'duracion', false,['id'=>'super'])!!}
        {!! Form::label('sup', 'La duración del permiso es menor a 1 dia',['class'=>'control-label']) !!}
</div>
</div>

<div class="form-group">
  <div class="col-sm-4">
   </div>
   <div class="col-sm-5">
  {!! Form::checkbox('sinfinesdesemana', 'checksinfinesdesemana', false,['id'=>'sinfindesemana'])!!}
        {!! Form::label('sinfinesdesemana', 'No contar fines de semana',['class'=>'control-label']) !!}
</div>
</div>


      <div class="form-group"> 
        {!! Form::label('lbtiemposolicitado', 'Tiempo solicitado (dias) *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::number('i_tiemposolicitado',null,['class'=>'form-control pull-right','placeholder'=>'Tiempo solicitado','id'=>'dias','required','readonly']) !!}
        </div>
      </div>

<div class="form-group">
      <div id="timepair" class="timepair">
     <label for="lb" class="col-sm-4 control-label">Tiempo solicitado (horas)</label>    
     <div class="col-sm-2">                                       
        <div class="input-group">
          <input type="text" name="txthoraLE" value="" autocomplete="off" class="form-control time start ui-timepicker-input" placeholder="Desde" id="txthoraLE">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>

 <label for="lb" class="col-sm-1 control-label"></label>    
      <div class="col-sm-2">                                      
        <div class="input-group">
          <input type="text" name="txthoraLS" value="" autocomplete="off" class="form-control time end ui-timepicker-input" placeholder="Hasta" id="txthoraLS">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
        </div>
      </div>
      </div>     
    </div>


<div class="form-group">
                    {!! Form::label("lbhoraE","Horas",["class"=>"col-sm-4 control-label"]) !!}
                            <div class="col-sm-2">
                              <div class="input-group">
                                <input type="number" name="i_horas" id="horas" class="form-control pull-right time start" placeholder="Horas" readonly="true">
                                <div class="input-group-addon">
                                  <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                    </div>

                      {!! Form::label("lbhoraS","Minutos",["class"=>"col-sm-1 control-label"]) !!}
                       <div class="col-sm-2">
                             <div class="input-group">
                                <input type="number" name="i_minutos" id="minutos" class="form-control pull-right time end" placeholder="Minutos" readonly="true">
                                <div class="input-group-addon">
                                <i class="fa fa-clock-o"></i>
                                </div>
                              </div>
                            </div>
        </div>                     

<div class="form-group"> 
      {!! Form::label('lbgocesueldo', 'Con goce de sueldo *',['class'=>'col-sm-4 control-label']) !!}
      <div class="col-sm-5">
        {!! Form::label('lbsi', 'Si',['class'=>'col- control-label']) !!}
        <input type="radio" name="v_congocedesueldoSN" class="flat-red" value="S"  checked="checked"  >
        {!! Form::label('lbno', 'No',['class'=>'control-label']) !!}
        <input type="radio" name="v_congocedesueldoSN" class="flat-red" value="N">
      </div>
    </div> 


      <div class="form-group">                                           
        {!! Form::label('direccion', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-5">
          {!! Form::textarea('v_observaciones',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Observaciones']) !!}
        </div>
      </div>
    </div>                   
    <div class="box-footer" align="right">                
      {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
        <a href="{{route('listapermisosrh')}}" class="btn btn-default">Cancelar</a>
    </div>
    {!! Form::close() !!}
    <!-- /.box-footer -->


<div class="modal fade" id="listaEmpleados">
          <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-horizontal" method="GET">
                <div class="modal-header primary">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">NOMINA DE EMPLEADOS</h4>
                </div>
              <div class="modal-body">           
   <div class="box-body table-responsive">
       <table class="table table-bordered table-striped" id="tablaAsistencia">
                <thead>
                 <th>EXPEDIENTE</th> 
                <th>NOMBRES</th>
                <th>APELLIDOS</th>
                <th>ACEPTAR</th>                  
              </thead>
              <tbody>
              
           @foreach($empleados as $empleado)          
              
                   @if($empleado->v_numeroexp!='RH0000-0')
                   <tr>             
                    <td>{{ $empleado->v_numeroexp }}</td>
                    <td>{{ $empleado->v_nombres }}</td>
                    <td>{{ $empleado->v_apellidos }}</td>
                    <td>
                      <a data-type="{{$empleado->v_nombres.' ' .$empleado->v_apellidos}}" data-type2="{{$empleado->v_numeroexp}}" data-type3="{{$empleado->v_nip}}" class="btn btn-primary seleccionarE"><i class="fa fa-check"></i></a>
                    </td>
                  </tr>
                    @endif
                
            @endforeach 
                 
              </tbody>
            </table>
          </div>
        </div>
          </form>
        </div>                
     </div>
     </div> 



  </div>      
@endsection
@section('script')
<script>
$(document).ready(function() {
//Buscador numero expediente rh  
  $('.seleccionarE').on('click', function(){
    $('#search_text').val($(this).data('type2')); 
    $('#nombre').val($(this).data('type')); 
    $('#expediente').val($(this).data('type2'));
    $('#nip').val($(this).data('type3'));
    $('#listaEmpleados').modal('hide');
  }); 

});

$('#sinfindesemana').change(function() {
          if(this.checked) { 
var rango=$('.rangoPeriodo').val(); 
if(rango!=''){
  var rango=rango.split('-');
  var start=rango[0].split('-').reverse().join("/");
  var end=rango[1];
 var diff=workingDays(start,end);
$('#dias').val(diff);
}            
 } 

 });


 $('#super').change(function() {
          if(this.checked) {                  
$('.check').prop('checked', false);              
document.getElementById("dias").readonly = true; 
$('#dias').val('0');
          } 
else
{
 document.getElementById("dias").readonly = false;
 $('#dias').val('0'); 
}
 });
     
$(function () { 
  //Calcular dias solicitados permiso
  $('.rangoPeriodo').on('apply.daterangepicker', function(ev, picker) {
    var start = moment(picker.startDate.format('YYYY-MM-DD'));
    var end   = moment(picker.endDate.format('YYYY-MM-DD'));
       
    if($('#sinfindesemana').checked)
    {
    var diff=workingDays(start,end);//excluir fines de semana para sumar los dias
    }
    else
    {
      var diff = end.diff(start, 'days')+1; // returns correct number 
    }
 $('#dias').val(diff);

  });


  $('.rangoPeriodo').on('cancel.daterangepicker', function(ev, picker) {
      $('#dias').val('');
  });
});

$(function () {
  $('#txthoraLS').on('changeTime', function(ev, picker) {
    var end     = moment($(this).timepicker('getTime', new Date()));
    var start   = moment($("#txthoraLE").timepicker('getTime', new Date()));
    var diff = end.diff(start, 'minutes');
    var hours = Math.floor(diff/60);
    var minutes = diff % 60;

    $('#horas').val(hours);
    $('#minutos').val(minutes);

  });
});

 $('.timepair .time').timepicker({
    'showDuration': true,
    'timeFormat': 'g:i A',
    'step': 10,
    'maxTime':'5:00 PM',
    'minTime':'7:00 AM'
  });

var timeOnlyExampleEl = document.getElementById('timepair');
var timeOnlyDatepair = new Datepair(timeOnlyExampleEl);

//No contar fines de semana 
function workingDays(dateFrom, dateTo) {
  var from = moment(dateFrom, 'DD/MM/YYY'),
    to = moment(dateTo, 'DD/MM/YYY'),
    days = 0;
    
  while (!from.isAfter(to)) {
    // Si no es sabado ni domingo
    if (from.isoWeekday() !== 6 && from.isoWeekday() !== 7) {
      days++;
    }
    from.add(1, 'days');
  }
  return days;
}


</script>
@endsection
