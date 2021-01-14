@extends('admin.menuprincipal')
@section('tittle','Personal Docente/Permisos')
@section('content')


<div class="box box-primary">
  <div class="box-header">
    <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">HISTORIAL PERMISOS SOLICITADOS</label></h2>              
    </div>
    <div class="col-sm-12 " align="right">       
      <a href="{{route('crearsolicitud')}}" class="btn btn-primary">Solicitar permiso</a>
    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalfiltrofechapermisos">Ver Acumulados</a>

      <!--a href="{{route('permisosacumuladosdocentes',Auth::user()->empleado->id)}}" class="btn btn-warning">Ver acumulados</a-->
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead >
        <th>No</th> 
        <!--th>FECHA</th--> 
        <th>MOTIVO</th>
        <th>DESDE</th>
        <th>HASTA</th>
         <th>DIAS</th> 
          <th>HORAS</th>  
           <th>MINUTOS</th> 
        <th>ESTADO</th>
        <th>ACCIONES</th>
      </thead>
      <tbody>   
          @foreach($permisos as $key => $permiso)
        <tr> 
          <td>{{ $key+1 }}</td>
          <!--td>{{ $permiso->f_fechasolicitud }}</td-->
          <td>{{ $permiso->motivoPermiso->v_motivo }}</td>
          <td>{{ $permiso->f_desde }}</td>
          <td>{{ $permiso->f_hasta }}</td> 
           <td>{{ $permiso->i_tiemposolicitado}}</td>   
           <td>{{ $permiso->i_horas}}</td>
            <td>{{ $permiso->i_minutos}}</td>               
          <td>
            <span class="
            <?php if($permiso->estado=='Pendiente'){ ?> 
              label label-warning <?php }else{
                if($permiso->estado=='Aprobada'){ ?> 
                  label label-success <?php }else{
              ?> label label-danger <?php }
            } ?>">{{ $permiso->estado }}</span>
          </td>
          <td>                    
            <a href="{{route('versolicitud',$permiso->id)}}" class="btn btn-primary" title="Ver solicitud"><i class="fa fa-eye"></i></a>
            <?php if ($permiso->estado=='Pendiente'): ?>
            <a href="{{route('editarsolicitud',$permiso->id)}}" class="btn btn-success" title="Editar solicitud"><i class="fa fa-edit"></i></a>  
            <?php else: ?>
            <a disabled='true' class="btn btn-success"><i class="fa fa-edit"></i></a>  
            <?php endif ?>
            
            <?php if ($permiso->estado!='Denegada'): ?>
            <a href="{{route('comprobantepermisodocente',$permiso->id)}}" class="btn btn-warning" title="Imprimir comprobante" target="_blank"><i class="fa fa-file-pdf-o"></i></a>  
            <?php else: ?>
            <a disabled='true' class="btn btn-warning"><i class="fa fa-file-pdf-o"></i></a>  
            <?php endif ?>

          </td>                                   
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>

<div class="modal fade" tabindex="-2" role="dialog" id="modalfiltrofechapermisos">
          <form  id="rptPermisos">
            @csrf
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">HISTORIAL PERMISOS</h4>
                      </div>
        <div class="modal-body">
        <div class="box-body">
       
       <div class="form-group">
        <label class="col-sm-2 control-label">Período</label>
        <div class="col-sm-10">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" value="" name="f_permisos" id="f_permisos" placeholder="Seleccione un rango de fechas para inciar la búsqueda" class="form-control pull-right rangoPast" readonly="true" required="true">
          </div> 
        </div> 
        </div>

         
           </div>
           </div>
         
   <div class="modal-footer">                        
   <a href="#" title="Iniciar búsqueda" class="btn btn-primary" id="btnbuscarpermisos">Buscar</a>
   <button type="button" class="btn btn-default " data-dismiss="modal">Cancelar</button>
                      </div>
              </div>
                </div>
            </form> 
       </div>
@endsection
@section('script')
<script>
$('#btnbuscarpermisos').on('click',function(e) {
            e.preventDefault();          
$('#rptPermisos').attr("method",'POST');
$('#rptPermisos').attr("action",'permisosacumuladosdocentes/'+{{Auth::user()->empleado->id}}+'/view'); 
 $('#rptPermisos').submit(); 
        });
</script>
@endsection
