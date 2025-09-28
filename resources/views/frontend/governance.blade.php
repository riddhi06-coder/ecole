<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">
        
        <section class="ecolemon-breadcrumb-sec" 
            style="background-image: url('{{ asset('uploads/about/'.$governance->banner_image) }}'); 
               background-size: cover; 
               background-position: center; 
               background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>{{ $governance->section_heading ?? 'Governance' }}</h1>
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{ $governance->section_heading ?? 'Governance' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="governance-sec">
            <div class="container">
                <div class="row">

                    {{-- Governance Image --}}
                    @if($governance && $governance->section_image)
                        <div class="col-12 col-md-12">
                            <div class="governance-img-sec">
                                <img src="{{ asset('uploads/about/'.$governance->section_image) }}" 
                                    class="img-fluid" alt="{{ $governance->section_heading ?? 'Governance Image' }}">
                            </div>
                        </div>
                    @endif

                    {{-- Governance Content --}}
                    <div class="col-12 col-md-12">
                        <div class="governance-content-sec">
                            <h4 class="governance-title">{{ $governance->section_heading ?? 'Governance' }}</h4>
                            {!! $governance->section_description !!}
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