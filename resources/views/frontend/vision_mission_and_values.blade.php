<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        @php
            $visionItem = $vision_mission_and_values->first(); // Get the single record
            $divisionDetails = $visionItem && $visionItem->division_details ? json_decode($visionItem->division_details, true) : [];
            $valuesData = $visionItem && $visionItem->gallery_images ? json_decode($visionItem->gallery_images, true) : [];
            $definitions = $visionItem && $visionItem->features_table ? json_decode($visionItem->features_table, true) : [];
        @endphp

        <section class="ecolemon-breadcrumb-sec"
                style="background-image: url('{{ asset('uploads/about/'.$visionItem->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; 
                    background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>
                            {{ $visionItem->banner_heading ? $visionItem->banner_heading : 'Vision, Mission & Values' }}
                        </h1>
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{ $visionItem->banner_heading }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <section class="vision-mission-value-sec">
            <div class="container">
                <div class="row">
                    <!-- Section Image -->
                    <div class="col-12 col-md-6">
                        <div class="vision-mission-value-img-sec">
                            @if($visionItem && $visionItem->section_image)
                                <img src="{{ asset('uploads/about/'.$visionItem->section_image) }}" class="img-fluid" alt="Vision Mission Values Image">
                            @else
                                <img src="assets/img/about-us/vision-mission-values-img.webp" class="img-fluid" alt="Vision Mission Values Image">
                            @endif
                        </div>
                    </div>

                    <!-- Vision & Mission Content -->
                    <div class="col-12 col-md-6">
                        <div class="vision-mission-content-one-sec">
                            @foreach($divisionDetails as $division)
                                @php
                                    $icon = $division['icon'] ?? null;
                                    $heading = $division['heading'] ?? '';
                                    $description = $division['description'] ?? '';
                                @endphp

                                <div class="vision-mission-content-sub-one-sec">
                                    <div class="vmcs-img-sec">
                                        @if($icon)
                                            <img src="{{ asset('uploads/about/'.$icon) }}" alt="{{ $heading }}" class="img-fluid">
                                        @endif
                                    </div>
                                    <div class="vmcs-para-sec">
                                        <h3>{{ $heading }}</h3>
                                        <p>{{ $description }}</p>
                                    </div>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="vmv-our-values-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="section-title-two">
                            <h2>{{ $visionItem->section_heading}}</h2>
                        </div>
                    </div>

                    @forelse($valuesData as $value)
                        <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 vmv-our-values-four-sec">
                            <div class="vmv-ov-item-sec">
                                <div class="vmv-ov-img-sec">
                                    <img src="{{ asset('uploads/about/'.$value['image']) }}" class="img-fluid" alt="{{ $value['features'] }}">
                                </div>
                                <div class="vmv-ov-content-sec">
                                    <h4>{{ $value['features'] }}</h4>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Fallback: Default static values if DB is empty -->
                        <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 vmv-our-values-four-sec">
                            <div class="vmv-ov-item-sec">
                                <div class="vmv-ov-img-sec">
                                    <img src="assets/img/icons/respect.png" class="img-fluid" alt="">
                                </div>
                                <div class="vmv-ov-content-sec">
                                    <h4>Respect</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 vmv-our-values-four-sec">
                            <div class="vmv-ov-item-sec">
                                <div class="vmv-ov-img-sec">
                                    <img src="assets/img/icons/empathy.png" class="img-fluid" alt="">
                                </div>
                                <div class="vmv-ov-content-sec">
                                    <h4>Empathy</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 vmv-our-values-four-sec">
                            <div class="vmv-ov-item-sec">
                                <div class="vmv-ov-img-sec">
                                    <img src="assets/img/icons/responsibility.png" class="img-fluid" alt="">
                                </div>
                                <div class="vmv-ov-content-sec">
                                    <h4>Responsibility</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3 vmv-our-values-four-sec">
                            <div class="vmv-ov-item-sec">
                                <div class="vmv-ov-img-sec">
                                    <img src="assets/img/icons/equity.png" class="img-fluid" alt="">
                                </div>
                                <div class="vmv-ov-content-sec">
                                    <h4>Equity</h4>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>


        <section class="vmv-we-define-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-10">

                        @foreach($definitions as $def)
                            <div class="vmv-we-define-content-sec">
                                <h4 class="vmv-we-define-title">{{ $def['heading'] }}</h4>
                                <ul class="listing">
                                    @foreach(preg_split('/\r\n|\r|\n/', $def['description']) as $point)
                                        @if(trim($point) != '')
                                            <li>{{ $point }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>

    </main>
     
    
    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>