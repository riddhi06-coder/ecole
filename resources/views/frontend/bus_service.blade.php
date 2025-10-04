<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$bus_service_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $bus_service_banner->banner_heading ? $bus_service_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Campus life<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $bus_service_banner->banner_heading ? $bus_service_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="bus-service-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-6">
                    <div class="bus-service-img-sec">
                    <img src="{{ asset('uploads/campus-life/' .  $bus_service_banner->section_image ) }}" class="img-fluid" alt="STUCO Image">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="bus-service-content-sec">
                    <h4 class="bus-service-title">{{ $bus_service_banner->section_heading  }}</h4>
                    <p> {!! $bus_service_banner->description !!}</p>
                    </div>
                </div>
                </div>
            </div>
        </section>
        
    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>