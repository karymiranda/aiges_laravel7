@extends('admin.menuprincipal')
@section('tittle','Bono escolar/Transacciones/Historial')
@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-12" align="center">
              <h2> <label class="text-primary">CONTROL DE TRANSACCIONES / {{$ejercicio->nombre}} </label></h2>
              </div>

                <div class="col-sm-12" align="right">
                <a class="btn btn-primary" data-toggle="modal" data-target="#modal-agregar">Registrar Transacción</a>
                </div>
            </div>

   <div class="box-body" >
    {!! Form::open(['route'=>'agregaringresos', 'method'=>'POST', 'class'=>'form-horizontal']) !!}
 <div class="form-group"> 
                                                                                        
  </div>
           
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered table-striped" id="tablaBusqueda">
                <thead>
                <tr> 
                <th>No.</th>                  
                  <th>FECHA</th> 
                  <th>CONCEPTO</th>
                  <th>CHEQUE</th>
                  <th>INGRESOS</th>                               
                 <th>GASTOS</th>
                   <th>SALDOS</th>
                   <th>ACCIONES</th>
                </tr></thead>
                <tbody>
                @foreach($datos as  $key => $datos)                   
                <tr id={{$datos->id}}> 
                 <td>{{$key+1}}</td>  
                 <td>{{$datos->fecha_transaccion}}</td> 
                 <td>{{$datos->concepto}}</td>
                 @if($datos->tipo_transaccion=="INGRESO") 
                 <td>N/A</td> 
                 <td>$ {{number_format($datos->ingreso,2)}}</td>
                 <td>-</td>                  
                 <td>$ {{number_format($datos->saldo_bancos,2)}}</td>  
                 @elseif($datos->tipo_transaccion=="GASTO")
                  <td>{{$datos->numero_cheque}}</td>
                  <td>-</td>
                  <td>$ {{number_format($datos->gasto,2)}}</td>
                  <td>$ {{number_format($datos->saldo_bancos,2)}}</td> 
                  @else
                 <td>{{$datos->numero_cheque}}</td> 
                 <td>-</td>
                 <td>-</td>
                 <td>-</td>  
                 @endif
                 <td>
                   <a href="{{route('vertransaccion',$datos->id)}}" class="btn btn-primary" <?php if($datos->tipo_transaccion=='ANULADO'){?>disabled="true"<?php } ?>><i class="fa fa-eye"></i></a>
                    <a href="{{route('editartransaccion',$datos->id)}}"  title="Editar" class="btn btn-success"><i class="fa fa-edit"></i></a>                   
        <a class="btn btn-danger" data-toggle="modal"  title="Eliminar" data-target="#ingreso_{{$datos->id}}" >
                <i class="fa fa-close"></i>
              </a>
              <div class="modal fade" id="ingreso_{{$datos->id}}">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header danger">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      <h4 class="modal-title">CONFIRMAR ACCION</h4>
                    </div>
                    <div class="modal-body">
                      <p>¿Está seguro, desea eliminar la trasacción {{$datos->concepto}}?</p>
                    </div>
                    <div class="modal-footer">
                      <form method="GET" action="{{route('eliminartransaccion',$datos->id)}}" id="form-eliminar">
                        <input type="hidden" name="id" value="{{$datos->id}}">
                        <input type="submit" value="Eliminar"  class="btn btn-sm btn-danger delete-btn">                               
                        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              </td>    
               </tr>             
              @endforeach
              </tbody>
            </table>
            </div>
   {!! Form::close() !!}
  
     </div>

           <!-- /.box-footer -->
<div class="modal fade" id="modal-agregar">
          <div class="modal-dialog">
            <div class="modal-content">
             
   <form class="form-horizontal" id="formulario" method="POST">
  <input type="hidden" name="idejercicio" id="idejercicio" value="{{$ejercicio->id}}">
   @csrf
                <div class="modal-header primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">REGISTRAR TRANSACCION</h4>
                </div>

      <div class="modal-body">           
            <div class="form-group">                                         
              {!! Form::label('', 'Tipo de transacción',['class'=>'col-sm-4 control-label']) !!}
               <div class="col-sm-7">
                 {!! Form::select('tipo_transaccion',['1'=>'INGRESO','2'=>'GASTO','3'=>'DOCUMENTO NULO'],null,['class'=>'form-control','id'=>'tipo_transaccion'])!!}
              </div>        
              </div>
   
     <div class="form-group">
      {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
       <div class="col-sm-7">
  {!! Form::checkbox('opyfuncionamientoSN','S', false,['class'=>'check','id'=>'checkOP'])!!}
  {!! Form::label('doc', 'Operación y funcionamiento',['class'=>'control-label']) !!}              
       </div> 
      </div> 
        <div class="form-group">
          {!! Form::label('', '',['class'=>'col-sm-4 control-label']) !!}
       <div class="col-sm-7">
       {!! Form::select('fondodisponible_id',$fondodisponible_id, null,['class'=>'form-control','id'=>'fondodisponible_id','readonly'=>'true'])!!}
      </div>
 </div>
      </div>

        <div class="box-footer" align="right">
        <button type="button" class="btn btn-sm btn-primary"  id="btn-agregar" >Agregar</button>
        <button type="button" class="btn btn-sm btn-default cancel-btn" data-dismiss="modal">Cancelar</button>
            </div>
       </form>  
        </div>                
     </div>
     </div> 

<!-- /.modal-dialog -->

@endsection
@section('script')
<script>
  $('#btn-agregar').on('click', function(){
  switch($('#tipo_transaccion').val())
  {
    case'1'://INGRESO//
    $('#formulario').attr('action', '{{url('')}}/admin/agregaringresos'); 
    break;     

  case'2'://GASTO
  $('#formulario').attr('action', '{{url('')}}/admin/agregargastos');
  break;

   case'3'://CHEQUE NULO
  $('#formulario').attr('action', '{{url('')}}/admin/agregardocumentonulo');
 // $('#formulario').submit();
  break;   
 }
  $('#formulario').submit();
  });

</script>
@endsection

