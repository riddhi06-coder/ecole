<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        @php
            $bannerItem = $what_sets_us_apart->first(); 
        @endphp

 
        <section class="ecolemon-breadcrumb-sec"
                style="background-image: url('{{ asset('uploads/about/'.$bannerItem->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; 
                    <!-- background-repeat: no-repeat;" -->
                    >
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>
                            {{  $bannerItem->banner_heading ? $bannerItem->banner_heading : 'What sets us apart?' }}
                        </h1>
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{ $bannerItem->banner_heading }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="what-sets-us-apart-sec">
            <div class="container">
                <div class="row">
                    @forelse($what_sets_us_apart as $item)
                        <!-- Image Section -->
                        @if($item->section_image)
                            <div class="col-12 col-md-12">
                                <div class="what-sets-us-apart-img-sec">
                                    <img src="{{ asset('uploads/about/'.$item->section_image) }}" 
                                        class="img-fluid" 
                                        alt="{{ $item->section_heading }}">
                                </div>
                            </div>
                        @endif

                        <!-- Content Section -->
                        <div class="col-12 col-md-12">
                            <div class="what-sets-us-apart-content-sec">
                                @if($item->section_heading)
                                    <h4 class="what-sets-us-title">{{ $item->section_heading }}</h4>
                                @endif

                                @if($item->section_description)
                                    <p>{!! $item->section_description !!}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>No details available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>


    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>