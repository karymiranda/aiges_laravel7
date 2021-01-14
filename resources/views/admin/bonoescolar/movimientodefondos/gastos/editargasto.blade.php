@extends('admin.menuprincipal')
@section('tittle', 'Bono escolar/Transacciones/Actualizar gasto')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <div class="col-sm-6">
              <h3 class="box-title"><Strong>ACTUALIZAR GASTO</Strong></h3>
            </div>
            <div class="col-sm-6" align="right">
              <h2 class="box-title">
          <div <?php if($gasto->opyfuncionamientoSN=="NO"){ ?> hidden="true" <?php } ?> id="divsaldobanco">
                <span class="label label-success">Saldo disponible $ {{$saldobono}}</span>
          </div>

          <div <?php if($gasto->opyfuncionamientoSN=="SI"){ ?> hidden="true" <?php } ?> id="divsaldobono">
                <span class="label label-success">Saldo disponible $ {{$saldobanco}}</span>
          </div> 
              </h2>
            </div>  
            </div>       
            
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
              {!! Form::open(['route'=>'actualizargastos', 'method'=>'PUT', 'class'=>'form-horizontal','id'=>'formulario']) !!}
    <input type="hidden"  id="saldobanco" value="{{$saldobanco}}"> 
    <input type="hidden" id="saldobono" value="{{$saldobono}}">  
    <input type="hidden" name="id" id="id" value="{{$gasto->id}}">

                <div class="form-group">
                	{!! Form::label('nombre', 'Cheque #',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('numero_cheque',$gasto->numero_cheque,['class'=>'form-control pull-right','placeholder'=>'Número de cheque','required']) !!}
                </div> 
                 </div> 
 
             <div class="form-group"> 
                 {!! Form::label('fecha', 'Fecha de cheque ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="fecha_transaccion" value="{{$gasto->fecha_transaccion}}" class="form-control pull-right nac"  required="true">
                </div>
              </div>             
          </div> 
 
             <div class="form-group">                                           
             {!! Form::label('nombre', 'En concepto de',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('concepto',$gasto->concepto,['class'=>'form-control pull-right','placeholder'=>'En concepto de','required']) !!}
                </div>
                 </div> 
 
             <div class="form-group">
                {!! Form::label('nombre', 'A favor de',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('a_favor_de',$gasto->a_favor_de,['class'=>'form-control pull-right','placeholder'=>'A favor de','required']) !!}
                </div>
              </div>

     <div class="form-group">
      {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
       <div class="col-sm-4">
        <label><input type="checkbox" name="opyfuncionamientoSN"  id="checkbono"  <?php if($gasto->opyfuncionamientoSN=="SI"){?>checked="" value="SI" <?php }?>>Operación y funcionamiento</label>           
       </div> 
      </div>

   
        <div <?php if($gasto->opyfuncionamientoSN=="NO"){ ?> hidden="true" <?php } ?> id="divrubro">
              <div class="form-group" >
                {!! Form::label('rubro', 'Rubro',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('rubro_id',$rubros,$gasto->rubro_id,['class'=>'form-control'])!!}
                </div>
              </div> 
         </div> 
 
 
             <div class="form-group">
                {!! Form::label('descripcion', 'Monto',['class'=>'col-sm-4 control-label']) !!}
                  <div class="col-sm-4">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" required pattern="[0-9]+" step="any"  name="gasto" min="1" <?php if($gasto->opyfuncionamientoSN=="NO"){ ?> max="{{$saldobanco}}" <?php } else{ ?> max="{{$saldobono}}"<?php } ?> value="{{$gasto->gasto}}" class="form-control" id="monto">
                          </div>
                  </div>
              </div>
            

      
                </div>       
          <div class="box-footer" align="right">                  
          {!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}             
          <a href="{{route('historialtransacciones')}}" class="btn btn-default">Cancelar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection
@section('script')
 <script>
 
$(document).ready(function(){

  $('#checkbono').change(function(event) {

 /* event.preventDefault();
  console.log( $('#saldo').serialize() );*/

          if(this.checked) { 
            $('#divrubro').prop('hidden', false);
            $('#divsaldobono').prop('hidden', true);
            $('#divsaldobanco').prop('hidden', false); 
            $('#monto').prop('max',$('#saldobono').val());
          
           // var mon=$('#saldobono').val();
           // alert(mon);   

          }
          if(!this.checked) {            
               $('#divrubro').prop('hidden', true);
                $('#divsaldobanco').prop('hidden', true);
                $('#divsaldobono').prop('hidden', false);
               //  document.getElementById("saldodisponible").value =$('#saldobanco').val(); 
                $('#monto').prop('max',$('#saldobanco').val());          
          }       
      });
     
 });
 </script>
 @endsection


