@extends('admin.menuprincipal')
@section('tittle', 'Administración académica')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>REGISTRAR HORARIO</Strong></h3>
  </div>
  <!-- /.box-header -->
  @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  <!-- form start -->
  <div class="box-body">
    {!! Form::open(['route'=>'cargarhorarios', 'method'=>'GET','class'=>'form-horizontal']) !!}
    <input type="hidden" id="bloquesfind" data-bloquesfind="{{ $bloques }}">
    <div class="form-group">                                           
      {!! Form::label('lbsecciones', 'Grado/Sección',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-2">
        {!! Form::select('seccion',$secciones, $seccion,['class'=>'form-control','placeholder'=>'Seleccione'])!!}
      </div>
      {!! Form::submit('Buscar',['class'=>'btn btn-primary ']) !!} 
    </div>
    {!! Form::close() !!}
    <div class="form-group" align="center"> 
    {!! Form::open(['route'=>'guardarhorarios', 'method'=>'POST','class'=>'form-horizontal']) !!}
     {!! Form::hidden('seccion', $seccion) !!}
     {!! Form::hidden('numBloq', $numBloq,['id'=>'numBloq']) !!}
      <table class="table table-bordered">
      <thead>
        <th style="width: 10%">HORARIO</th>
        <th style="width: 18%">LUNES</th>
        <th style="width: 18%">MARTES</th>
        <th style="width: 18%">MIERCOLES</th>                  
        <th style="width: 18%">JUEVES</th>
        <th style="width: 18%">VIERNES</th>
      </thead>
      <tbody>
       <!--  -->
        <?php if($bloques->first !=null){ ?>
        @foreach($bloques as $bloque)
        <?php if ($bloque->tipo_bloque!='Clase'): ?>
          {!! Form::hidden('bloqueR_'.$bloque->id, $bloque->id) !!}
          <tr>
          <td>{{ $bloque->hora_inicio .' - '. $bloque->hora_fin }}</td>
          <td><span class="label label-success"><label style="padding-top: 8%">Receso</label></span></td>
          <td><span class="label label-success"><label style="padding-top: 8%">Receso</label></span></td>
          <td><span class="label label-success"><label style="padding-top: 8%">Receso</label></span></td>
          <td><span class="label label-success"><label style="padding-top: 8%">Receso</label></span></td>
          <td><span class="label label-success"><label style="padding-top: 8%">Receso</label></span></td>          
        </tr>
        <?php else: ?>
        <tr>
          <td>{{ $bloque->hora_inicio .' - '. $bloque->hora_fin }}</td>
          <td><div data-toggle="modal" data-target="#lunes_{{$bloque->id}}" class="bloque"><span id="spanAL_{{ $bloque->id }}"><label id="LA_{{ $bloque->id }}">Asignatura</label></span><br><span id="spanDL_{{ $bloque->id }}"><label id="LD_{{ $bloque->id }}">Docente</label></span></div>
            <div class="modal fade" id="lunes_{{$bloque->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Clase</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">                                           
                      {!! Form::label('lbAsignatura', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('asignatura_idL_'.$bloque->id,$asignaturas, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'asignaturaL_'.$bloque->id])!!}
                      </div> 
                    </div>
                    <div class="form-group">                                           
                      {!! Form::label('lbdocente', 'Docente',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('docente_idL_'.$bloque->id,$docentes, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'docenteL_'.$bloque->id])!!}
                      </div> 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" value="Agregar" onclick="agregar({{$bloque->id}},'asignaturaL','docenteL')" class="btn btn-sm btn-primary" data-dismiss="modal">
                    <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div data-toggle="modal" data-target="#martes_{{$bloque->id}}" class="bloque"><span id="spanAM_{{ $bloque->id }}"><label id="MA_{{ $bloque->id }}">Asignatura</label></span><br><span id="spanDM_{{ $bloque->id }}"><label id="MD_{{ $bloque->id }}">Docente</label></span></div>
            <div class="modal fade" id="martes_{{$bloque->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Clase</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">                                           
                      {!! Form::label('lbAsignatura', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('asignatura_idM_'.$bloque->id,$asignaturas, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'asignaturaM_'.$bloque->id])!!}
                      </div> 
                    </div>
                    <div class="form-group">                                           
                      {!! Form::label('lbdocente', 'Docente',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('docente_idM_'.$bloque->id,$docentes, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'docenteM_'.$bloque->id])!!}
                      </div> 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" value="Agregar" onclick="agregar({{$bloque->id}},'asignaturaM','docenteM')" class="btn btn-sm btn-primary" data-dismiss="modal">
                    <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div data-toggle="modal" data-target="#miercoles_{{$bloque->id}}" class="bloque"><span id="spanAMi_{{ $bloque->id }}"><label id="MiA_{{ $bloque->id }}">Asignatura</label></span><br><span id="spanDMi_{{ $bloque->id }}"><label id="MiD_{{ $bloque->id }}">Docente</label></span></div>
            <div class="modal fade" id="miercoles_{{$bloque->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Clase</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">                                           
                      {!! Form::label('lbAsignatura', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('asignatura_idMi_'.$bloque->id,$asignaturas, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'asignaturaMi_'.$bloque->id])!!}
                      </div> 
                    </div>
                    <div class="form-group">                                           
                      {!! Form::label('lbdocente', 'Docente',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('docente_idMi_'.$bloque->id,$docentes, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'docenteMi_'.$bloque->id])!!}
                      </div> 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" value="Agregar" onclick="agregar({{$bloque->id}},'asignaturaMi','docenteMi')" class="btn btn-sm btn-primary" data-dismiss="modal">
                    <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div data-toggle="modal" data-target="#jueves_{{$bloque->id}}" class="bloque"><span id="spanAJ_{{ $bloque->id }}"><label id="JA_{{ $bloque->id }}">Asignatura</label></span><br><span id="spanDJ_{{ $bloque->id }}"><label id="JD_{{ $bloque->id }}">Docente</label></span></div>
            <div class="modal fade" id="jueves_{{$bloque->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Clase</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">                                           
                      {!! Form::label('lbAsignatura', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('asignatura_idJ_'.$bloque->id,$asignaturas, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'asignaturaJ_'. $bloque->id])!!}
                      </div> 
                    </div>
                    <div class="form-group">                                           
                      {!! Form::label('lbdocente', 'Docente',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('docente_idJ_'.$bloque->id,$docentes, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'docenteJ_'.$bloque->id])!!}
                      </div> 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" value="Agregar" onclick="agregar({{$bloque->id}},'asignaturaJ','docenteJ')" class="btn btn-sm btn-primary" data-dismiss="modal">
                    <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>
          <td>
            <div data-toggle="modal" data-target="#viernes_{{$bloque->id}}" class="bloque"><span id="spanAV_{{ $bloque->id }}"><label id="VA_{{ $bloque->id }}">Asignatura</label></span><br><span id="spanDV_{{ $bloque->id }}"><label id="VD_{{ $bloque->id }}">Docente</label></span></div>
            <div class="modal fade" id="viernes_{{$bloque->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Agregar Clase</h4>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">                                           
                      {!! Form::label('lbAsignatura', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('asignatura_idV_'.$bloque->id,$asignaturas, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'asignaturaV_'.$bloque->id])!!}
                      </div> 
                    </div>
                    <div class="form-group">                                           
                      {!! Form::label('lbdocente', 'Docente',['class'=>'col-sm-4 control-label']) !!}
                      <div class="col-sm-5">
                        {!! Form::select('docente_idV_'.$bloque->id,$docentes, null,['class'=>'form-control','placeholder'=>'Seleccione','id'=>'docenteV_'.$bloque->id ])!!}
                      </div> 
                    </div>
                  </div>
                  <div class="modal-footer">
                    <input type="button" value="Agregar" onclick="agregar({{$bloque->id}},'asignaturaV','docenteV')" class="btn btn-sm btn-primary" data-dismiss="modal">
                    <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                  </div>
                </div>
              </div>
            </div>
          </td>          
        </tr>
        <?php endif ?>
        @endforeach
      <?php }else{ ?>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>          
        </tr>
      <?php } ?>
      </tbody>
    </table>
    </div>                                    
  </div>
  <div class="box-footer" align="right">                
    {!! Form::submit('Guardar',['class'=>'btn btn-primary','id'=>'btnGuardar','disabled']) !!}
    <a href="{{route('listadohorariosclase')}}" class="btn btn-default">Cancelar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->   
</div>
@endsection
@section('script')
<script>
  $(document).ready(function(){
    if ($('#numBloq').val() != 0) 
    {
        $("#btnGuardar").removeAttr('disabled');
        var bloque= $('#bloquesfind').data('bloquesfind');
        for (var i =  0; i < $('#numBloq').val(); i++) {
          if($('#asignaturaL_'+bloque[i].id).val()!='' && $('#docenteL_'+bloque[i].id).val()!=''){
            $('#LA_'+bloque[i].id).text($('#asignaturaL_'+bloque[i].id+' option:selected').html());
            $('#spanAL_'+bloque[i].id).addClass('label label-primary');
            $('#LD_'+bloque[i].id).text($('#docenteL_'+bloque[i].id+' option:selected').html());
            $('#spanDL_'+bloque[i].id).addClass('label label-info');
          }
          if($('#asignaturaM_'+bloque[i].id).val()!='' && $('#docenteM_'+bloque[i].id).val()!=''){
            $('#MA_'+bloque[i].id).text($('#asignaturaM_'+bloque[i].id+' option:selected').html());
            $('#spanAM_'+bloque[i].id).addClass('label label-primary');
            $('#MD_'+bloque[i].id).text($('#docenteM_'+bloque[i].id+' option:selected').html());
            $('#spanDM_'+bloque[i].id).addClass('label label-info');
          }
          if($('#asignaturaMi_'+bloque[i].id).val()!='' && $('#docenteMi_'+bloque[i].id).val()!=''){
            $('#MiA_'+bloque[i].id).text($('#asignaturaMi_'+bloque[i].id+' option:selected').html());
            $('#spanAMi_'+bloque[i].id).addClass('label label-primary');
            $('#MiD_'+bloque[i].id).text($('#docenteMi_'+bloque[i].id+' option:selected').html());
            $('#spanDMi_'+bloque[i].id).addClass('label label-info');
          }
          if($('#asignaturaJ_'+bloque[i].id).val()!='' && $('#docenteJ_'+bloque[i].id).val()!=''){
            $('#JA_'+bloque[i].id).text($('#asignaturaJ_'+bloque[i].id+' option:selected').html());
            $('#spanAJ_'+bloque[i].id).addClass('label label-primary');
            $('#JD_'+bloque[i].id).text($('#docenteJ_'+bloque[i].id+' option:selected').html());
            $('#spanDJ_'+bloque[i].id).addClass('label label-info');
          }
          if($('#asignaturaV_'+bloque[i].id).val()!='' && $('#docenteV_'+bloque[i].id).val()!=''){
            $('#VA_'+bloque[i].id).text($('#asignaturaV_'+bloque[i].id+' option:selected').html());
            $('#spanAV_'+bloque[i].id).addClass('label label-primary');
            $('#VD_'+bloque[i].id).text($('#docenteV_'+bloque[i].id+' option:selected').html());
            $('#spanDV_'+bloque[i].id).addClass('label label-info');
          }
        }
    }
});
function agregar(id,asignatura,docente){
  switch (asignatura) {
  case 'asignaturaL':
    if($('#'+asignatura+'_'+id).val()!='' && $('#'+docente+'_'+id).val()!=''){
    $('#LA_'+id).text($('#'+asignatura+'_'+id+' option:selected').html());
    $('#LD_'+id).text($('#'+docente+'_'+id+' option:selected').html());
    $('#spanAL_'+id).addClass('label label-primary');
    $('#spanDL_'+id).addClass('label label-info');
  }else{
    $('#'+asignatura+'_'+id).val('');
    $('#'+docente+'_'+id).val('');
    $('#LA_'+id).text('Asignatura');
    $('#LD_'+id).text('Docente');
    $('#spanAL_'+id).removeClass('label label-primary');
    $('#spanDL_'+id).removeClass('label label-info');

  }
    break;
  case 'asignaturaM':
    if($('#'+asignatura+'_'+id).val()!='' && $('#'+docente+'_'+id).val()!=''){
    $('#MA_'+id).text($('#'+asignatura+'_'+id+' option:selected').html());
    $('#MD_'+id).text($('#'+docente+'_'+id+' option:selected').html());
    $('#spanAM_'+id).addClass('label label-primary');
    $('#spanDM_'+id).addClass('label label-info');
  }else{
    $('#'+asignatura+'_'+id).val('');
    $('#'+docente+'_'+id).val('');
    $('#MA_'+id).text('Asignatura');
    $('#MD_'+id).text('Docente');
    $('#spanAM_'+id).removeClass('label label-primary');
    $('#spanDM_'+id).removeClass('label label-info');

  }
    break;
  case 'asignaturaMi':
    if($('#'+asignatura+'_'+id).val()!='' && $('#'+docente+'_'+id).val()!=''){
    $('#MiA_'+id).text($('#'+asignatura+'_'+id+' option:selected').html());
    $('#MiD_'+id).text($('#'+docente+'_'+id+' option:selected').html());
    $('#spanAMi_'+id).addClass('label label-primary');
    $('#spanDMi_'+id).addClass('label label-info');
  }else{
    $('#'+asignatura+'_'+id).val('');
    $('#'+docente+'_'+id).val('');
    $('#MiA_'+id).text('Asignatura');
    $('#MiD_'+id).text('Docente');
    $('#spanAMi_'+id).removeClass('label label-primary');
    $('#spanDMi_'+id).removeClass('label label-info');

  }
    break;
  case 'asignaturaJ':
    if($('#'+asignatura+'_'+id).val()!='' && $('#'+docente+'_'+id).val()!=''){
    $('#JA_'+id).text($('#'+asignatura+'_'+id+' option:selected').html());
    $('#JD_'+id).text($('#'+docente+'_'+id+' option:selected').html());
    $('#spanAJ_'+id).addClass('label label-primary');
    $('#spanDJ_'+id).addClass('label label-info');
  }else{
    $('#'+asignatura+'_'+id).val('');
    $('#'+docente+'_'+id).val('');
    $('#JA_'+id).text('Asignatura');
    $('#JD_'+id).text('Docente');
    $('#spanAJ_'+id).removeClass('label label-primary');
    $('#spanDJ_'+id).removeClass('label label-info');

  }
    break;
  case 'asignaturaV':
    if($('#'+asignatura+'_'+id).val()!='' && $('#'+docente+'_'+id).val()!=''){
    $('#VA_'+id).text($('#'+asignatura+'_'+id+' option:selected').html());
    $('#VD_'+id).text($('#'+docente+'_'+id+' option:selected').html());
    $('#spanAV_'+id).addClass('label label-primary');
    $('#spanDV_'+id).addClass('label label-info');
  }else{
    $('#'+asignatura+'_'+id).val('');
    $('#'+docente+'_'+id).val('');
    $('#VA_'+id).text('Asignatura');
    $('#VD_'+id).text('Docente');
    $('#spanAV_'+id).removeClass('label label-primary');
    $('#spanDV_'+id).removeClass('label label-info');
  }
    break;
}
  
}
</script>
<style type="text/css">
.bloque {
    cursor: pointer;
}
.bloque label{
    cursor: pointer;
}
.table th,td{
    text-align: center;
}
</style>
@endsection