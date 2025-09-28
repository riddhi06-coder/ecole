<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec" style="background-image: url('{{ asset('uploads/about/'.$faculty_and_staff->banner_image) }}'); 
                background-size: cover; 
                background-position: center; 
                <!-- background-repeat: no-repeat;" -->
                >
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>{{ $faculty_and_staff->section_heading ?? 'Faculty & Staff' }}</h1>
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{ $faculty_and_staff->section_heading ?? 'Faculty & Staff' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="faculty-staff-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="faculty-staff-img-sec">
                    <img src="{{ asset('uploads/about/'.$faculty_and_staff->section_image) }}" class="img-fluid" alt="What sets us apart Image">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="faculty-staff-content-sec">
                    <h4 class="faculty-staff-title">{{ $faculty_and_staff->section_heading }} </h4>
                    <p> {!! $faculty_and_staff->section_description !!}</p>

                    <div class="faculty-staff-chart-sec">
                        <img src="{{ asset('uploads/about/'.$faculty_and_staff->extra_image) }}" alt="">
                    </div>

                    <p> {{ $faculty_and_staff->extra_description }}</p>
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