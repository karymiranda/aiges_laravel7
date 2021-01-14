@extends('admin.menuprincipal')
@section('tittle', 'Administración bono escolar')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>DETALLE COTIZACION</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                 {!! Form::open(['route'=>'listacotizaciones', 'method'=>'get','class'=>'form-horizontal']) !!}


                <div class="col-sm-12">
                <div class="form-group">                                           
                                  {!! Form::label('fecha', 'Fecha de elaboración',['class'=>'col-sm-4 control-label']) !!}
                                            <div class="col-sm-4"> 
                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
           {!! Form::text('f_fechaelaboracion',$datoscotizacion->f_fechaelaboracion,['class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>'Fecha de elaboración','readonly']) !!}
                                              </div> 
                                    </div> 
                                       </div>
                          <div class="form-group"> 

                                    {!! Form::label('fecha', 'Fecha de recepción',['class'=>'col-sm-4 control-label']) !!}
                                            <div class="col-sm-4"> 
                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              {!! Form::text('f_fecharecepcion',$datoscotizacion->f_fecharecepcion,['class'=>'form-control pull-right','id'=>'datepicker','placeholder'=>'Fecha de entrega','readonly']) !!}
                                              </div> 
                                              </div> 
                                              
                </div><!--fin form group-->
              </div><!--fin col 12-->
 
         

              <div class="col-sm-12">
                 <div class="form-group"> 

                        {!! Form::label('numcotizacion', 'Cotización #',['class'=>'col-sm-4 control-label']) !!}
                                                                                        
                        <div class="col-sm-4">
                       {!! Form::text('v_numerocotizacion',$datoscotizacion->v_numerocotizacion,['class'=>'form-control pull-right','placeholder'=>'Número de cotización','readonly']) !!}
                     </div>                                               
                       
              </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">                                           
                                                {!! Form::label('', 'Descripción',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::textarea('v_descripcion',$datoscotizacion->v_descripcion,['class'=>'form-control pull-right','rows'=>'2','placeholder'=>'Descripción de la cotización  ','readonly']) !!}
                                                </div>
                </div>
              </div>

               <div class="col-sm-12">
            <div class="form-group">                                           
                                                {!! Form::label('', 'Lugar de entrega',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('v_lugarentrega',$datoscotizacion->v_lugarentrega,['class'=>'form-control pull-right','placeholder'=>'Lugar de la entrega','readonly']) !!}
                                                </div>
                </div>
              </div>



      <div class="col-sm-12">
            <div class="form-group"> 
              
            <div class="box-body table-responsive ">
              <table class="table table-bordered table-striped" id="">
               <thead style="color: white; background-color: #3c8dbc">               
                  <th>PRODUCTO</th>                  
                  <th>UNIDAD DE MEDIDA</th>
                  <th>CANTIDAD</th>
                  <th>PRECIO UNITARIO </th>
                  <th>TOTAL</th> 
                </thead>
                <tbody>
                <?php $total=0;?>
                @foreach($verdetallecotizacion as $verdetallecotizacion)                 
                 <tr>
                  <td>{{$verdetallecotizacion->v_producto}}</td> 
                   <td>{{$verdetallecotizacion->v_unidaddemedida}}</td>
                   <td>{{$verdetallecotizacion->d_cantidad}}</td>
                    <td> $ {{$verdetallecotizacion->d_preciounitario}}</td>
                    <td>$ {{$verdetallecotizacion->d_preciounitario*$verdetallecotizacion->d_cantidad}}</td>  
                  </tr> 
                 <?php $total=$total+($verdetallecotizacion->d_preciounitario*$verdetallecotizacion->d_cantidad); ?>              
                @endforeach                
              </tbody>
                  <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><strong>TOTAL COTIZACION </strong></td>
                  <td><strong>$ {{$total}}</strong></td>
                </tr>           
               
            </table>
            </div>
             </div>
              </div>

                
                                                   
          </div> 
             <div class="box-footer" align="right">                
                  <!--a href="{{route('listacotizaciones')}}" class="btn btn-danger"> Imprimir</a-->
                  <a href="{{route('listacotizaciones')}}" class="btn btn-default">Regresar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
          </div>
@endsection
