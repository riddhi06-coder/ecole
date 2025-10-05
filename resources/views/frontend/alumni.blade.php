<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">


        <section class="ecolemon-breadcrumb-sec"  style="background-image: url('{{ asset('uploads/about/'.$alumni_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; 
                   ">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1> {{  $alumni_banner->banner_heading ? $alumni_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">  {{  $alumni_banner->banner_heading ? $alumni_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="alumni-sec">
            <div class="container">

                @foreach($alumni as $member)
                    <div class="alumni-inner-sec">
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="alumni-img-sec">
                                    <img src="{{ asset('uploads/about/'.$member->alumni_image) }}"
                                        class="img-fluid"
                                        alt="{{ $member->alumni_name }}">
                                </div>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="alumni-content-sec">
                                    <h4 class="alumni-title">{{ $member->alumni_name }}</h4>

                                    @if($member->alumni_desc)
                                        <h5> {{ $member->alumni_desc }} </h5>
                                    @endif

                                    {!! $member->section_description !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Separator --}}
                    @if(!$loop->last)
                        <hr>
                    @endif
                @endforeach

                @if( $alumni_banner->alumni_email ?? false)
                    <hr>
                    <div class="alumni-inner-sec">
                        <div class="row">
                            <div class="col-12">
                                <div class="alumni-content-sec">
                                    <p><strong>Email us for more details:
                                        <a href="mailto:{{ $alumni_banner->alumni_email }}">{{ $alumni_banner->alumni_email }}</a>
                                    </strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </section>

    </main>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>