<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec" 
                 style="background-image: url('{{ asset('uploads/about/'.$school_calendar->banner_image) }}'); background-size: cover; background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>{{ $school_calendar->section_heading ?? 'School Calendar' }}</h1>
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{ $school_calendar->section_heading ?? 'School Calendar' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <section class="what-sets-us-apart-sec">
            <div class="container">
                <div class="row">

                    {{-- Dynamic Image --}}
                    @if( $school_calendar->section_image)
                        <div class="col-12 col-md-12">
                            <div class="what-sets-us-apart-img-sec">
                                <img src="{{ asset('uploads/about/'.$school_calendar->section_image) }}" 
                                    class="img-fluid" alt="{{ $school_calendar->section_heading }}">
                            </div>
                        </div>
                    @endif

                    {{-- Dynamic Title & Description --}}
                    <div class="col-12 col-md-12">
                        <div class="what-sets-us-apart-content-sec">
                            <h4 class="what-sets-us-title">{{ $school_calendar->section_heading ?? 'School Calendar' }}</h4>
                            <p>{!! $school_calendar->section_description ?? '' !!}</p>
                        </div>
                    </div>

                    {{-- Dynamic Calendar PDFs --}}
                    @if($school_calendar && $school_calendar->yearly_documents)
                        @foreach(json_decode($school_calendar->yearly_documents) as $doc)
                            @if(isset($doc->document))
                                <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                                    <a class="progress-offers-btn" target="_blank"
                                    href="{{ asset('uploads/about/'.$doc->document) }}">
                                    DOWNLOAD CALENDAR {{ $doc->year }}
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>
            </div>
        </section>

    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>