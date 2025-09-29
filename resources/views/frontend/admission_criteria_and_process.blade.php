<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/admissions/'.$admission_criteria_and_process_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $admission_criteria_and_process_banner->banner_heading ? $admission_criteria_and_process_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Admissions<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $admission_criteria_and_process_banner->banner_heading ? $admission_criteria_and_process_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="admission-procedure-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="admission-procedure-content-sec">

                        <h4 class="admission-procedure-title">{{  $admission_criteria_and_process_banner->section_heading ? $admission_criteria_and_process_banner->section_heading : 'What sets us apart?' }}</h4>
                        <p>{!!  $admission_criteria_and_process_banner->description ? $admission_criteria_and_process_banner->description : 'What sets us apart?' !!}</p>

                        @foreach($admission_criteria_and_process as $item)
                            @if($item->title)
                                <p><strong>{{ $item->title }}</strong></p>
                            @endif

                            @if($item->procedure)
                                <p>{!! $item->procedure !!}</p>
                            @endif
                        @endforeach

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