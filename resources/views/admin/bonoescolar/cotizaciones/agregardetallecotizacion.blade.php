
@extends('admin.menuprincipal')
@section('tittle', 'Administración bono escolar/Cotizacion')
@section('content')
<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>DETALLE COTIZACION</Strong></h3>
            </div>
<div class="box-body">
       {!! Form::open(['route'=>['guardardetallecotizacion',$id], 'method'=>'POST','class'=>'form-horizontal']) !!}

    
                <!--div class="form-group">                                           
                                  {!! Form::label('fecha', 'Fecha de elaboración',['class'=>'col-sm-2 control-label']) !!}
                                    <div class="col-sm-4"> 
                                    <div class="input-group date">
                                    <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              {!! Form::text('f_fechaelaboracion',$datoscotizacion->f_fechaelaboracion,['class'=>'form-control pull-right calendario','placeholder'=>'Fecha de elaboración','readonly']) !!}
                                              </div> 
                                    </div> 
                                      </div> 
                                    <div class="form-group">

                                    {!! Form::label('fecha', 'Fecha de entrega',['class'=>'col-sm-2 control-label']) !!}
                                            <div class="col-sm-4"> 
                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              {!! Form::text('f_fecharecepcion',$datoscotizacion->f_fecharecepcion,['class'=>'form-control pull-right calendario','placeholder'=>'Fecha de entrega','readonly']) !!}
                                              </div> 
                                              </div> 
                                              
                </div>
     
                 <div class="form-group"> 

                        {!! Form::label('numcotizacion', 'Cotización #',['class'=>'col-sm-2 control-label']) !!}
                                                                                        
                        <div class="col-sm-4">
                       {!! Form::text('v_numerocotizacion',$datoscotizacion->v_numerocotizacion,['class'=>'form-control pull-right','placeholder'=>'Número de cotización','required','readonly']) !!}
                     </div>                                               
                                                                    
                        
              </div>
           
            <div class="form-group">                                           
                                                {!! Form::label('', 'Descripción',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::textarea('v_descripcion',$datoscotizacion->v_descripcion,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Descripción de la cotización ','readonly']) !!}
                                                </div>
                </div>
           
            <div class="form-group">                                           
                                                {!! Form::label('', 'Lugar de entrega',['class'=>'col-sm-2 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('v_lugarentrega',$datoscotizacion->v_lugarentrega,['class'=>'form-control pull-right','placeholder'=>'Lugar de la entrega','readonly']) !!}
                                                </div>


                                                
                </div-->
           
        

            <div class="form-group">                                                       
               {!! Form::label('', 'Producto',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::text('v_producto',null,['class'=>'form-control pull-right','placeholder'=>'Descripción del producto','required']) !!}
                 </div>
                 </div>
                 <div class="form-group">
                 {!! Form::label('', 'Cantidad',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::text('d_cantidad',null,['class'=>'form-control pull-right','placeholder'=>'Cantidad','required']) !!}
                 </div>
                    </div>
                 
            
            <div class="form-group">                                       
               {!! Form::label('', 'Precio',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-4">
                  <div class="input-group">
                                            <div class="input-group-addon">
                                                  <i class="fa fa-dollar"></i>
                                            </div>               
                {!! Form::text('d_preciounitario',null,['class'=>'form-control pull-right','placeholder'=>'Precio  ','required']) !!}
                 </div>
             </div>
   </div>
                 <div class="form-group">
                 {!! Form::label('lbmedida', 'Unidad de medida',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-2">
                         {!! Form::select('v_unidaddemedida',['UNIDAD'=>'Unidad','PAQUETE'=>'Paquete','METRO'=>'Metro','CENTIMETRO'=>'Centímetro','LIBRA'=>'Libra','OTRO'=>'Otros'], null,['class'=>'form-control'])!!}
                          </div>
                          <div class="col-sm-2">
                             {!! Form::submit('Agregar',['class'=>'btn btn-success']) !!}
                             
                          </div>                         
                </div>

                <!--div class="form-group">
                 <div class="col-sm-4">
                   
                 </div>
                          <div class="col-sm-4">
                             {!! Form::submit('Agregar',['class'=>'btn btn-success']) !!}
                             
                          </div>
                </div-->
             {!! Form::close() !!}                
            <div class="box-body table-responsive ">
              <table class="table table-bordered table-striped" id="" >
                <thead style="color: white; background-color: #3c8dbc">
                  <th>PRODUCTO</th>
                  <th>CANTIDAD</th>
                  <th>PRECIO UNITARIO $</th>
                  <th>TOTAL $</th> 
                  <th>ACCION</th>
                </thead>
                 <tbody>
                 @foreach($cotizaciondetalle as $cotizaciondetalle)                  
                  <tr>          
                  <td>{{$cotizaciondetalle->v_producto}}</td>
                  <td>{{$cotizaciondetalle->d_cantidad}}</td>
                  <td>{{$cotizaciondetalle->d_preciounitario}}</td>
                  <td>{{$cotizaciondetalle->d_cantidad * $cotizaciondetalle->d_preciounitario}}</td>
                  <td> 
                 <a class="btn btn-danger" data-toggle="modal" title="Eliminar" data-target="#cotizacion_{{$cotizaciondetalle->id}}">
                  <i class="fa fa-close"></i>
                </a>
                <div class="modal fade" id="cotizacion_{{$cotizaciondetalle->id}}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Confirmar Eliminación</h4>
                      </div>
                      <div class="modal-body">
                      <p>¿Está seguro, desea eliminar  {{$cotizaciondetalle->v_producto}} de la lista?</p>
                      </div>
                      <div class="modal-footer">
          <form method="GET" action="{{route('borrardetallecotizacion',$cotizaciondetalle->id)}}">
                          <input type="hidden" name="id" value="{{$cotizaciondetalle->id}}">
                          <input type="submit" value="Eliminar" class="btn btn-sm btn-danger delete-btn">                               
                          <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                </td>
                   </tr>                  
                @endforeach
                
              </tbody>
            </table>
            </div>          
       

<div class="box-footer" align="right">                
   <div class="col-sm-12">
      <!--a href="{{route('listacotizaciones')}}" class="btn btn-danger"> Imprimir</a>
      <a href="{{route('listacotizaciones')}}" class="btn btn-warning"> Exportar</a-->
      <a href="{{route('listacotizaciones')}}" class="btn btn-primary">Finalizar</a>
   </div>
  </div>

                
      </div>
  </div>
  @endsection()
 