@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Solicitudes de descargo PENDIENTES DE APROBAR')
@section('content')

<div class="box box-primary">
  <div class="box-header">
   <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">SOLICITUDES PENDIENTES DE APROBAR</label></h2>
              </div>

  </div>
  <hr>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead>
         <th>No. SOLICITUD</th> 
        <th>FECHA DE SOLICITUD</th>        
        <th>FECHA DE DESCARGO</th>                                 
        <th>No. DE BIENES A DESCARGAR</th>
        <th>COSTO TOTAL A DESCARGAR</th>
        <th>ESTADO</th>
         <th>ACCIONES</th>
      </thead>
      <tbody>
        @foreach($afdescargados as $descargo)
        <tr>          
          <td>{{$descargo->numsolicitud}}</td>
         <td>{{$descargo->f_fechasolicitud}}</td>
         <?php 
       if($descargo->f_fechaaprobacion==null)
         {  echo"<td> --- </td>";     }
       else
        { echo"<td>{$descargo->f_fechaaprobacion}</td>";  }
       
          ?>
    <td align="center">{{$descargo->cantidad}}</td>
    <td align="center">$ {{$descargo->suma}}</td>
<?php 
         if($descargo->estado=='PENDIENTE')
         {  echo"<td><span class='label label-warning'>{$descargo->estado}</span></td>";     }
       else if($descargo->estado=='DESCARGADO')
        { echo"<td><span class='label label-success'>{$descargo->estado}</span></td>";  }
          ?>

         
         <td>

           <a href="{{route('versolicituddescargo',[$descargo->id,'pendientesdeaprobar'])}}" title="Ver detalle solicitud" class="btn btn-primary" ><i class="fa fa-eye"></i></a>
           <!--a href="{{route('editarsolicituddescargo',$descargo->id)}}" title="Editar solicitud" class="btn btn-success" <?php if($descargo->f_fechaaprobacion!=null)
         { echo "disabled";
         } ?> ><i class="fa fa-edit"></i></a-->

           <a href="{{route('subiractadeaprobacion',$descargo->id)}}" title="Aprobar solicitud" class="btn btn-success" <?php if($descargo->f_fechaaprobacion!=null)
         { echo "disabled";
         } ?> ><i class="fa fa-check"></i></a>

<a class="btn btn-danger" data-toggle="modal" title="Negar solicitud" data-target="#rechazar_{{$descargo->id}}"><i class="fa fa-close" ></i></a>
     <!-- /modal deshabilitar -->
<div class="modal fade" id="rechazar_{{$descargo->id}}">
          <div class="modal-dialog">
            <div class="modal-content">             
   <form class="form-horizontal" method="POST" action="{{route('negaractadeaprobacion')}}" >
    {!! csrf_field() !!}    
   <input type="hidden" name="id" value={{$descargo->id}}>
                <div class="modal-header danger">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">NEGAR SOLICITUD DE DESCARGO ACTIVO FIJO</h4>
                </div>

      <div class="modal-body">
      <p>Favor completar la siguiente información:</p>                                          
 <div class="form-group"style="width:100%">                        
      {!! Form::label('lb', 'Observaciones',['class'=>'col-sm-4 control-label']) !!} 
                        <div class="col-sm-8">                       
       {!! Form::textarea('observaciones',null,['class'=>'form-control ','placeholder'=>'Observaciones','style'=>'width:100%','required'=>'true','row'=>2])!!} 
                      </div>
                      </div>  
    </div>
      <div class="box-footer" align="right">
      <input type="submit" value="Continuar" class="btn btn-sm btn-danger delete-btn">
       <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
      </div>
       </form>  
        </div>                
     </div>
     </div> 
<!-- / finmodal-dialog --> 

         </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
@endsection