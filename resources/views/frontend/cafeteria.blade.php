<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$cafeteria_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $cafeteria_banner->banner_heading ? $cafeteria_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ route('frontend.index') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Campus life<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $cafeteria_banner->banner_heading ? $cafeteria_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="cafeteria-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-6">
                    <div class="cafeteria-img-sec">
                    <img src="{{ asset('uploads/campus-life/' . $cafeteria_banner->section_image ) }}" class="img-fluid" alt="Cafeteria Image">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="cafeteria-content-sec">
                    <h4 class="cafeteria-title">{{  $cafeteria_banner->section_heading ? $cafeteria_banner->section_heading : 'What sets us apart?' }}</h4>

                    <p>{!! $cafeteria_banner->section_description !!}</p>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <section class="cafeteria-nutritionist-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$cafeteria_banner->bck_image) }}'); ">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-10">
                    <div class="cafeteria-nutritionist-content-sec">
                    <h4 class="cafeteria-nutritionist-title">{{  $cafeteria_banner->title ? $cafeteria_banner->title : 'What sets us apart?' }}</h4>
                    <p>{!! $cafeteria_banner->description  !!}</p>
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