<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-policies-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$virtual_tour_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $virtual_tour_banner->banner_heading ? $virtual_tour_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Campus Life<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $virtual_tour_banner->banner_heading ? $virtual_tour_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="virtual-tour-pdf-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="virtual-tour-video-sec">
                            @if($virtual_tour_banner && $virtual_tour_banner->video_url)
                                <iframe src="{{ $virtual_tour_banner->video_url }}" 
                                        title="Virtual Tour Video"
                                        width="100%" height="500px" allowfullscreen>
                                </iframe>
                            @else
                                <p>No virtual tour video available.</p>
                            @endif
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