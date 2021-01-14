@extends('admin.menuprincipal')
@section('tittle','Administración Académica/Consultas')
@section('content') 

<div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">BUSQUEDA AVANZADA</label></h2>
              </div>
            </div> 

             <div class="box-body">
              {!! Form::open(['method'=>'GET','id'=>'formulariorpt','class'=>'form-horizontal','target'=>'blank']) !!}

            
        <div class="form-group">                       
             <div class="col-sm-3">
          {!! Form::label('', 'Todos',['class'=>'col- control-label']) !!}

          {!! Form::radio('estudiantegrado','Todos',false, ['id'=>'criteriogradoT','value'=>'criteriogradoT'])!!}
          {!! Form::label('', 'Por grado',['class'=>'control-label']) !!}
          {!! Form::radio('estudiantegrado','Por grado',true, ['id'=>'criteriogradoG','value'=>'criteriogradoG'])!!} 
              </div>                                              
          </div>

          <button id="b">pruea</button>

 
          </div><!--fin box body-->

        </div><!--fin box-->
 {!! Form::close() !!}
           
@endsection
@section('script')
<script type="text/javascript">

$('#criteriogradoT').on('click', function(e){
alert('si');
});

$('#estudiantegrado').on('change', function(e){
alert('garado');
});

$('#b').on('click', function(e){
alert('si');
});

    

</script>

@endsection
