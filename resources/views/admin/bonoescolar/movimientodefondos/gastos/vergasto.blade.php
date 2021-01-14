@extends('admin.menuprincipal')
@section('tittle', 'Bono escolar/Transacciones/Ver gasto')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <div class="col-sm-6">
              <h3 class="box-title"><Strong>VER DETALLE GASTO</Strong></h3>
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
              {!! Form::open(['route'=>'guardargastos', 'method'=>'POST', 'class'=>'form-horizontal']) !!}

                <div class="form-group">
              {!! Form::label('nombre', 'Cheque #',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('numero_cheque',$gasto->numero_cheque,['class'=>'form-control pull-right','placeholder'=>'Número de cheque','required','readonly']) !!}
                </div>
                </div> 
              
             <div class="form-group">   
                 {!! Form::label('fecha', 'Fecha de cheque ',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="fecha_transaccion" value="{{$gasto->fecha_transaccion}}" class="form-control pull-right nac"  required="true" readonly="true">
                </div>
              </div>
             </div> 
              
             <div class="form-group">                                           
           {!! Form::label('nombre', 'En concepto de',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('concepto',$gasto->concepto,['class'=>'form-control pull-right','placeholder'=>'En concepto de','required','readonly']) !!}
                </div>
                </div> 
              
             <div class="form-group"> 
                {!! Form::label('nombre', 'A favor de',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                {!! Form::text('a_favor_de',$gasto->a_favor_de,['class'=>'form-control pull-right','placeholder'=>'A favor de','required','readonly']) !!}
                </div>
              </div>

 <?php if($gasto->rubro_id!=null){ ?>
     <div class="form-group">
      {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
       <div class="col-sm-4">
        <label><input type="checkbox" name="opyfuncionamientoSN" value="" class="checC"  <?php if($gasto->opyfuncionamientoSN=="SI"){?>checked=""<?php }?>>Operación y funcionamiento</label>           
       </div> 
      </div>

       
              <div class="form-group">
                {!! Form::label('rubro', 'Rubro',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-4">
                 {!! Form::select('rubro_id',$rubros,$gasto->rubro_id,['class'=>'form-control','disabled'])!!}
                </div>
              </div> 
        <?php } ?>


             <div class="form-group"> 
                {!! Form::label('descripcion', 'Monto',['class'=>'col-sm-4 control-label']) !!}
                  <div class="col-sm-4">
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" required pattern="[0-9]+" step="any"  name="gasto" min="1" max="{{$saldodisponible}}" value="{{$gasto->gasto}}" class="form-control" readonly="true">
                          </div>
                  </div>
              </div>
            

      
                </div>       
          <div class="box-footer" align="right">              
          <a href="{{route('historialtransacciones')}}" class="btn btn-primary">Regresar</a>
          </div>

          {!! Form::close() !!}
          <!-- /.box-footer -->
          </div>
@endsection
