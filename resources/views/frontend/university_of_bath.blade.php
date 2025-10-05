<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/careers/'.$university_of_bath_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $university_of_bath_banner->banner_heading ? $university_of_bath_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Careers<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $university_of_bath_banner->banner_heading ? $university_of_bath_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="university-of-bath-one-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-6">
                    <div class="university-bath-video-sec">
                    <div class="video-wrapper">
                        <iframe src="{{ $university_of_bath_banner->videos_url }}" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                        </iframe>
                    </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="university-bath-content-sec">
                    <h4>{{  $university_of_bath_banner->section_heading ? $university_of_bath_banner->section_heading : 'What sets us apart?' }}</h4>
                    @php
                        // Full description
                        $fullDesc = $university_of_bath_banner->section_description;

                        // The first sentence / heading you want
                        $headingText = 'Centre For The Study Of Education In An International Context ';
                        $headingLinkText = '(CEIC)';
                        $headingLinkUrl = 'http://www.bath.ac.uk/ceic/';

                        // Remove heading from full description
                        $remainingDesc = str_replace($headingText . $headingLinkText, '', strip_tags($fullDesc));
                    @endphp

                    <h6>
                        {{ $headingText }}
                        <a href="{{ $headingLinkUrl }}" target="_blank">{{ $headingLinkText }}</a>
                    </h6>

                    <p>{!! $remainingDesc !!}</p>



                    </div>
                </div>
                </div>
            </div>
        </section>

        <section class="university-of-bath-two-sec" style="background-image: url('{{ asset('uploads/careers/'.$university_of_bath_banner->bkg_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="section-title-two">
                        <h2>{{ $university_of_bath_banner->unit_heading }}</h2>
                        </div>
                    </div>
                    
                    @php
                        $units = json_decode($university_of_bath_banner->units_offered, true) ?? [];
                    @endphp

                    <div class="row">
                        @foreach($units as $unit)
                            <div class="col-md-4 col-sm-4 col-lg-4 col-xl-4 uob-five-col-sec">
                                <div class="uob-item-sec">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <div class="uob-ov-img-sec">
                                                <img src="{{ $unit['image'] ? asset('uploads/careers/' . $unit['image']) : 'assets/img/icons/default-icon.webp' }}" 
                                                    class="img-fluid" alt="{{ $unit['title'] }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8 p-0">
                                            <div class="uob-content-sec">
                                                <h4>{{ $unit['title'] }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
            </div>
        </section>

        <section class="university-of-bath-three-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="uob-three-content-sec">
                    <p>{!!  $university_of_bath_banner->desc  !!}</p>
                    </div>
                    </div>

                    @php
                        $pdfs = json_decode($university_of_bath_banner->documents, true) ?? [];
                    @endphp

                    @foreach($pdfs as $pdf)
                        <div class="col-12 col-md-4">
                            <div class="uob-pdf-inner-sec">
                                <img src="{{ asset('frontend/assets/img/icons/pdf.png') }}" alt="Pdf Icon" class="img-fluid">
                                @if($pdf['file'])
                                    <h5>
                                        <a href="{{ asset('uploads/careers/' . $pdf['file']) }}" target="_blank">
                                            {{ $pdf['name'] }}
                                        </a>
                                    </h5>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>