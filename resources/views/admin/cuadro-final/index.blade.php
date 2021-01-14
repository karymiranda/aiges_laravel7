@extends('admin.menuprincipal')
@section('tittle','Cuadro Final')
@section('content')

<div class="box box-primary">
 
@if ($message = Session::get('success'))
  <div class="alert alert-success alert-block">
    <strong>{{ $message }}</strong>
  </div>
@endif
 
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
  <strong>{{ $message }}</strong>
</div>
@endif

<style type="text/css">
  .red { background-color: red !important; } .green { background-color: lime !important; }
</style>


  <div class="box-header">
    <div class="col-sm-12">
      <h3 class="text-primary">
       CUADRO FINAL
        @if (!$is_data)
          <form action="{{ route('cuadroFinal.store') }}" method="post" class="pull-right">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}" />
            <button type="submit" class="btn btn-primary" >Generar</button>
          </form>
        @else
          <div class="pull-right">
            <div class="btn-group">
 
              <button id="recalcularcuadro" class="btn btn-success" type="button">Actualizar Cuadro Final</button>
              <button id="expediente1" class="btn btn-success" type="button">Cerrar expedientes</button>
              <button id='generateEstadistica' class="btn btn-success" type="button">Generar estadistica</button>

              <a target="__blank" href="{{ route('ver-cuadro', ['id' => $id ]) }}" class="btn btn-success">Ver Cuadro Final</a> 
               
     <a class="btn btn-success" data-toggle="modal" title="Deshabilitar" data-target="#deshabilitar">Cerrar sección</a>
     <!-- /modal deshabilitar -->
<div class="modal fade" id="deshabilitar">
          <div class="modal-dialog">
            <div class="modal-content">             
   <form class="form-horizontal" method="GET" action="{{route('cerrarSeccion',$id)}}" >
    {!! csrf_field() !!}    
   <input type="hidden" name="id" value={{$id}}>
   <div class="modal-header danger">
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">×</span></button>
  <h4 class="modal-title">CIERRE DE SECCION</h4>
    </div>

      <div class="modal-body">
      <p style="color: black;font-size: 18px">Con el cierre de sección se deshabilitará el acceso a ingreso de matriculas,calificaciones,nóminas y asistencia. ¿Desea continuar?</p>                                                                    
    </div>
      <div class="box-footer" align="right">


      <input type="submit" value="Si" class="btn btn-sm btn-danger delete-btn">
       <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
      </div>
       </form>  
        </div>                
     </div>
     </div> 
<!-- / finmodal-dialog --> 



            </div>
          </div>
        @endif
      </h3>
    </div>
  </div>

  
  <div class="box-body table-responsive">
    <form id="frm" name="frm">

      <div class="form-group">
        {!! Form::label('', '', ['class'=>'col-sm-5 control-label']) !!}
        <div class="col-sm-3">
          {!! Form::select('seccion_id',$seccion, null, ['class'=>'form-control','required','readonly'])!!}
        </div>
      </div>

      <table class="table table-bordered table-striped">
        <thead>
          <th></th>
          <th style="width: 50px">No</th>
          <th style="width: 100px">NIE</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th class="text-center">Lenguaje</th>
          <th class="text-center">Matemática</th>
          <th class="text-center">Ciencia</th>
          <th class="text-center">Sociales</th>
          <th class="text-center">Artística/Inglés</th>
          <th class="text-center">Física</th>
          <th class="text-center">Convivencia, Moral y Cívica</th>
        </thead>
        <tbody>
          @foreach ($students as $index => $item)
            @php
              $class = ($item->reprobado) ? 'red' : 'green';
            @endphp
            <tr class="{{ $class }}">
              <td>
               <!--    <input type="checkbox" name="aprobado[]" value="{{ $item->alumno_id }}" />
                  <input type="hidden" name="v_students[]" value="{{ $item->alumno_id }}">-->
            
             @if (!$item->reprobado)
                  <input type="checkbox" name="aprobado[]" value="{{ $item->alumno_id }}" checked="true"  />
            @elseif($item->reprobado)
             <input type="checkbox" name="reprobado[]" value="{{ $item->alumno_id }}" checked="true" />
            @endif
                  <input type="hidden" name="v_students[]" value="{{ $item->alumno_id }}">
             
              </td>
              <td>{{ $index + 1 }}</td>
              <td>{{ $item->v_nie }}</td>
              <td>{{ $item->v_apellidos }}</td>
              <td>{{ $item->v_nombres }}</td>
              <td class="text-center">{{ $item->lenguaje }}</td>
              <td class="text-center">{{ $item->matematica }}</td>
              <td class="text-center">{{ $item->ciencia }}</td>
              <td class="text-center">{{ $item->sociales }}</td>
              <td class="text-center">
                @if ($item->ingles)
                  {{ $item->ingles }}
                @else
                  {{ $item->artistica }}
                @endif
              </td>
              <td class="text-center">{{ $item->fisica }}</td>
              <td class="text-center">{{ $item->urbanida }}</td>
            </tr> 
          @endforeach
        </tbody>
      </table>
    </form>    
</div>


<div class="modal fade" id="modal-errorcierreexpedientes">
          <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-horizontal" method="GET">
                <div class="modal-header danger">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">CIERRE DE EXPEDIENTES</h4>
                </div>
  <div class="modal-body">           
   
    <p>Lo sentimos pero debe seleccionar al menos un alumno para realizar el cierre de expediente.</p>
   
  </div>

  <div class="box-footer" align="right">
       <button type="button" class="btn btn-sm btn-danger cancel-btn" data-dismiss="modal">Cerrar</button>
  </div>
          </form>
        </div>                
     </div>
     </div> 

<!-- /.modal-dialog -->


<div class="modal fade" id="modal-expedientes">
          <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-horizontal" method="GET">
                <div class="modal-header success">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">CIERRE DE EXPEDIENTES</h4>
                </div>
  <div class="modal-body">           
   
    <p>Cierre de expedientes estudiantiles realizado con éxito.</p>
   
  </div>

  <div class="box-footer" align="right">
       <button type="button" class="btn btn-sm btn-success cancel-btn" data-dismiss="modal">Cerrar</button>
  </div>
          </form>
        </div>                
     </div>
     </div> 

<!-- /.modal-dialog -->





<div class="modal fade" id="modal-primary">
          <div class="modal-dialog">
            <div class="modal-content">
              <form class="form-horizontal" method="GET">
                <div class="modal-header success">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">ESTADISTICAS</h4>
                </div>
  <div class="modal-body">           
   
    <p>Estadísticas de matricula escolar generadas con éxito.</p>
   
  </div>

  <div class="box-footer" align="right">
       <button type="button" class="btn btn-sm btn-success cancel-btn" data-dismiss="modal">Cerrar</button>
  </div>
          </form>
        </div>                
     </div>
     </div> 

<!-- /.modal-dialog -->
<div class="box-footer" align="right">                
      <!--a href="{{route('listasecciones')}}" class="btn btn-default">Regresar</a-->
  </div>
@endsection

@section('script')
<meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="text/javascript">  
    
    $(document).on('ready', function() {   
      var url = "/aiges/public/cuadroFinal/";
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
    });


      $("#recalcularcuadro").on('click', function(e) {
        //alert('recalcular')
var url = "/aiges/public/cuadroFinal/";
  $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

       $.post({         
          url: url+'eliminarCuadro/'+<?=$id?>,
          data: { 'seccion': <?=$id?> }
        }).then(function(results) {
         window.location.reload();
        });
      });

      
      $("#expediente1").on('click', function(e) {

          var elements = $("#frm input:checked");
          var url = "/aiges/public/cuadroFinal/";
           $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

        if(elements.length > 0) {
          $.post({
            url:url + "closeexpedient",
            data: elements
          }).then(function(results) {
              $("#modal-expedientes").modal('show'); 
            window.location.reload();
          });
        } else {

          $("#modal-errorcierreexpedientes").modal('show'); 
          //alert('Lo sentimos pero debe seleccionar por lo menos un alumno para hacer el cierre')
        }
      });

      
      $("#generateEstadistica").on('click', function() {
        var url = "aiges/public/index.php/cuadroFinal/";
         $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $.post({
          url:  'getEstadistica',
          data: { 'seccion': <?=$id?> }
        }).then(function() {
          //alert('Estadística generada con exito!')
        $("#modal-primary").modal('show');   
        })
      });

  </script>
@endsection