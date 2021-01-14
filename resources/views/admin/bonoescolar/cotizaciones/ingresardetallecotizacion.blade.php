
@extends('admin.menuprincipal')
@section('tittle', 'Administración bono escolar/Cotizacion')
@section('content')



<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>Detalle cotización</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
<div class="box-body">

  {!! Form::open(['route'=>['guardardetallecotizacion',$id], 'method'=>'POST','class'=>'form-horizontal']) !!}

			<div class="col-sm-12">
            <div class="form-group"> 
                                                      
               {!! Form::label('', 'Producto',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::text('v_producto',null,['class'=>'form-control pull-right','placeholder'=>'Descripción del producto','']) !!}
                 </div>
                 {!! Form::label('', 'Cantidad',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-2">
                {!! Form::text('d_cantidad',null,['class'=>'form-control pull-right','placeholder'=>'Cantidad  ','']) !!}
                 </div>
                 
                          <div class="col-sm-1">
                             {!! Form::submit('Agregar',['class'=>'btn btn-success']) !!}
                             
                          </div>
                </div>
              </div>

               <div class="col-sm-12">
            <div class="form-group">                                          
               {!! Form::label('', 'Precio',['class'=>'col-sm-2 control-label']) !!}
                <div class="col-sm-4">
                  <div class="input-group">
                                                  <div class="input-group-addon">
                                                  <i class="fa fa-dollar"></i>
                                                  </div>               
                {!! Form::text('d_preciounitario',null,['class'=>'form-control pull-right','placeholder'=>'Precio  ','']) !!}
                 </div>
             </div>

                 {!! Form::label('lbmedida', 'Unidad de medida',['class'=>'col-sm-2 control-label']) !!}
                         <div class="col-sm-2">
                         {!! Form::select('v_unidaddemedida',['UNIDAD'=>'Unidad','PAQUETE'=>'Paquete','METRO'=>'Metro','CENTIMETRO'=>'Centímetro','LIBRA'=>'Libra','OTRO'=>'Otros'], null,['class'=>'form-control'])!!}
                          </div>
                         
                </div>
              </div>


                   
            <div class="box-body table-responsive ">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
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
                        <p>¿Está seguro, desea eliminar {{$cotizaciondetalle->v_producto}} de la lista?</p>
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
             
          </div>        

				<div class="box-footer" align="right">                
                  <div class="col-sm-12">
<a href="{{route('listacotizaciones')}}" class="btn btn-primary">Finalizar</a>
                 
                </div>
              </div>


                {!! Form::close() !!}
                
      </div>
  </div>
  @endsection()
