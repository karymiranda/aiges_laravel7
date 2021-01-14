@extends('admin.menuprincipal')
@section('tittle', 'Administración bono escolar/Cotizaciones')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header">
              <h3 class="box-title"><Strong>AGREGAR COTIZACION</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                 {!! Form::open(['route'=>'guardarcotizacion', 'method'=>'POST','class'=>'form-horizontal']) !!}

 
                <div class="form-group">                                           
                                  {!! Form::label('fecha', 'Fecha de elaboración',['class'=>'col-sm-4 control-label']) !!}
                    <div class="col-sm-4"> 
                      <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                                              </div>
                                     
                                   {!! Form::text('f_fechaelaboracion',$fecha,['class'=>'form-control pull-right calendario','placeholder'=>'Fecha de elaboración','required']) !!}
                                              </div> 
                          
                              </div>

                              </div>

                <div class="form-group">
                                    {!! Form::label('fecha', 'Fecha de entrega',['class'=>'col-sm-4 control-label']) !!}
                     <div class="col-sm-4"> 
                              <div class="input-group date">                                        <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              {!! Form::text('f_fecharecepcion',$fecha,['class'=>'form-control pull-right calendario','placeholder'=>'Fecha de entrega','required']) !!}
                                              </div> 
                                              </div> 
                                              
                </div><!--fin form group-->
          
 
         

             
                 <div class="form-group"> 

                        {!! Form::label('numcotizacion', 'Cotización #',['class'=>'col-sm-4 control-label']) !!}
                                                                                        
                        <div class="col-sm-4">
                       {!! Form::text('v_numerocotizacion','COT'.$correlativo,['class'=>'form-control pull-right','placeholder'=>'Número de cotización','required','readonly']) !!}
                     </div>                                               
                                                                    
                        
              </div>
         
           
            <div class="form-group">                                           
                        {!! Form::label('', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
                    <div class="col-sm-4">
                    {!! Form::textarea('v_descripcion',null,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Descripción de la cotización ','required']) !!}
                                                </div>
                </div>
            
                           <div class="form-group">                                           
                                                {!! Form::label('', 'Lugar de entrega',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('v_lugarentrega',null,['class'=>'form-control pull-right','placeholder'=>'Lugar de la entrega','required']) !!}
                                                </div>

                                                
                </div>
         


                
                                                   
          </div> 
      
             <div class="box-footer" align="center">                
                  <div class="col-sm-12">
                     {!! Form::submit('Ingresar detalle cotización >>',['class'=>'btn btn-primary ']) !!}
                 
                </div>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
          </div>
        </div>

@endsection
