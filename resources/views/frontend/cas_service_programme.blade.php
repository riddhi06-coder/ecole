<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$cas_service_programme_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; ">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1> {{  $cas_service_programme_banner->banner_heading ? $cas_service_programme_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)"> {{  $cas_service_programme_banner->banner_heading ? $cas_service_programme_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="creativity-service-programme-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="creativity-service-programme-img-sec">
                    <img src="{{ asset('uploads/academics/'.$cas_service_programme_banner->section_image) }}" class="img-fluid"
                        alt="What sets us apart Image">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="creativity-service-programme-content-sec">
                        <h4 class="creativity-service-programme-title">{{  $cas_service_programme_banner->section_heading ? $cas_service_programme_banner->section_heading : 'What sets us apart?' }}</h4>
                        <p>{{  $cas_service_programme_banner->section_description ? $cas_service_programme_banner->section_description : 'What sets us apart?' }}</p>




                        {{-- Loop through each main section --}}
                        @foreach($cas_service_programme as $section)
                            <div class="cas-section">

                                {{-- Title --}}
                                @if(!empty($section->title))
                                    <h6>{{ $section->title }}</h6>
                                @endif

                                @if(!empty($section->description))
                                    @php
                                        $description = $section->description;

                                        if (!empty($section->detailed_sections)) {
                                            $detailedSections = json_decode($section->detailed_sections, true);

                                            foreach ($detailedSections as $event) {
                                                $eventName = $event['event_name'] ?? null;
                                                $slug = $event['slug'] ?? null;

                                                if ($eventName && $slug) {
                                                    // Normalize smart quotes and remove punctuation
                                                    $normalizedEvent = strtolower(preg_replace("/[^\p{L}\p{N}\s]/u", '', str_replace(['’','‘','“','”'], ["'","'","\"","\""], $eventName)));

                                                    // Get first 2-3 words
                                                    $eventWords = preg_split('/\s+/', $normalizedEvent);
                                                    $firstTwoWords = implode(' ', array_slice($eventWords, 0, 2));
                                                    $firstThreeWords = implode(' ', array_slice($eventWords, 0, 3));

                                                    // Replace in <li>
                                                    $description = preg_replace_callback('/<li>(.*?)<\/li>/i', function($matches) use ($firstTwoWords, $firstThreeWords, $slug) {
                                                        $liText = $matches[1];
                                                        $normalizedLi = strtolower(preg_replace("/[^\p{L}\p{N}\s]/u", '', str_replace(['’','‘','“','”'], ["'","'","\"","\""], $liText)));

                                                        foreach ([$firstThreeWords, $firstTwoWords] as $match) {
                                                            if (!empty($match) && stripos($normalizedLi, $match) !== false) {
                                                                // Wrap entire <li> text in link
                                                                $liText = '<a href="'.route("frontend.creativity_detail", $slug).'">'.$liText.'</a>';
                                                                break;
                                                            }
                                                        }

                                                        return '<li>'.$liText.'</li>';
                                                    }, $description);
                                                }
                                            }
                                        }

                                        $hasList = preg_match('/<ul>|<li>/', $description);
                                    @endphp

                                    @if($hasList)
                                        <div class="listing-one">
                                            {!! $description !!}
                                        </div>
                                    @else
                                        {!! $description !!}
                                    @endif
                                @endif



                            </div>
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