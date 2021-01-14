@extends('admin.menuprincipal')
@section('tittle', 'Administración bono escolar')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ACTUALIZAR COTIZACION</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                 {!! Form::open(['route'=>['actualizarcotizacion',$cotizacion->id], 'method'=>'PUT','class'=>'form-horizontal']) !!}


                 <div class="col-sm-12">
                <div class="form-group">                                           
                                  {!! Form::label('fecha', 'Fecha de elaboración',['class'=>'col-sm-4 control-label']) !!}
                                            <div class="col-sm-4"> 
                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              {!! Form::text('f_fechaelaboracion',$cotizacion->f_fechaelaboracion,['class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>'Fecha de elaboración','required']) !!}
                                              </div> 
                                    </div> 
                                    
                                     </div> 
                                    <div class="form-group">

                                    {!! Form::label('fecha', 'Fecha de entrega',['class'=>'col-sm-4 control-label']) !!}
                                            <div class="col-sm-4"> 
                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              {!! Form::text('f_fecharecepcion',$cotizacion->f_fecharecepcion,['class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>'Fecha de entrega','required']) !!}
                                              </div> 
                                              </div> 
                                              
                </div><!--fin form group-->
              </div><!--fin col 12-->
 
         

              <div class="col-sm-12">
                 <div class="form-group"> 

                        {!! Form::label('numcotizacion', 'Cotización #',['class'=>'col-sm-4 control-label']) !!}
                                                                                        
                        <div class="col-sm-4">
                       {!! Form::text('v_numerocotizacion',$cotizacion->v_numerocotizacion,['class'=>'form-control pull-right','placeholder'=>'Número de cotización','required','readonly']) !!}
                     </div>                                               
                                                                    
                        
              </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">                                           
                                                {!! Form::label('', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::textarea('v_descripcion',$cotizacion->v_descripcion,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Descripción de la cotización  ','']) !!}
                                                </div>
                </div>
              </div>

               <div class="col-sm-12">
            <div class="form-group">                                           
                                                {!! Form::label('', 'Lugar de entrega',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('v_lugarentrega',$cotizacion->v_lugarentrega,['class'=>'form-control pull-right','placeholder'=>'Lugar de la entrega','']) !!}
                                                </div>
                                              </div>

                                              <div class="form-group"> 
                                                {!! Form::label('', 'Estado de entrega',['class'=>'col-sm-4 control-label']) !!}
                                                 <div class="col-sm-4">
                  <div class="radio">
                    <label>
                      <input type="radio" name="v_estadoentrega" id="optionsRadios1" value="pendiente" checked="">
                      Pendiente
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="v_estadoentrega" id="optionsRadios2" value="finalizada">
                      Finalizada
                    </label>
                  </div>
                  
                </div>
                                              </div>


                                                
                
              </div>


                                                   
          </div> 
             <div class="box-footer" align="right">                
                  {!! Form::submit('Siguiente',['class'=>'btn btn-primary ']) !!}
                 
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
          </div>
@endsection
