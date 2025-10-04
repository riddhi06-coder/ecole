<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header') 
    
    
    
    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$media_center_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; ">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $media_center_banner->banner_heading ? $media_center_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Campus life<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $media_center_banner->banner_heading ? $media_center_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="media-centre-sec">
            <div class="container">
                <div class="row">

                    @forelse($media_center as $media)
                        <div class="col-12 col-md-12">
                            <div class="media-centre-content-sec">

                                {{-- Section Image --}}
                                @if($media->section_image)
                                    <div class="media-centre-inner-img-sec mb-3">
                                        <img src="{{ asset('uploads/campus-life/' . $media->section_image) }}" 
                                            class="img-fluid" 
                                            alt="{{ $media->section_heading ?? 'Section Image' }}">
                                    </div>
                                @endif

                                {{-- Section Heading --}}
                                @if($media->section_heading)
                                    <h4 class="media-centre-title">{{ $media->section_heading }}</h4>
                                @endif

                                {{-- Title with Optional URL --}}
                                @if($media->title)
                                    <p>
                                        <strong>
                                            @if($media->title === 'Access Primary Library Resources' && $media->url)
                                                <a href="{{ $media->url }}" target="_blank">{{ $media->title }}</a>
                                            @else
                                                {{ $media->title }}
                                            @endif
                                        </strong>

                                        {{-- Normal URL display for other titles if needed --}}
                                        @if($media->title !== 'Access Primary Library Resources' && $media->url)
                                            <a href="{{ $media->url }}" target="_blank">{{ $media->url }}</a>
                                        @endif
                                    </p>
                                @endif

                                {{-- Description --}}
                                @if($media->description)
                                    <p>{!! $media->description !!}</p>
                                @endif

                                {{-- Extra Image --}}
                                @if($media->image)
                                    <div class="media-centre-inner-img-sec mt-3">
                                        <img src="{{ asset('uploads/campus-life/' . $media->image) }}" 
                                            class="img-fluid" 
                                            alt="{{ $media->title }}">
                                    </div>
                                @endif



                            </div>
                        </div>
                    @empty
                        <p class="text-center">No media centre records available.</p>
                    @endforelse

                </div>
            </div>
        </section>


    </main>
    
    
    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>