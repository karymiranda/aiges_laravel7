@extends('admin.menuprincipal')
@section('tittle','Configuraciones/Administración Académica/Calificaciones/Evaluaciones')
@section('content') 
<div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
        <h2> <label class="text-primary">EVALUACIONES</label></h2>
              </div>
              <div class="col-sm-8" align="right">       
            
                <!--a href="{{route('agregarevaluacionesperiodo')}}" class="btn btn-primary">Registrar evaluación</a-->
          </div>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="" style="width: 60%" align="center">
                <thead>
                <th>CODIGO</th> 
                <th>NOMBRE EVALUACION</th>                
                <th>PONDERACION</th>                                         
                </thead>
                <tbody>                 
                   @foreach($eval as $evaluacion)                   
                <tr>  
                 <td>{{$evaluacion->codigo_eval}}</td>
                 <td>{{$evaluacion->nombre}}</td>
                 <td>{{$evaluacion->d_porcentajeActividad}} % </td> 
               </tr>             
              @endforeach
                </tbody>               
              </table> 
            </div> 
          </div>

          <div class="modal fade" id="evaluacion">
                <div class="modal-dialog">
                  <div class="modal-content">
       <div class="modal-header primary">
       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       <h4 class="modal-title">ACTUALIZAR EVALUACION</h4>
       </div> 
        <form method="GET" action="" id="form-modal" class="form-horizontal"> 
                    <div class="modal-body">
                    
                    <div class="form-group col-sm-12">
                    {!! Form::label('evaluacion', 'Código ',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-8"  style="width: 100%" >
                     {!! Form::text('codigo_eval',null,['class'=>'form-control pull-right','placeholder'=>'Código evaluación','required','id'=>'codigo_eval']) !!}
                    </div>
                    </div> 
                     <div class="form-group col-sm-12">
                    {!! Form::label('nombre', 'Nombre ',['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-8"  style="width: 100%">
                     {!! Form::text('nombre',null,['class'=>'form-control pull-right','placeholder'=>'Código evaluación','required','id'=>'codigo_eval']) !!}
                    </div>
                    </div> 
                <div class="form-group col-sm-12">
                {!! Form::label('', 'Ponderación',['class'=>'col-sm-2 control-label']) !!}
               <div class="col-sm-8" style="width: 100%">
                 {!! Form::select('d_porcentajeActividad',['10'=>'10%','15'=>'15%','20'=>'20%','25'=>'25%','30'=>'30%','35'=>'35%','40'=>'40%','45'=>'45%','50'=>'50%'],null,['class'=>'form-control','id'=>'d_porcentajeActividad'])!!} 
                 </div>
                 </div> 
                    
                 </div>
         <div class="modal-footer">       
       <button type="button" class="btn btn-primary" id="btn-actualizar"> Actualizar</button>
       <button type="button" class="btn btn-default cancel-btn" data-dismiss="modal">Cancelar</button>       
        </div> 
      </form>
      </div>
     </div>
   </div>           

@endsection
