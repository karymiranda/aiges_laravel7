@extends('admin.menuprincipal')
@section('tittle', 'Configuraciones/Administración Académica/Asignaturas')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>REGISTRAR ASIGNATURA</Strong></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
      @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
              <div class="box-body">
                  {!! Form::open(['route'=>'guardarasignatura', 'method'=>'POST', 'class'=>'form-horizontal']) !!}


                 <div class="form-group">                                           
                                                {!! Form::label('Asignatura', 'Asignatura',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                                                {!! Form::text('asignatura',null,['class'=>'form-control pull-right','placeholder'=>'Nombre de asignatura [requerido]','required']) !!}
                                                </div>
                </div>



    <div class="form-group">                                           
                              {!! Form::label('Código', 'Código',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-5">
                              {!! Form::text('descripcion',null,['class'=>'form-control pull-right','placeholder'=>'Código para plantilla SIGES [requerido]','required']) !!}
                                                </div>
                </div>
                
        <div class="form-group">                                           
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
        {!! Form::checkbox('tercerciclo', '0',false,['id'=>''])!!}
        {!! Form::label('lb', 'Es asignatura de tercer ciclo',['class'=>'control-label']) !!}<br> 
          </div> 
          </div>
            
        <div class="form-group">                                         
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-5">
        {!! Form::checkbox('is_cuadro','0',false,['id'=>'super'])!!}
        {!! Form::label('lb', 'Es asignatura de cuadro final',['class'=>'check']) !!}<br> 
          </div> 
          </div>

 <div   id="datoscuadrofinal">     
              <div class="form-group">                                           
                     {!! Form::label('', 'Nombre corto',['class'=>'col-sm-4 control-label']) !!}
                    <div class="col-sm-5">
                      {!! Form::text('name_short',null,['class'=>'form-control pull-right','placeholder'=>'Nombre corto con el que aparecerá ésta asignatura en el cuadro final','id'=>'name_short']) !!}
              </div>
  </div>

            
            <div class="form-group">                                           
                     {!! Form::label('', 'Orden',['class'=>'col-sm-4 control-label']) !!}
                    <div class="col-sm-5">
                      {!! Form::text('orden',null,['class'=>'form-control pull-right','placeholder'=>'Orden en que aparecerá la asignatura en el cuadro final','id'=>'orden']) !!}
                   </div>
                </div>
 </div>


                                           
          </div>        
         <div class="box-footer" align="right">                
        {!! Form::submit('Guardar',['class'=>'btn btn-primary ']) !!}
         <a href="{{route('listaasignaturas')}}" class="btn btn-default">Cancelar</a>
        </div>

        {!! Form::close() !!}
              <!-- /.box-footer -->
           
          </div>

@endsection

@section('script')
 <script> 
  $('#super').change(function() {
          if(this.checked) {            
              $('.check').prop('checked', false);
              //('#name_short').Attr('required','true');
              //('#orden').Attr('required','true');
          }      
      });
     /* $('.check').change(function() {
          if(this.checked) {            
              $('#super').prop('checked', false);
              ('#datoscuadrofinal').setAttr('hidden');
          }      
      });*/
    </script>
@endsection
 
