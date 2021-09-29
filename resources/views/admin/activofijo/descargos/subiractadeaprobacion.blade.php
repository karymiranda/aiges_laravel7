@extends('admin.menuprincipal')
@section('tittle','Administración activo fijo/Acta de aprobación')
@section('content')

<div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">SUBIR ACTA DE APROBACIÓN </Strong></h3>
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
                 {!! Form::open(['route'=>'guardaractadeaprobacion', 'method'=>'POST', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

    <input type="hidden" name="id" value="{{$solicitud->id}}" >         

    <div class="col-sm-12 box-body">

    	<div class="form-group">                          
          {!! Form::label('lbid', 'Número de solicitud *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::text('txtsolicitud',$solicitud->numsolicitud,['class'=>'form-control pull-right','id'=>'solicitud','placeholder'=>'Solicitud','readonly','required']) !!}
          </div>
    </div><!--fin form group-->


      <div class="form-group">                                           
          {!! Form::label('fecha', 'Fecha de aprobación *',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4"> 
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              {!! Form::text('f_fechaaprobacion',$hoy,['class'=>'form-control pull-right calendario','data-mask'=>'','placeholder'=>'Fecha de aprobación'],'required') !!}
            </div> 
    </div>
     </div>



           <div class="form-group">
                  {!! Form::label('lbfoto', 'Acta de aprobación',['class'=>'col-sm-4 control-label']) !!}

    <div class="col-sm-6">                   
    <input type="file" id="files" name="files[]" multiple accept="image/jpeg,image/png,application/pdf" required="true" /> 
                  
    <output id="list"></output>                 
                  </div>               
                </div>
  <div class="form-group">                          
          {!! Form::label('lbid', 'Observaciones',['class'=>'col-sm-4 control-label']) !!}
          <div class="col-sm-4">
            {!! Form::textarea('observaciones',null,['class'=>'form-control pull-right','id'=>'solicitud','rows'=>'2','placeholder'=>'Observaciones de descargo']) !!}
          </div>
    </div><!--fin form group-->
              
            </div>

           </div>

       <script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {

      output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                  f.size, ' bytes, última modificación: ',
                  f.lastModifiedDate.toLocaleDateString(), '</li>');
    }
    document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';
  }

  document.getElementById('files').addEventListener('change', handleFileSelect, false);
</script>

       </script>

              <div class="box-footer" align="right">                
                 {!! Form::submit('Subir',['class'=>'btn btn-primary ']) !!}  
                  <a href="{{route('descargopendientedeaprobar')}}" id="btnCancelar" class="btn btn-default">Cancelar</a>           
                  
              </div>

                {!! Form::close() !!}
              <!-- /.box-footer -->
           
          </div>

 @endsection


  

