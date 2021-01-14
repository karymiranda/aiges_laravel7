@extends('admin.menuprincipal')
@section('tittle', 'Recurso Humano/Estudios y Capacitaciones')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><Strong>ACTUALIZAR ESTUDIOS Y CAPACITACIONES</Strong></h3>
            </div>

             @if(count($errors) > 0)
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
            <!-- /.box-header -->
            <!-- form start -->
           
              <div class="box-body">

                  {!! Form::open(['route'=>'actualizarestudios', 'method'=>'PUT', 'class'=>'form-horizontal']) !!}

   <input type="hidden" name="id" id="id" value="{{$estudios->id}}">  
     <div class="form-group">                                           
        {!! Form::label('lbtipocontrato', 'Tipo de estudio / capacitación *',['class'=>'col-sm-4 control-label']) !!}
        <div class="col-sm-4">
          {!! Form::select('tipoestudio',['Educación básica'=>'Educación básica','Educación media'=>'Educación media','Educación superior'=>'Educación superior','Cursos Libres'=>'Cursos Libres','Capacitación'=>'Capacitación','Diplomado'=>'Diplomado','Taller'=>'Taller'], $estudios->tipoestudio,['class'=>'form-control'])!!}
        </div>
      </div>


                 <div class="form-group">                                           
                {!! Form::label('institucion', 'Institución *',['class'=>'col-sm-4 control-label']) !!}
                                                <div class="col-sm-4">
                {!! Form::text('institucion',$estudios->institucion,['class'=>'form-control pull-right','placeholder'=>'Institución donde realizó el estudio','required']) !!}
                                                </div>
                </div>

               <div class="form-group">                  
                {!! Form::label('titulo', 'Título obtenido',['class'=>'col-sm-4 control-label']) !!}
                         <div class="col-sm-4">
                  {!! Form::text('titulo',$estudios->titulo,['class'=>'form-control pull-right','placeholder'=>'Título obtenido al finalizar estudio']) !!}
                                                </div>
                </div>


             <div class="form-group">          
          {!! Form::label('lblfec', 'Año inicio *',['class'=>'col-sm-4 control-label']) !!}
                          <div class="col-sm-4">

                     <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                       <input type="text" name="anioinicio" value="{{$estudios->anioinicio}}" class="form-control pull-right rangoPastYear" data-mask required="true" class="form-control pull-right" required="true">
                                </div>
                           </div>
               
 			</div>   




             <div class="form-group">          
          {!! Form::label('lblfec', 'Año finalización *',['class'=>'col-sm-4 control-label']) !!}
                          <div class="col-sm-4">

                     <div class="input-group date">
                                  <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                  </div>
                       <input type="text" name="aniofin" value="{{$estudios->aniofin}}"  class="form-control pull-right rangoPastYear" data-mask required="true" class="form-control pull-right" required="true">
                                </div>
                           </div>
               
 			</div>

                  <div class="form-group">                  
                {!! Form::label('titulo', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
                <div class="col-sm-4">
                {!! Form::textarea('observaciones',$estudios->observaciones,['class'=>'form-control pull-right','placeholder'=>'Observaciones']) !!}
                  </div>
                </div> 
                 
                 
                                           
          </div>
              <div class="box-footer" align="right">                
                 {!! Form::submit('Actualizar',['class'=>'btn btn-primary ']) !!}
                  <a href="{{route('estudiosycapacitacionesrrhh',$estudios->empleado_id)}}" class="btn btn-default">Cancelar</a>
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
           
          </div>

@endsection
