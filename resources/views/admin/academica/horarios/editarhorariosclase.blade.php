@extends('admin.menuprincipal')
@section('tittle', 'Administración académica')
@section('content')

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title"><Strong>Actualizar horario</Strong></h3>
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
    {!! Form::open(['class'=>'form-horizontal']) !!}
    <div class="form-group">                                           
      {!! Form::label('lbsecciones', 'Grado/Sección',['class'=>'col-sm-2 control-label']) !!}
      <div class="col-sm-2">
        {!! Form::text('gradoseccion',$seccion,['class'=>'form-control pull-right','readonly'=>'true'])!!}
      </div>
    </div>
    {!! Form::close() !!}
    <div class="form-group" align="center"> 
    {!! Form::open(['route'=>'actualizarhorarios', 'method'=>'PUT','class'=>'form-horizontal']) !!}
      {!! Form::hidden('seccion_id',$seccion_id)!!}
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
       <?php for($i=0;$i<=$b;$i++){ ?> 
            <tr>            
              <td>{{ $horario[$i][0][0] }}</td> 
          <?php for($e=0;$e<5;$e++){ ?>     
              <td>
                <?php if ($horario[$i][$e][1]!='Clase'): ?>          
                  <span class="label label-success"><label style="padding-top: 8%">Receso</label></span>          
                <?php else: ?>
                  <div data-toggle="modal" data-target="#bloque_{{$horario[$i][$e][6]}}" class="bloque"><span id="spanA_{{$horario[$i][$e][6]}}" class="label label-primary"><label id="Lasignatura_{{$horario[$i][$e][6]}}">{{ $horario[$i][$e][2] }}</label></span><br><span id="spanD_{{$horario[$i][$e][6]}}" class="label label-info"><label id="Ldocente_{{$horario[$i][$e][6]}}">{{ $horario[$i][$e][3] }}</label></span></div>
                  <div class="modal fade" id="bloque_{{$horario[$i][$e][6]}}">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header primary">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h4 class="modal-title">Actualizar Clase</h4>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">                                           
                            {!! Form::label('lbAsignatura', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-5">
                              {!! Form::select('asignatura_id_'.$horario[$i][$e][6],$asignaturas, $horario[$i][$e][4],['class'=>'form-control','placeholder'=>'Seleccione','id'=>'asignatura_'.$horario[$i][$e][6]])!!}
                            </div> 
                          </div>
                          <div class="form-group">                                           
                            {!! Form::label('lbdocente', 'Docente',['class'=>'col-sm-4 control-label']) !!}
                            <div class="col-sm-5">
                              {!! Form::select('docente_id_'.$horario[$i][$e][6],$docentes, $horario[$i][$e][5],['class'=>'form-control','placeholder'=>'Seleccione','id'=>'docente_'.$horario[$i][$e][6]])!!}
                            </div> 
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input type="button" value="Agregar" onclick="agregar('{{$horario[$i][$e][6]}}','asignatura','docente')" class="btn btn-sm btn-primary" data-dismiss="modal">
                          <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endif ?>
              </td>            
          <?php } ?>
            </tr>
        <?php } ?>
      </tbody>
    </table>
    </div>                                     
  </div>
  <div class="box-footer" align="right">                
    {!! Form::submit('Actualizar',['class'=>'btn btn-primary']) !!}
    <a href="{{route('listadohorariosclase')}}" class="btn btn-default">Cancelar</a>
  </div>
  {!! Form::close() !!}
  <!-- /.box-footer -->   
</div>
@endsection
@section('script')
<script>
  $(document).ready(function(){
    
});
function agregar(id,asignatura,docente){
  //alert(id);
  if($('#'+asignatura+'_'+id).val()!='' && $('#'+docente+'_'+id).val()!=''){
    $('#Lasignatura_'+id).text($('#'+asignatura+'_'+id+' option:selected').html());
    $('#Ldocente_'+id).text($('#'+docente+'_'+id+' option:selected').html());
    $('#spanA_'+id).addClass('label label-primary');
    $('#spanD_'+id).addClass('label label-info');
  }else{
    $('#'+asignatura+'_'+id).val('');
    $('#'+docente+'_'+id).val('');
    $('#Lasignatura_'+id).text('Asignatura');
    $('#Ldocente_'+id).text('Docente');
    $('#spanA_'+id).removeClass('label label-primary');
    $('#spanD_'+id).removeClass('label label-info');
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