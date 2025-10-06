<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-career-breadcrumb-sec" style="background-image: url('{{ asset('uploads/careers/'.$career_opportunities_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $career_opportunities_banner->banner_heading ? $career_opportunities_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Careers<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $career_opportunities_banner->banner_heading ? $career_opportunities_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="career-opportunities-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="career-opportunities-content-sec">
                        <p>{!! $career_opportunities_banner->section_description !!}</p>
                        </div>
                    </div>

                    <div class="career-oppor-job-sec">
                        <div class="row">
                            @foreach($job_opportunities as $index => $job)
                                <div class="col-12 col-md-6 career-job-col-sec">
                                    <div class="{{ $index == 0 ? 'career-teaching-job-inner-wrap' : 'career-non-teaching-job-inner-wrap' }}"
                                        style="background-image: url('{{ asset('uploads/careers/'.$job['image']) }}');">
                                        <h4>{{ $job['title'] }}</h4>
                                        <a class="careers-btn" href="{{ $index == 0 ? route('frontend.teaching_job_opportunities') : route('frontend.non_teaching_job_opportunities') }}">
                                            Know More
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="career-opportunities-content-sec">
                        <p>{!! $career_opportunities_banner->desc !!}.</p>
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