@extends('layouts.app')


@section('contenido_js')
    
@endsection

@section('contenido_cSS')


        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }} ">
        
        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }} ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }} ">
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
@endsection


@section('content')
<head>
    


  </head>
  <body>
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Servicios</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
              
                @foreach($allServices as $service)
                    <div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper" style="height: 150px !important">
                            @if($service->imagen!=null)
                                
                            <img src="{{ $service->imagen }}" alt="" style="height: 150px !important">
                            
                            @else
                                <img src="img/product-0.jpg" alt="">
                            @endif
                            </div>
                            <h2><a href="{{ route('showProfileServiceOccupation',$service->id) }}">{{ $service->IntermediateOcc->ser_occ_name }}</a></h2>
                            <div class="product-carousel-price">
                                 <a href="{{ route('perfil',$service->use_id) }}">{{ $service->IntermediateUseOcc->name }}</a> 
                            </div>  
                            <div class="product-carousel-price">
                                {{ $service->descripcion }}
                            </div>  
                            <div class="product-carousel-price">
                                <ins>${{ $service->precio }}</ins> 
                            </div>  
                            
                            <div class="product-option-shop">
                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="70" rel="nofollow" href="{{ route('showProfileServiceOccupation',$service->id) }}">Ver más</a>
                            </div>                       
                        </div>
                    </div>                
                @endforeach
        </div>
    </div>

  </body>
@endsection

@section('contenido_abajo_js')
<script>

</script>
    
@endsection