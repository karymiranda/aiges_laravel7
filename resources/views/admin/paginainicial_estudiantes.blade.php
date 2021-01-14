@extends('admin.menuprincipal')
@section('tittle','Inicio')
@section('content')
<section class="content">

       <div class="row">
        <!--div class="col-md-3">

         
          <div class="box box-primary">
            <div class="box-body box-profile">
            	 <img src="{{ asset('/imagenes/Administracionacademica/Estudiantes/'.Auth::user()->foto) }}" class="profile-user-img img-responsive img-circle" alt="User profile picture"> 

              <h3 class="profile-username text-center">{{Auth::user()->estudiante->v_nombres}} {{Auth::user()->estudiante->v_apellidos}}</h3>

              <p class="text-muted text-center">Estudiante</p>

              <ul class="list-group list-group-unbordered">
              	 <li class="list-group-item">
                  <b><i class="fa fa-graduation-cap"></i> NIE</b> <a class="pull-right">{{Auth::user()->estudiante->v_nie}}</a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-folder-open-o"></i> Expediente</b> <a class="pull-right">{{Auth::user()->estudiante->v_expediente}}</a>
                </li>
                  <li class="list-group-item">
                  <b><i class="fa fa-phone"></i> Teléfono</b> <a class="pull-right">{{Auth::user()->estudiante->v_telCasa}}</a>
                </li>                
                <li class="list-group-item">
                  <b><i class="fa  fa-envelope-o"></i> Correo</b> <a class="pull-right">{{Auth::user()->estudiante->v_correo}}</a>
                </li>
               
              </ul>

              <a href="{{route('verexpedienteonline',Auth::user()->estudiante->id)}}" class="btn btn-primary btn-block"><b>Ver expediente completo</b></a>
            </div>
           
          </div-->
          <!-- /.box -->




<!-- About Me Box -->
          <!--div class="box box-primary"-->
            <!--div class="box-header with-border">
              <h3 class="box-title">Acerca de mi</h3>
            </div-->
            
            <!--div class="box-body">
            	 <strong><i class="fa fa-calendar margin-r-5"></i> Fecha nacimiento</strong>
              <p class="text-muted">
               {{Auth::user()->estudiante->f_fnacimiento}}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i> Ingreso al Centro Educativo</strong>
              <p class="text-muted">
               {{Auth::user()->estudiante->f_fechaIngresoCE}}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>

              <p class="text-muted">{{Auth::user()->estudiante->v_direccion}}</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Sacramentos recibidos</strong>

              <p>
              <span class="label label-warning">{{Auth::user()->estudiante->sacramentos}}</span>
              </p>

            </div>
          
          </div>
         
        </div-->
     




   <div class="col-md-12"><!-- /inicia slide -->
          <div id="myCarouselCustom" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarouselCustom" data-slide-to="0" class="active"></li>
        <li data-target="#myCarouselCustom" data-slide-to="1"></li>
        <li data-target="#myCarouselCustom" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
        <?php	if(Auth::user()->empleado!=null){ //empleado ?>
		   <img src="{{ asset('/imagenes/slides/e1.jpg') }}" alt="">  
		<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
			<img src="{{ asset('/imagenes/slides/a1.jpg') }}" alt="">
		<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
			<img src="{{ asset('/imagenes/slides/f1.jpg') }}" alt="">

		<?php } ?>	            
            <!--div class="carousel-caption">
                <h3>First Slide</h3>
                <p>This is the first image slide</p>
            </div-->
        </div>
  
        <div class="item">
            <?php	if(Auth::user()->empleado!=null){ //enpleado ?>
			   <img src="{{ asset('/imagenes/slides/e2.jpg') }}" alt="">  
			<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
				<img src="{{ asset('/imagenes/slides/a2.jpg') }}" alt="">
			<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
				<img src="{{ asset('/imagenes/slides/f2.jpg') }}" alt="">
			<?php } ?>
            <!--div class="carousel-caption">
                <h3>Second Slide</h3>
                <p>This is the second image slide</p>
            </div-->
        </div>
        
        <div class="item">
            <?php	if(Auth::user()->empleado!=null){ //enpleado ?>
			   <img src="{{ asset('/imagenes/slides/e3.jpg') }}" alt="">  
			<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
				<img src="{{ asset('/imagenes/slides/a3.jpg') }}" alt="">
			<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
				<img src="{{ asset('/imagenes/slides/f3.jpg') }}" alt="">
			<?php } ?>
            <!--div class="carousel-caption">
                <h3>Third Slide</h3>
                <p>This is the third image slide</p>
            </div-->
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" id="prevSlide" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" id="nextSlide" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
      
      
      </div>
    </section>
@endsection

@section('script')

<script type="text/javascript">
// Call carousel manually
$('#myCarouselCustom').carousel();

$("#prevSlide").click(function(){
    $("#myCarouselCustom").carousel("prev");
});
// Go to the previous item
$("#nextSlide").click(function(){
    $("#myCarouselCustom").carousel("next");
});

$('.carousel').carousel({
     interval: 2000,
     wrap:false
});
</script>
<style type="text/css">
.carousel-inner > .item > img {
  margin: 0 auto;
}
#prevSlide, #nextSlide{
    cursor: pointer;
}

</style>
       
@endsection