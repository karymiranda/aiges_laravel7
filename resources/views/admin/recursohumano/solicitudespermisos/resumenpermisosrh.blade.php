@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Permisos')
@section('content')

<div class="box box-primary">
  <div class="box-header">
     <div class="col-sm-12" align="center">
     <h2> <label class="text-primary">PERMISOS ACUMULADOS</label></h2>
    </div>
  </div>
  <hr>          
  <div class="box-body table-responsive">
  <div class="col-sm-12" align="center">
    
  </div>

    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead >
        <th>No.</th>
        <th>NIP</th> 
        <th>NOMBRE DEL EMPLEADO</th> 
        <th width="10">SB</th>
        <th width="10">SS</th>
        <th width="10">HC</th>
        <th>DESDE</th> 
        <th>HASTA</th>    
        <th>DIAS</th> 
        <th>HORAS</th>  
        <th>MINUTOS</th>
        <th>MOTIVO</th>  
      </thead>
      <tbody>
        @php 
         $diasacum=0;
         $horas=0;
         $minutos=0;
        @endphp

       @foreach($permisos as  $key => $permiso)         
         <tr> 
          <td>{{$key+1}}</td>          
          <td>{{ $permiso->empleado->v_nip }}</td>
          <td>{{ $permiso->empleado->v_nombres . ' ' . $permiso->empleado->v_apellidos }}</td>
          @if($permiso->empleado->v_tipocontratacion=='SB')
          <td><i class="fa fa-check"></i></td>
          @else<td></td>@endif  
          @if($permiso->empleado->v_tipocontratacion=='SS')
          <td><i class="fa fa-check"></i></td>
          @else<td></td>@endif 
          @if($permiso->empleado->v_tipocontratacion=='HC')
          <td><i class="fa fa-check"></i></td>
          @else<td></td>@endif 
       
           
        <td>{{ date('d-M-y', strtotime($permiso->f_desde)) }}</td>  
        <td>{{ date('d-M-y', strtotime($permiso->f_hasta)) }}</td>    
          <td>{{ $permiso->i_tiemposolicitado}}</td>   
          <td>{{ $permiso->i_horas}}</td>
          <td>{{ $permiso->i_minutos}}</td>           
          <td>{{ $permiso->motivoPermiso->v_motivo}}</td>
          </tr> 
        @php 
         $diasacum+=$permiso->i_tiemposolicitado;
         $horas+=$permiso->i_horas;
         $minutos+=$permiso->i_minutos;
        @endphp

        @endforeach                   
      </tbody>
       <tfoot>
        <tr>
            <th></th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Tiempo acumulado</td>
            <td>{{$diasacum}}</td>
            <td>{{$horas}}</td>
            <td>{{$minutos}}</td>
            <td></td>
        </tr>
    </tfoot>

    </table> 
  </div>

  <div class="box-footer" align="right">  
    <a href="{{route('listapermisosrh')}}" class="btn btn-default">Regresar</a>
  </div>

</div>
@endsection

