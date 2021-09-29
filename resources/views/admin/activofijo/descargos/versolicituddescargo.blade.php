@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Ver solicitud de descargo')
@section('content')

<div class="box box-primary">
  <div class="box-header">
   <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">SOLICITUD DE DESCARGO</label></h2>
        <hr></hr>
   </div>
   </div>


<div class="box-body">


<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">DATOS GENERALES</a></li>
              <li><a href="#tab_2" data-toggle="tab">ACTA DE APROBACIÓN</a></li>
                          
              <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
 

<div class="box-body">

{!! Form::open(['route'=>'lista-solicitudes-descarga', 'method'=>'GET','class'=>'form-horizontal','id'=>'formulario']) !!}
 {{ csrf_field() }}
 <input type="hidden" name="id" id="id" value="{{$solicitud->id}}" >
 <input type="hidden" name="motivodescargo[]" id="motivo" >
<div class="form-group">                          
          {!! Form::label('lbid', 'Número de solicitud *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('txtsolicitud',$solicitud->numsolicitud,['class'=>'form-control pull-right','id'=>'solicitud','placeholder'=>'Solicitud','readonly','required']) !!}
          </div>
    </div><!--fin form group-->

    <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de solicitud *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechasolicitud',$solicitud->f_fechasolicitud,['class'=>'form-control pull-right calendario','data-mask'=>'','placeholder'=>'Fecha de solicitud','required','disabled']) !!}
            </div> 
    </div>
     </div>

      <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de aprobación *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechasolicitud',$solicitud->f_fechaaprobacion,['class'=>'form-control pull-right calendario','data-mask'=>'','placeholder'=>'Sin fecha de aprobación','disabled']) !!}
            </div> 
    </div>
     </div>

      <div class="form-group">
              {!! Form::label('estado', 'Estado de solicitud',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-4">
            <?php 
            if($solicitud->estado=='PENDIENTE'){
         echo" <span class='label label-warning'>PENDIENTE</span>";
            }else{
          echo"<span class='label label-success'>APROBADA</span>";
            }
            ?>           
  </div>          
</div>

<div class="form-group">                          
          {!! Form::label('lbid', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::textarea('observaciones',$solicitud->observaciones,['class'=>'form-control pull-right','id'=>'solicitud','rows'=>'2','placeholder'=>'Observaciones de descargo','readonly']) !!}
          </div>
    </div><!--fin form group-->

 <hr>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead>
        <th>ID</th>
        <th>CÓDIGO ACTIVO</th>
        <th>DESCRIPCIÓN</th> 
        <th>MOTIVO DESCARGO</th>
        <th>VALOR DE ADQUISICIÓN</th>                                      
      </thead>
      <tbody>
        <?php $sum=0;  ?>
         @foreach($res as $value)
          @foreach($value->descargo_detalle as $item)
        <tr>            
          <td>{{$item->id}}</td>
          <td>{{$item->v_codigoactivo}}</td>
          <td>{{$item->v_nombre}}</td>
          <td>
          
             {!! Form::select('niveleducativo',$motivo, $item->pivot->tipodescargo_id,['class'=>'form-control','disabled'])!!}
          </td>
<td>$ {{$item->d_valor}}</td>
 <?php $sum=$sum+$item->d_valor;  ?>
        </tr> 
           @endforeach
         @endforeach
      </tbody>
      <tfoot>
      <tr>
           <td></td>
           <td></td>
            <td></td>
           <td><b>MONTO TOTAL</b></td>
            <td><b> $ <?php echo" $sum";  ?> </b></td>
        </tr>
        </tfoot>
    </table>
  </div>
   </div>
{!! Form::close() !!}





              </div>
              <!-- /.tab-pane -->


<div class="tab-pane" id="tab_2">
                
<div>
  <?php 
  if($solicitud->nombredearchivo!=null)
  {?>
  
  <embed src="{{asset('/actasActivoFijo/'.$solicitud->nombredearchivo)}}" type="application/pdf" width="100%" height="800px" > 
  <?php } else { echo"<div class='form-group'>
              <p>Sin archivo asignado</p>
              </div>";} ?>

</div>

              </div>
              <!-- /.tab-pane -->
              </div>
            <!-- /.tab-content -->
          </div>



  </div>
  <!-- /.box-body -->

 <div class="box-footer" align="right"> 
    <!--a href="#" id="btnGuardar"  class="btn btn-primary">Descargar</a-->
     
     
    <a <?php if ($origen=="pendientesdeaprobar") { ?> href="{{route('descargopendientedeaprobar')}}" <?php } else {?> href="{{route('lista-solicitudes-descarga')}}" <?php } ?> id="btnCancelar" class="btn btn-default">Regresar</a>
    
  </div>


</div>
@endsection

