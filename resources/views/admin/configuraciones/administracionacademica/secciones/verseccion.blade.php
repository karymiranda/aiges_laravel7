@extends('admin.menuprincipal') 
@section('tittle','Configuraciones/Administración Académica/Secciones') 

@section('content')
  <div class="box box-primary box-solid">
      <div class="box-header with-border">
          <h3 class="box-title">
            <Strong>VER SECCION</Strong>
          </h3>
          <!--div class="btn-group pull-right">
            <button type="button" class="btn btn-success">Reportes</button>
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <span class="caret"></span>
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                  <a id="verBoleta" href="#">Ver boletas de notas</a>
                </li>
                {{--  --}}
            </ul>
          </div-->
      </div>
      <div class="box-body">
          {!! Form::open(['guardarseccion', 'method'=>'POST',
          'class'=>'form-horizontal']) !!}

          <div class="form-group">
              {!! Form::label('grado', 'Grado',['class'=>'col-sm-4
              control-label']) !!}
              <div class="col-sm-4">
                  {!!
                  Form::select('grado_id',$grados,$seccion->grado_id,['class'=>'form-control','readonly'])!!}
              </div>
          </div>

          <div class="form-group">
              {!! Form::label('seccion', 'Sección',['class'=>'col-sm-4
              control-label']) !!}
              <div class="col-sm-4">
                  {!!
                  Form::text('seccion',$seccion->seccion,['class'=>'form-control
                  pull-right','placeholder'=>'Sección','readonly']) !!}
              </div>
 </div>
 <div class="form-group">
                                                                    
                                              {!! Form::label('seccion', 'Código ',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                                                {!! Form::text('codigo',$seccion->codigo,['class'=>'form-control pull-right','placeholder'=>'Código sección para plantillas SIGES','readonly']) !!}
                                                </div>
                            </div>
          <div class="form-group">
              {!! Form::label('seccion', 'Descripción',['class'=>'col-sm-4
              control-label']) !!}
              <div class="col-sm-4">
                  {!!
                  Form::text('descripcion',$seccion->descripcion,['class'=>'form-control
                  pull-right','placeholder'=>'Descripción ','readonly']) !!}
              </div>
          </div>
          <div class="form-group">
              {!! Form::label('cupomaximo', 'Cupo máximo',['class'=>'col-sm-4
              control-label']) !!}
              <div class="col-sm-4">
                  {!!
                  Form::text('cupo_maximo',$seccion->cupo_maximo,['class'=>'form-control
                  pull-right','placeholder'=>'Cupo máximo','readonly']) !!}
              </div>
 </div>

          <div class="form-group">
              {!! Form::label('seccion', 'Ubicación',['class'=>'col-sm-4
              control-label']) !!}
              <div class="col-sm-4">
                  {!!
                  Form::text('aula_ubicacion',$seccion->aula_ubicacion,['class'=>'form-control
                  pull-right','placeholder'=>'Aula ','readonly']) !!}
              </div>
          </div>

<div class="form-group">
                          {!! Form::label('nivel', 'Nivel *',['class'=>'col-sm-4 control-label']) !!}
                          <div class="col-sm-4">
                          {!! Form::select('nivel',['0'=>'0','1'=>'1','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9'],$seccion->nivel,['class'=>'form-control','required','readonly'=>'true'])!!}
                          </div> 
  </div>

          <div class="form-group">
              {!! Form::label('grado', 'Turnos',['class'=>'col-sm-4
              control-label']) !!}
              <div class="col-sm-4">
                  {!!
                  Form::select('turno_id',$turnos,$seccion->turno_id,['class'=>'form-control','readonly'])!!}
              </div>
          </div>

                 <div class="form-group">                                           
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
            <div class="col-sm-4">
            <div class="checkbox">
          <label><input type="checkbox" name="seccionintegrada"<?php if($seccion->seccionintegrada==1){ ?> checked="checked" value="1" <?php } ?>>Es sección integrada</label>
            </div> 
            </div> 
            </div> 

          <div class="form-group">
              {!! Form::label('asesor', 'Asesor de sección',['class'=>'col-sm-4
              control-label']) !!}
              <div class="col-sm-4">
                  {!!
                  Form::select('empleado_id',$asesor,$seccion->empleado_id,['class'=>'form-control','placeholder'=>'Sin asignar','readonly'])!!}
              </div>
          </div>
      </div>

      <div class="box-footer" align="right">
          <a href="{{ route('listasecciones') }}" class="btn btn-primary"><< Regresar</a>
      </div>
      {!! Form::close() !!}
      
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
        <form action="#" id="selectPeriodo">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Seleccione periodo</h4>
                    </div>
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Periodo</label>
                                <select class="form-control" name="periodo" id="periodo">
                                    @foreach ($periodos as $item)
                                        <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" 
                            class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Ver</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function() {
        $("#verBoleta").click(function(e) {
            $("#modal").modal()
        })

        $("#selectPeriodo").submit(function(e) {
            e.preventDefault();
            $('#modal').modal('hide');
            var valores = $(this).serializeArray();
            window.open("/reportes/notas/boleta/<?php echo $seccion->id ?>/" + valores[0].value,'__blank')
        })
    })
  </script>
@endsection
