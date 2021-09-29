@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Depreciación')
@section('content')

  <div class="box box-primary">
    <div class="box-header">
      <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">CUADRO DE DEPRECIACIÓN</label></h2>
              </div>
      <div class="col-sm-12" align="right">          
        
    </div>
    </div>
    <hr>
    <!-- /.box-header -->
    <form id="formulariorpt">

   <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" style="width:30%">
        <thead>
          <th colspan="2" align="center">INFORMACIÓN DEL ACTIVO</th>
        </thead>
        <tbody>
          
       <tr>
       	<td>Código  </td>
        <td>  <?php if($activo!=null)  { echo" $activo->v_codigoactivo  ";  }?>  </td>
       </tr> 
       <tr>
       	<td>Descripción  </td>
        <td> <?php if($activo!=null)  { echo"  $activo->v_nombre  "; } ?> </td>
       </tr>
       <tr>
       	<td>Fecha de adquisición  </td>
        <td> <?php if($activo!=null)  {?>  {{ date('d-M-y', strtotime($activo->f_fecha_adquisicion)) }}  <?php }?>    </td>
       </tr> 
       <tr>
       	<td>Valor de adquisición  </td>
        <td> <?php if($activo!=null)  { echo" $ $activo->d_valor  " ; }?>     </td>
       </tr> 
       <tr>
        <td>Valor de recuperación  </td>
        <td> <?php if($activo!=null)  { echo" $ $activo->d_valorrecuperacion  " ; }?>     </td>
       </tr> 
        
       <tr>
       	<td>Vida útil  </td>
        <td>    <?php if($activo!=null)  { echo"  $activo->v_vidautil    años"; } ?> </td>
       </tr>       
       </tbody>
      </table>
  </div>
        
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped" id="tablaBusqueda">
        <thead>
          <th>No</th>
          <th>PERIODO</th>
          <th>FECHA</th>
          <th>DEPRECIACIÓN ANUAL</th>
          <th>DEPRECIACIÓN ACUMULADA</th>
           <th>VALOR EN LIBROS</th> 
        </thead>
        <tbody>
        	
          
        	@foreach($activo->activo_depreciacion as  $key => $depreciacion)
          
          <tr>
          <td>{{$key+1}}</td>            
            <td>{{ $depreciacion->anio }}</td>
            <td>{{ date('d-M-y', strtotime($depreciacion->f_fechamovimiento)) }}</td>
            <td>$ {{ number_format($depreciacion->d_depreciacionanual,2) }}</td>
            <td>$ {{ number_format($depreciacion->d_depreciacionacumulada,2) }}</td>
            <td>$ {{ number_format($depreciacion->d_valoenlibros,2) }}</td>

           @endforeach
          
       </tbody>
      </table>
    </div>

     <div class="box-footer" align="right">                           
      <a href="{{route('depreciacionactivos')}}" class="btn btn-primary">Regresar</a>
    </div>

    </form>
    <!-- /.box-body -->
  </div>
@endsection
