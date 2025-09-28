<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

    <main class="main">

        <section class="ecolemon-breadcrumb-sec"  style="background-image: url('{{ asset('uploads/about/'.$testimonials->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; 
                    <!-- background-repeat: no-repeat;" -->
                    >
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $testimonials->banner_heading ? $testimonials->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $testimonials->banner_heading ? $testimonials->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="testimonials-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="testimonials-img-sec">
                    <img src="{{ asset('uploads/about/'.$testimonials->section_image) }}" class="img-fluid" alt="Testimonials Image">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="testimonials-content-sec">
                    <h4 class="testimonials-title">{{ $testimonials->section_heading }}</h4>
                    @forelse($testimonial as $testimonial)
                        <div class="testimonials-para-sec">
                            {{-- Reviewer --}}
                            <p><strong>{{ $testimonial->reviewer }}</strong></p>

                            {{-- Testimony --}}
                            <p>{!! $testimonial->testimony !!}</p>
                        </div>
                    @empty
                        <p class="text-center">No testimonials available at the moment.</p>
                    @endforelse
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