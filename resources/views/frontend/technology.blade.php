<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$technology_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $technology_banner->banner_heading ? $technology_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Campus life<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $technology_banner->banner_heading ? $technology_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="technology-arts-sec">
            <div class="container">
                <div class="row">

                    {{-- ✅ Banner Image --}}
                    @if($technology_banner && $technology_banner->section_image)
                        <div class="col-12 col-md-12">
                            <div class="technology-img-sec">
                                <img src="{{ asset('uploads/campus-life/' . $technology_banner->section_image) }}" 
                                    class="img-fluid" 
                                    alt="{{ $technology_banner->banner_heading ?? 'Technology Image' }}">
                            </div>
                        </div>
                    @endif

                    {{-- ✅ Section Heading & Content --}}
                    @if($technology_banner)
                        <div class="col-12 col-md-12">
                            <div class="technology-content-sec">

                                {{-- Section Heading --}}
                                @if($technology_banner->section_heading)
                                    <h4 class="technology-title">{{ $technology_banner->section_heading }}</h4>
                                @else
                                    <h4 class="technology-title">Technology</h4>
                                @endif

                                {{-- Description --}}
                                @if($technology_banner->description)
                                    <p>{!! $technology_banner->description !!}</p>
                                @endif

                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
        
    </main>
    
    
    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>