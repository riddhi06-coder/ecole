<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

    <style>
        .ieypy-programme-four-content-sec a {
            color: #11317B !important;
            font-weight: 600 !important;
        }
    </style>


<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-academics-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$ib_diploma_school_mumbai_banner->banner_image) }}'); 
               background-size: cover; 
               background-position: center; 
               background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{ $ib_diploma_school_mumbai_banner->banner_heading ?? 'ib_diploma_school_mumbai_banner' }}</h1>
                    <ul class="bread-list">
                    <li><a href="../">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Academics<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{ $ib_diploma_school_mumbai_banner->banner_heading ?? 'ib_diploma_school_mumbai_banner' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="ieypy-programme-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-6">
                    <div class="ieypy-programme-img-sec">
                    <img src="{{ asset('uploads/academics/'.$ib_diploma_school_mumbai_banner->section_image) }}" class="img-fluid"
                        alt="IB Middle Years Programme Image">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="ieypy-programme-content-sec">
                    <h4 class="ieypy-programme-title">{{ $ib_diploma_school_mumbai_banner->section_heading ?? 'ib_diploma_school_mumbai_banner' }}</h4>
                    <p>{{ $ib_diploma_school_mumbai_banner->small_intro ?? 'ib_diploma_school_mumbai_banner' }}</p>
                    <div class="ieypy-programme-btn-sec">
                        <a class="ieypy-programme-inner-btn" href="{{ route('frontend.apply_for_admission') }}">ENROLL NOW</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        
        <section class="ieypy-programme-two-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <h4 class="afas-details-title">{{  $ib_diploma_school_mumbai_banner->program_heading  }}</h4>
                    <p>{!!  $ib_diploma_school_mumbai_banner->program_description  !!}
                </div>
                </div>
            </div>
        </section>

        <section class="ieypy-programme-three-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="ieypy-programme-three-img-sec">
                    <img src="{{ asset('uploads/academics/'.$ib_diploma_school_mumbai_banner->program_image) }}" alt="Subject Curriculum Image">
                    </div>
                </div>
                </div>
            </div>
        </section>

        <section class="ieypy-programme-four-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-6">
                    <div class="ieypy-programme-four-img-sec">
                    <img src="{{ asset('uploads/academics/'.$ib_diploma_school_mumbai_banner->framework_image) }}" alt="Subject Curriculum Image">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="ieypy-programme-four-content-sec">
                    <p>{!! $ib_diploma_school_mumbai_banner->curriculum_description ?? 'cib_pyp_schools_mumbai_banner' !!}
                </div>
                </div>
            </div>
        </section>

        <section class="ieypy-programme-five-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="table-responsive ieypy-programme-table-one-sec">
                        {!! str_replace('<table', '<table class="table table-bordered table-hover"', $ib_diploma_school_mumbai_banner->extra_info ?? 'cib_pyp_schools_mumbai_banner') !!}
                    </div>

                    <div class="ieypy-programme-five-btn-sec text-center">
                        @if($ib_diploma_school_mumbai_banner->document && file_exists(public_path('uploads/academics/documents/' . $ib_diploma_school_mumbai_banner->document)))
                            <a class="ieypy-programme-five-inner-btn"
                            href="{{ asset('uploads/academics/documents/' . $ib_diploma_school_mumbai_banner->document) }}"
                            target="_blank">
                            Download School Brochure (PDF)
                            </a>
                        @elseif($ib_diploma_school_mumbai_banner->doc_url)
                            <a class="ieypy-programme-five-inner-btn"
                            href="{{ $ib_diploma_school_mumbai_banner->doc_url }}"
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