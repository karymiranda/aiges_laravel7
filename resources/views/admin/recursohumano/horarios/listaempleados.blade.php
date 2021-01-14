@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Horarios')
@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">
       <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">HORARIOS DE PERSONAL</label></h2>
    </div>
    </div>           
    <div class="box-body table-responsive">
      <table class="table table-bordered table-striped"  id="tablaAsistencia">
        <thead>
          <th>No.</th>  
          <th>EMPLEADO</th>
          <th>TIPO PERSONAL</th>
          <th>CARGO</th>                  
          <th>ACCIONES</th>
        </thead>
        <tbody>
          @foreach($empleados as $key => $empleado)          
            
             <?php if ($empleado->v_numeroexp!='RH0000-0'){ ?>  
              <tr>     
              <td>{{ $key }}</td>      
              <td>{{ $empleado->v_nombres }} {{ $empleado->v_apellidos }}</td>
              <td>{{ $empleado->tipoPersonal->v_tipopersonal }}</td>
              <td>{{ $empleado->cargo->v_descripcion }}</td>
                        
                <?php if ($empleado->horarios->first()!=null){ ?>
                   <td> 
                  <a href="{{ route('crearhorario',$empleado->id) }}" title="Agregar" class="btn btn-info" ><i class="fa fa-clock-o"></i></a>
                  <a href="{{ route('editarhorario',$empleado->id) }}" title="Actualizar" class="btn btn-success"><i class="fa fa-edit"></i></a>
                  <a href="{{ route('verhorario',$empleado->id) }}" title="Ver" class="btn btn-primary" ><i class="fa fa-eye"></i></a>  </td>  
                <?php }else{ ?>
                   <td> 
                   <a title="Agregar" class="btn btn-info" disabled='true'><i class="fa fa-clock-o"></i></a>
                  <a title="Actualizar" disabled='true' class="btn btn-success"><i class="fa fa-edit"></i></a>
                  <a title="Ver" disabled='true' class="btn btn-primary" ><i class="fa fa-eye"></i></a>
                   </td> 
                <?php } ?> 
                 </tr>
              <?php } ?>
           
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body-->   
  </div>
@endsection