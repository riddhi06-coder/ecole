<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/admissions/'.$merit_scholarship_banner->banner_image) }}'); 
               background-size: cover; 
               background-position: center; 
               background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{ $merit_scholarship_banner->banner_heading ?? 'merit_scholarship_banner' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Admissions<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{ $merit_scholarship_banner->banner_heading ?? 'merit_scholarship_banner' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="fee-structure-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="fee-structure-content-sec">
                        <h4 class="fee-structure-title">{{ $merit_scholarship_banner->section_heading ?? 'Governance' }}</h4>
                        <p>{!! $merit_scholarship_banner->description ?? 'Governance' !!}</p>
                    </div>
                </div>

                <div class="programmes-offer-btn-sec pt-0">
                    <div class="row">
                        @php
                            $ctaButtons = [
                                [
                                    'text' => 'Schedule a Campus Tour',
                                    'url'  => $merit_scholarship_banner->campus_tour 
                                            ? "https://api.whatsapp.com/send/?phone=9326020914&text=" . urlencode("Hello École Admissions Team,\n\nI’m interested in admissions 2026-27.") 
                                            : '#',
                                ],
                                [
                                    'text' => 'Download School Brochure (PDF)',
                                    'url'  => $merit_scholarship_banner->brochure 
                                            ? asset('uploads/admissions/' . $merit_scholarship_banner->brochure) 
                                            : '#',
                                ],
                                [
                                    'text' => 'Speak to Admissions Advisor',
                                    'url'  => $merit_scholarship_banner->admission_advisor 
                                            ? "https://api.whatsapp.com/send/?phone=9326020914&text=" . urlencode("Hello École Admissions Team,\n\nI’m interested in admissions 2026-27.") 
                                            : '#',
                                ],
                            ];
                        @endphp

                        @foreach($ctaButtons as $button)
                            <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                                <a class="progress-offers-btn" target="_blank" href="{{ $button['url'] }}">
                                    {{ $button['text'] }}
                                </a>
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