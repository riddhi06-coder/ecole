<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-academics-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$student_support_services_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>{{  $student_support_services_banner->banner_heading ? $student_support_services_banner->banner_heading : 'What sets us apart?' }}</h1>
                        <ul class="bread-list">
                            <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">Academics<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{  $student_support_services_banner->banner_heading ? $student_support_services_banner->banner_heading : 'What sets us apart?' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <section class="student-support-services-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="student-support-services-img-sec">
                            <img src="{{ asset('uploads/academics/' . $student_support_services_banner->section_image) }}" class="img-fluid"
                                alt="Student Support Services Image">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="student-support-services-content-sec">
                            <h4 class="student-support-services-title">{{ $student_support_services_banner->section_heading }}</h4>
                            <p>{!! $student_support_services_banner->section_description !!}</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="student-support-services-content-two-sec">
                            <p>{!!$student_support_services_banner->description !!}</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-12">
                        <div class="ieypy-programme-five-btn-sec text-center">
                            @if($student_support_services_banner && $student_support_services_banner->document && file_exists(public_path('uploads/academics/' . $student_support_services_banner->document)))
                                <a class="ieypy-programme-five-inner-btn"
                                href="{{ asset('uploads/academics/' . $student_support_services_banner->document) }}"
                                target="_blank">
                                Download School Brochure (PDF)
                                </a>
                            @else
                                <a class="ieypy-programme-five-inner-btn"
                                href="{{ $student_support_services_banner->url }}"
                                target="_blank">
                                Download School Brochure (PDF)
                                </a>
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