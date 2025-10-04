<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$sports_and_extra_curricular_activities_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $sports_and_extra_curricular_activities_banner->banner_heading ? $sports_and_extra_curricular_activities_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Campus life<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $sports_and_extra_curricular_activities_banner->banner_heading ? $sports_and_extra_curricular_activities_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="technology-arts-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="technology-img-sec">
                    <img src="{{ asset('uploads/campus-life/' . $sports_and_extra_curricular_activities_banner->section_image) }}" 
                        class="img-fluid" 
                        alt="Technology Image">

                </div>
                <div class="col-12 col-md-12">
                    <div class="technology-content-sec">
                    <h4 class="technology-title">{{  $sports_and_extra_curricular_activities_banner->section_heading ? $sports_and_extra_curricular_activities_banner->section_heading : 'What sets us apart?' }}</h4>
                    
                    @forelse($sports_and_extra_curricular_activities as $activity)
                        <div class="col-12 col-md-12">
                            <div class="sports-activity-content-sec">

                                {{-- Title --}}
                                @if($activity->title)
                                    <p><strong>{{ $activity->title }}</strong></p>
                                @endif

                                {{-- Description --}}
                                @if($activity->description)
                                    <p>{!! $activity->description !!}</p>
                                @endif

                            </div>
                        </div>
                    @empty
                        <p class="text-center">No sports & extra-curricular activities available.</p>
                    @endforelse

                </div>
                </div>
            </div>
        </section>

    </main>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>