<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/admissions/'.$fee_structure_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $fee_structure_banner->banner_heading ? $fee_structure_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Admissions<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $fee_structure_banner->banner_heading ? $fee_structure_banner->banner_heading : 'What sets us apart?' }}</a></li>
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
                            <h4 class="fee-structure-title">{{  $fee_structure_banner->section_heading ? $fee_structure_banner->section_heading : 'What sets us apart?' }}</h4>
                            <p><strong>{{  $fee_structure_banner->section_description ? $fee_structure_banner->section_description : 'What sets us apart?' }}</strong></p>

                            @foreach($fee_structure as $fee)
                                <p class="one-time-fees-one-sec"><strong>{{ $fee->fee_type }}</strong></p>

                                @if($fee->fee_desc)
                                    <p>{{ $fee->fee_desc }}</p>
                                @endif

                                

                                @if($fee->fees_details)
                                    @php
                                        $pattern = '/<table.*?>.*?<\/table>/is'; // Matches all tables
                                        preg_match_all($pattern, $fee->fees_details, $tables);

                                        // Split content by tables
                                        $parts = preg_split($pattern, $fee->fees_details);

                                        $formattedHtml = '';

                                        foreach ($parts as $index => $part) {
                                            // Wrap non-table content in styled div
                                            if (trim($part)) {
                                                $formattedHtml .= '<div style="font-family: Montserrat, sans-serif; font-weight: 400; font-style: normal; color: rgb(0,0,0); font-size: 16px; line-height: 24px;">' . $part . '</div>';
                                            }

                                            // Append the corresponding table if exists
                                            if (isset($tables[0][$index])) {
                                                $table = preg_replace('/<table.*?>/i', '<table class="table table-bordered table-hover">', $tables[0][$index]);
                                                $formattedHtml .= '<div class="table-responsive fees-table-one-sec">' . $table . '</div>';
                                            }
                                        }
                                    @endphp

                                    {!! $formattedHtml !!}
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>


                <div class="programmes-offer-btn-sec">
                    <div class="row">
                        @php
                            $ctaButtons = [
                                [
                                    'text'   => 'Schedule a Campus Tour',
                                    'url'    => $fee_structure_banner->campus_tour ?? '#',
                                    'target' => '_blank'
                                ],
                                [
                                    'text'   => 'Download School Brochure (PDF)',
                                    'url'    => $fee_structure_banner->brochure 
                                                ? asset('uploads/admissions/' . $fee_structure_banner->brochure) 
                                                : '#',
                                    'target' => '_blank'
                                ],
                                [
                                    'text'   => 'Speak to Admissions Advisor',
                                    'url'    => $fee_structure_banner->admission_advisor ?? '#',
                                    'target' => '_blank'
                                ],
                            ];
                        @endphp

                        @foreach($ctaButtons as $button)
                            <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                                <a class="progress-offers-btn" target="{{ $button['target'] }}" href="{{ $button['url'] }}">
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