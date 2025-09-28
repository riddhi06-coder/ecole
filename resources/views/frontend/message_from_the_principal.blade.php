<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec"
            style="background-image: url('{{ asset('uploads/about/'.$message_from_the_principal->banner_image) }}'); 
                background-size: cover; 
                background-position: center; 
                background-repeat: no-repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <h1>
                                {{ $message_from_the_principal->banner_heading ? $message_from_the_principal->banner_heading : 'Message From The Principal' }}
                            </h1>
                            <ul class="bread-list">
                                <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                                <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                                <li class="active"><a href="javascript:void(0)">{{ $message_from_the_principal->banner_heading }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
        </section>


        <section class="about-2 section message-from-head-sec">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="message-from-img-sec">
                        <img src="{{ asset('uploads/about/'. $message_from_the_principal->section_image) }}" class="img-fluid" alt="">
                        </div>
                    </div>

                    {{-- Text next to image --}}
                    <div class="col-lg-8">
                        <div class="message-from-content-sec">
                            <h3>{{ $message_from_the_principal->section_heading ?? 'Message From The Principal' }}</h3>
                            @php
                                // Split the content by closing </p> tag
                                $paragraphs = explode('</p>', $message_from_the_principal->section_description);
                                // Remove empty strings and add </p> back
                                $paragraphs = array_filter(array_map(fn($p) => $p ? $p.'</p>' : '', $paragraphs));
                                $mainParagraphs = array_slice($paragraphs, 0, 4); // first 4 paragraphs
                            @endphp

                            {!! implode('', $mainParagraphs) !!}
                        </div>
                    </div>
                
                    {{-- Text below image (full width) --}}
                    <div class="col-lg-12">
                        <div class="message-from-content-sec">
                                <br>
                            @php
                                $remainingParagraphs = array_slice($paragraphs, 4); // everything else
                            @endphp
                            {!! implode('', $remainingParagraphs) !!}
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