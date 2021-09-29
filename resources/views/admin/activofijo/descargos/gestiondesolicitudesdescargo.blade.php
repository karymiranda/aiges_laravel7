@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Solicitudes de descargo')
@section('content')

<div class="box box-primary">
  <div class="box-header">
   <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">SOLICITUDES DESCARGO ACTIVO FIJO</label></h2>
              </div>
    <div class="col-sm-12 " align="right">          
      <a href="{{route('crearsolicituddescarga')}}" class="btn btn-primary">Nueva solicitud</a>
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
       else if($descargo->estado=='APROBADA')
        { echo"<td><span class='label label-success'>{$descargo->estado}</span></td>";  }
      else if($descargo->estado=='NEGADA')
        { echo"<td><span class='label label-danger'>{$descargo->estado}</span></td>";  }
          ?>

         
         <td>

           <a href="{{route('versolicituddescargo',[$descargo->id,'solicitudesdescargo'])}}" title="Ver detalle solicitud" class="btn btn-primary" ><i class="fa fa-eye"></i></a>
           <a href="{{route('editarsolicituddescargo',$descargo->id)}}" title="Editar solicitud" class="btn btn-success" <?php if($descargo->f_fechaaprobacion!=null)
         { echo "disabled";
         } ?> ><i class="fa fa-edit"></i></a>
 
 <div class="btn-group">
                  <button type="button" class="btn btn-warning" title="Reportes"><i class="fa fa-file-pdf-o"></i></button>
                  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
            <li><a href="{{route('imprimirsolicituddescarga',[$descargo->id])}}"  target="_blank"><i class="fa fa-file-pdf-o"></i> Imprimir</a></li>
                 <!--li><a href="#" target="__blank"><i class="fa fa-file-excel-o"></i>Descargar</a></li-->
                  </ul>
  </div>


         </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
@endsection