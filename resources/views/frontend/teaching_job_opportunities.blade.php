<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-career-breadcrumb-sec" style="background-image: url('{{ asset('uploads/careers/'.$teaching_job_opportunities_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $teaching_job_opportunities_banner->banner_heading ? $teaching_job_opportunities_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ route('frontend.index') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Careers<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{ route('frontend.career_opportunities') }}">Career Opportunities<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $teaching_job_opportunities_banner->banner_heading ? $teaching_job_opportunities_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>
        
        <section class="teaching-job-opp-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="teaching-job-opp-img-sec">
                    <img src="{{ asset('uploads/careers/' . $teaching_job_opportunities_banner->section_image ) }}" class="img-fluid"
                        alt="Teaching Job Opportunities Image">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="teaching-job-opp-content-sec">
                        <h4 class="teaching-job-opp-title">{{  $teaching_job_opportunities_banner->section_heading ? $teaching_job_opportunities_banner->section_heading : 'What sets us apart?' }}</h4>
                        <p>{!! $teaching_job_opportunities_banner->description !!}</p>
                    </div>
                    <div class="teaching-job-opp-btn-sec">
                        <a href="#" class="btn-ecol btn">Apply Now</a>
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