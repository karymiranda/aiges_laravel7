
@extends('admin.menuprincipal')
@section('tittle', 'Administración bono escolar')
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
                         {!! Form::select('v_unidaddemedida',['U'=>'Unidad','P'=>'Paquete','M'=>'Metro','C'=>'Centímetro','L'=>'Libra','O'=>'Otros'], null,['class'=>'form-control'])!!}
                          </div>
                         
                </div>
              </div>


                   
            <div class="box-body table-responsive ">
              <table class="table table-hover table-bordered">
                <thead>
                  <th>PRODUCTO</th>
                  <th>CANTIDAD</th>
                  <th>UNIDAD DE MEDIDA</th>
                  <th>PRECIO UNITARIO</th>
                  <th>TOTAL</th> 
                  <th>ACCION</th>
                </thead>
                <tbody>
                   @foreach($recupdetallecotizacion as $recupdetallecotizacion)             
                  <tr>          
                  <td>{{$recupdetallecotizacion->v_producto}}</td>
                  <td>{{$recupdetallecotizacion->d_cantidad}}</td>
                  <td>{{$recupdetallecotizacion->v_unidaddemedida}}</td>
                  <td>{{$recupdetallecotizacion->d_preciounitario}}</td>
                  <td>{{$recupdetallecotizacion->d_cantidad * $recupdetallecotizacion->d_preciounitario}}</td>
                  <td> 
                <a href="{{route('borrardetallecotizacion',$recupdetallecotizacion->id)}}" onclick=" return confirm('Seguro que deseas eliminar este item de la lista?')"  class="btn btn-danger"><i class="fa fa-close"></i></a></td>
                   </tr>                  
              @endforeach()
              </tbody>
            </table>
            </div>



              <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
                
                </ul>
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
