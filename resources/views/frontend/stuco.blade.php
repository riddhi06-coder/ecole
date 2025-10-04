<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$stuco_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $stuco_banner->banner_heading ? $stuco_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Campus life<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $stuco_banner->banner_heading ? $stuco_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="stuco-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-6">
                    <div class="stuco-img-sec">
                        <img src="{{ asset('uploads/campus-life/' . $stuco_banner->section_image) }}" class="img-fluid" alt="STUCO Image">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="stuco-content-sec">
                    <h4 class="stuco-title">{{  $stuco_banner->section_heading ? $stuco_banner->section_heading : 'What sets us apart?' }}</h4>
                    <p>{!!  $stuco_banner->section_description ? $stuco_banner->section_description : 'What sets us apart?' !!}</p>
                    </div>
                </div>

                <div class="col-12 col-md-12">
                    <div class="stuco-content-two-sec">
                        @foreach($stuco as $position)
                            @php
                                $splitPhrase = 'Student Council Member Profile';
                                $desc = $position->description;
                            @endphp

                            <p>
                                <strong>{{ $position->title }}</strong>
                                @if(str_contains($desc, $splitPhrase))
                                    {{-- Inline before the phrase --}}
                                    <span>{!! strip_tags(strstr($desc, $splitPhrase, true), '<a><em><b><br>') !!}</span>
                                    <br><br>
                                    {{-- Phrase and rest below --}}
                                    <span><strong>{!! strip_tags(strstr($desc, $splitPhrase), '<a><em><b><br>') !!}</strong></span>
                                @else
                                    {{-- Inline for normal descriptions --}}
                                    <span>{!! strip_tags($desc, '<a><em><b><br>') !!}</span>
                                @endif
                            </p>
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