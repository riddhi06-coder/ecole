<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$ib_visual_and_performing_arts_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $ib_visual_and_performing_arts_banner->banner_heading ? $ib_visual_and_performing_arts_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Campus life<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $ib_visual_and_performing_arts_banner->banner_heading ? $ib_visual_and_performing_arts_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="ib-visual-and-performing-arts-sec">
            <div class="container">
                <div class="row">

                    {{-- ✅ Section Image & Heading (only once) --}}
                    @if($ib_visual_and_performing_arts_banner)
                        @if($ib_visual_and_performing_arts_banner->section_image)
                            <div class="col-12 col-md-12">
                                <div class="ib-visual-and-performing-arts-img-sec">
                                    <img src="{{ asset('uploads/campus-life/' . $ib_visual_and_performing_arts_banner->section_image) }}" 
                                        class="img-fluid" 
                                        alt="{{ $ib_visual_and_performing_arts_banner->section_heading ?? 'IB Visual and Performing Arts Image' }}">
                                </div>
                            </div>
                        @endif

                        @if($ib_visual_and_performing_arts_banner->section_heading)
                            <div class="col-12 col-md-12">
                                <div class="ib-visual-and-performing-arts-content-sec">
                                    <h4 class="ib-visual-and-performing-arts-title">{{ $ib_visual_and_performing_arts_banner->section_heading }}</h4>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- ✅ Loop for each record: Title & Description --}}
                    @forelse($ib_visual_and_performing_arts as $ib)
                        <div class="col-12 col-md-12">
                            <div class="ib-visual-and-performing-arts-content-sec">

                                {{-- Title --}}
                                @if($ib->title)
                                    <p><strong>{{ $ib->title }}</strong></p>
                                @endif

                                {{-- Description --}}
                                @if($ib->description)
                                    <p>{!! $ib->description !!}</p>
                                @endif

                            </div>
                        </div>
                    @empty
                        <p class="text-center">No IB Visual & Performing Arts records available.</p>
                    @endforelse

                </div>
            </div>
        </section>

    </main>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>