@extends('admin.menuprincipal')
@section('tittle','Recurso Humano/Permisos')
@section('content')

<div class="box box-primary">
  <div class="box-header">
     <div class="col-sm-12" align="center">
     <h2> <label class="text-primary">SOLICITUDES DE PERMISOS</label></h2>
    </div> 
   
    <div class="col-sm-12" align="right">       
    <a href="{{route('crearsolicitudespermisorh')}}" class="btn btn-primary">Registrar solicitud</a>
    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#modalfiltrofechapermisos">Ver Acumulados</a> 
    </div>
  </div>
  <hr>          
  <div class="box-body table-responsive">   
    <table class="table table-bordered table-striped" id="tablaBusqueda">
      <thead >
        <th>No.</th>   
        <th>SOLICITANTE</th>       
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
        @foreach($permisos as  $key => $permiso)
        <tr> 
            <td>{{$key+1}}</td> 
          <td>{{ $permiso->empleado->v_nombres . ' ' . $permiso->empleado->v_apellidos }}</td>
            <td>{{ $permiso->motivoPermiso->v_motivo }}</td>  
          <td>{{ $permiso->f_desde }}</td>
          <td>{{ $permiso->f_hasta}}</td>
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
            <a href="{{route('versolicitudespermisorh',$permiso->id)}}" title="Ver" class="btn btn-primary"><i class="fa fa-eye"></i></a>
            <?php if($permiso->estado=='Pendiente'){ ?>
              <a href="{{route('editarsolicitudespermisorh',$permiso->id)}}" title="Actualizar" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              <a class="btn btn-success" data-toggle="modal" title="Aprobar" data-target="#aprobar_{{$permiso->id}}">
                <i class="fa fa-check"></i>
              </a>
              <div class="modal fade" id="aprobar_{{$permiso->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header success">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea aprobar la solicitud del empleado {{$permiso->empleado->v_numeroexp}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('aprobarsolicitudespermisorh',$permiso->id)}}">
                        <input type="hidden" name="id" value="{{$permiso->id}}">
                        <input type="submit" value="Aprobar" class="btn btn-sm btn-success delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <a class="btn btn-danger" data-toggle="modal" title="Denegar" data-target="#denegar_{{$permiso->id}}">
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="denegar_{{$permiso->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea DENEGAR la solicitud del empleado {{$permiso->empleado->v_numeroexp}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('denegarsolicitudespermisorh',$permiso->id)}}">
                        <input type="hidden" name="id" value="{{$permiso->id}}">
                        <input type="submit" value="Denegar" class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php }else{ ?>
              <a disabled='true' title="Actualizar" class="btn btn-warning"><i class="fa fa-edit"></i></a>
              <a class="btn btn-success" disabled='true'>
                <i class="fa fa-check"></i>
              </a>
              <a class="btn btn-danger" disabled='true'>
                <i class="fa fa-close"></i>
              </a>
            <?php } ?>
            <a href="{{route('comprobantepermisodocente',$permiso->id)}}" class="btn btn-warning" title="Imprimir comprobante" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                    
          </td>


        </tr>
        @endforeach
      </tbody>
    </table> 
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

           <div class="form-group">
          {!! Form::label('', '',['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
      {!! Form::checkbox('filtrobusqueda','T', true,['id'=>'super'])!!}
      {!! Form::label('doc', 'Todos los docentes',['class'=>'check']) !!}              
           </div> 
          </div> 


 <div class="form-group">
          {!! Form::label('', '',['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
      {!! Form::checkbox('filtrobusqueda','U', false,['class'=>'check','id'=>'checkOP'])!!}
      {!! Form::label('doc', 'Unico docente',['class'=>'control-label']) !!}              
           </div> 
          </div> 

            <div class="form-group">
              {!! Form::label('', '',['class'=>'col-sm-2 control-label']) !!}
           <div class="col-sm-10">
           {!! Form::select('docente_id',$asesor, null,['class'=>'form-control','id'=>'docente_id','readonly'=>'true'])!!}
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

</div>
@endsection
@section('script')
<script>
  $('#super').change(function() {
          if(this.checked) {            
              $('.check').prop('checked', false);
          }      
      });
      $('.check').change(function() {
          if(this.checked) {            
              $('#super').prop('checked', false);
          }      
      });


 $('#btnbuscarpermisos').on('click',function(e) {
            e.preventDefault();            

$('#rptPermisos').attr("method",'POST');
$('#rptPermisos').attr("action",'resumenpermisosrh'); 
 $('#rptPermisos').submit(); 

        });
</script> 
@endsection