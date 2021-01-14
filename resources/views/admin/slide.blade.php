@extends('admin.menuprincipal')
@section('tittle','')
@section('content')

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
            <p>CONTENIDO PARA DOCENTE </p>
		   <img src="{{ asset('/imagenes/slides/e1.jpg') }}" alt="">  
		<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
             <p>CONTENIDO PARA ESTUDIANTE</p>
			<img src="{{ asset('/imagenes/slides/a1.jpg') }}" alt="">
		<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
             <p>CONTENIDO PARA FAMILIAR</p>
			<img src="{{ asset('/imagenes/slides/f1.jpg') }}" alt="">

		<?php } ?>	            
            <div class="carousel-caption">
                <h3>First Slide</h3>
                <p>This is the first image slide</p>
            </div>
        </div>
  
        <div class="item">
            <?php	if(Auth::user()->empleado!=null){ //enpleado ?>
			   <img src="{{ asset('/imagenes/slides/e2.jpg') }}" alt="">  
			<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
				<img src="{{ asset('/imagenes/slides/a2.jpg') }}" alt="">
			<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
				<img src="{{ asset('/imagenes/slides/f2.jpg') }}" alt="">
			<?php } ?>
            <div class="carousel-caption">
                <h3>Second Slide</h3>
                <p>This is the second image slide</p>
            </div>
        </div>
        
        <div class="item">
            <?php	if(Auth::user()->empleado!=null){ //enpleado ?>
			   <img src="{{ asset('/imagenes/slides/e3.jpg') }}" alt="">  
			<?php }elseif (Auth::user()->estudiante!=null) {//estudiante ?>
				<img src="{{ asset('/imagenes/slides/a3.jpg') }}" alt="">
			<?php }elseif (Auth::user()->familiar!=null) {//familiar ?>
				<img src="{{ asset('/imagenes/slides/f3.jpg') }}" alt="">
			<?php } ?>
            <div class="carousel-caption">
                <h3>Third Slide</h3>
                <p>This is the third image slide</p>
            </div>
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
     interval: 8000,
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