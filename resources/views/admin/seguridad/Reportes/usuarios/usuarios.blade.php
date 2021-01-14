<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/php; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Styles -->
  <link href="{{ asset('adminlte/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
  <!--link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet"-->
   <style>
 	body { font-family: DejaVu Sans; }
   
	@page {
      margin: 160px 50px;
    }
	header { 
	  position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #ddd;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    .img-der {
      position: fixed;
      right: 10px;
      top: -150px;
      width: 80px;
      height: 80px;
    }
    .img-izq {
      position: fixed;
      left: 10px;
      top: -150px;
      width: 80px;
      height: 80px;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -120px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }

	</style>
</head>
<body>
	
	<header>
		<h1>Santa María del Camino</h1>
	    <h2>Reporte de Usuarios</h2>
	    <hr>
  	</header>
  	<img class="img-izq" src="{{ asset('imagenes/cho.jpg') }}" />
  	<img class="img-der" src="{{ asset('imagenes/cho.jpg') }}" />
    <div class="container">
	    <div class="row">
			<table class="table table-bordered">
		      <thead>
		      	<tr class="active">
				<th>USUARIO</th>
				<th>CUENTA</th>
				<th>ROLES</th>
				</tr>
			  </thead>
			  <tbody>
			      @foreach($data as $usuario)       
		          <tr>
		            <?php if ($usuario->empleado!=null): ?>
		              <td>{{$usuario->empleado->v_nombres .' '. $usuario->empleado->v_apellidos}}</td>
		            <?php else: ?>
		              <?php if ($usuario->estudiante!=null): ?>
		              <td>{{$usuario->estudiante->v_nombres .' '. $usuario->estudiante->v_apellidos}}</td>
		              <?php else: ?>
		                <td>{{$usuario->familiar->nombres .' '. $usuario->familiar->apellidos}}</td>
		              <?php endif ?>
		            <?php endif ?>                        
		            <td>{{$usuario->name}}</td>
		            <td>
		              @foreach($usuario->usuario_rol as $rol)
		                {{$rol->v_nombrerol}}<br>
		              @endforeach
		            </td>          
		          </tr> 
		          @endforeach
			      </tbody>
			</table>
	    </div>    
  	</div>
	<footer>
  		<table>
      <tr>
        <td>
            <p class="izq">
              {{$today}}
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
    </footer>
	<!--div id="content">
		    <p>
		      Lorem ipsum dolor sit...
		    </p>
		    <p>
		    	Vestibulum pharetra fermentum fringilla...
		    </p>
		    <p style="page-break-before: always;">
		    	Podemos romper la página en cualquier momento...</p>
		    </p>
		    <p>
		    	Praesent pharetra enim sit amet...
		    </p>
		    <p>{{$today}}</p>	    
		</div-->
</body>
</html>