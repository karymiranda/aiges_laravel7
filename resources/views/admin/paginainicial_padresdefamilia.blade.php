@extends('admin.menuprincipal')
@section('tittle','Inicio/Familiares')
@section('content')
<section class="content">
       <div class="row">
        <!--div class="col-md-3">
         
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img src="{{ asset('/imagenes/Administracionacademica/Padresdefamilia/'.Auth::user()->foto)}}" class="profile-user-img img-responsive img-circle" alt="User profile picture">    
              <h3 class="profile-username text-center">{{Auth::user()->familiar->nombres}} {{Auth::user()->familiar->apellidos}}</h3>
              <p class="text-muted text-center">Miembro circulo familiar</p>

                <li class="list-group-item">
                  <b><i class="fa fa-folder-open-o"></i>Dirección</b> <a class="pull-right">{{Auth::user()->familiar->direccion}}</a>
                </li>
                  <li class="list-group-item">
                  <b><i class="fa fa-phone"></i> Teléfono</b> <a class="pull-right">{{Auth::user()->familiar->celular}}</a>
                </li>                
                <li class="list-group-item">
                  <b><i class="fa  fa-envelope-o"></i> Correo electrónico</b> <a class="pull-right">{{Auth::user()->familiar->correo}}</a>
                </li>
               
              </ul>

              <a href="{{route('verexpedienteonline',Auth::user()->familiar->id)}}" class="btn btn-primary btn-block"><b>Ver expediente completo</b></a>
              <a href="{{route('estudiantes_familiares',Auth::user()->familiar->id)}}" class="btn btn-warning btn-block"><b>Mis estudiantes</b></a>
            </div>
           
          </div>
         

        </div-->
       
        <div class="col-md-12"><!-- /inicia slide -->
          <div id="myCarouselCustom" class="carousel slide" data-ride="carousel">
  
    <ol class="carousel-indicators">
        <li data-target="#myCarouselCustom" data-slide-to="0" class="active"></li>
        <li data-target="#myCarouselCustom" data-slide-to="1"></li>
        <li data-target="#myCarouselCustom" data-slide-to="2"></li>
    </ol>
   
    <div class="carousel-inner">
        <div class="item active">
        <?php	if(Auth::user()->empleado!=null){ //empleado ?>
		   <img src="{{ asset('/imagenes/slides/e1.jpg') }}" alt="">  
		<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
			<img src="{{ asset('/imagenes/slides/a1.jpg') }}" alt="">
		<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
			<img src="{{ asset('/imagenes/slides/f1.jpg') }}" alt="">

		<?php } ?>	            
         
        </div>
  
        <div class="item">
            <?php	if(Auth::user()->empleado!=null){ //enpleado ?>
			   <img src="{{ asset('/imagenes/slides/e2.jpg') }}" alt="">  
			<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
				<img src="{{ asset('/imagenes/slides/a2.jpg') }}" alt="">
			<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
				<img src="{{ asset('/imagenes/slides/f2.jpg') }}" alt="">
			<?php } ?>
          
        </div>
        
        <div class="item">
            <?php	if(Auth::user()->empleado!=null){ //enpleado ?>
			   <img src="{{ asset('/imagenes/slides/e3.jpg') }}" alt="">  
			<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
				<img src="{{ asset('/imagenes/slides/a3.jpg') }}" alt="">
			<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
				<img src="{{ asset('/imagenes/slides/f3.jpg') }}" alt="">
			<?php } ?>
            
        </div>
    </div>

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

 </div>
</div>
<!--fin del php while--> 
</div><!--fin col de estudiantes-->

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