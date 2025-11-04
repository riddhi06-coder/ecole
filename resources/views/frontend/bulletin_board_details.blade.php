<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-faq-breadcrumb-sec" style="background-image: url('{{ asset('uploads/bulletin/' . $category->banner_image) }}'); 
                background-size: cover; 
                background-position: center; 
                background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{ $article->article_name }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{ route('frontend.bulletin_board') }}">Bulletin Board<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{ route('frontend.bulletin_board_category_list', ['category_slug' => $category->slug]) }}">{{ $category->category }}<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{ $article->article_name }}</a></li>
                </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="event-detail-sec">

            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="event-detail-img-sec">
                            <img src="{{ asset('uploads/bulletin/' . ($bulletin_details->thumbnail_image ?? 'default.webp')) }}" 
                                class="img-fluid" 
                                alt="{{ $bulletin_details->title ?? 'Event Image' }}">
                        </div>
                    </div>
                </div>
                
                <div class="event-details-one-sec">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="event-detail-content-sec">
                                <h4 class="event-detail-title">{{ $article->article_name ?? 'Event Title' }}</h4>
                            </div>
                            @if($bulletin_details && ($bulletin_details->article_time_from || $bulletin_details->article_time_to || $bulletin_details->location))
                                <div class="event-detail-icon-sec">
                                    {{-- Show Time if any time is present --}}
                                    @if($bulletin_details->article_time_from || $bulletin_details->article_time_to)
                                        <p><i class="fa-solid fa-clock"></i> 
                                            {{ $bulletin_details->article_time_from ? \Carbon\Carbon::parse($bulletin_details->article_time_from)->format('h:i A') : '' }} 
                                            @if($bulletin_details->article_time_from && $bulletin_details->article_time_to)
                                                To 
                                            @endif
                                            {{ $bulletin_details->article_time_to ? \Carbon\Carbon::parse($bulletin_details->article_time_to)->format('h:i A') : '' }}
                                        </p>
                                    @endif

                                    {{-- Show Location if available --}}
                                    @if($bulletin_details->location)
                                        <p><i class="fa-solid fa-location-dot"></i> {{ $bulletin_details->location }}</p>
                                    @endif
                                </div>
                            @endif

                        </div>
                        <div class="col-12 col-md-4">
                            <a class="progress-offers-btn" target="_blank" href="#"><i class="fa-regular fa-calendar"></i> Add To Calendar</a>
                        </div>
                    </div>
                </div>
                
                @php
                    $description = $bulletin_details->desc ?? '';

                    // ✅ Detect if <figure class="table"> exists and wrap it with Bootstrap styling
                    if (strpos($description, '<figure class="table">') !== false) {
                        $description = preg_replace(
                            '/<figure class="table">([\s\S]*?)<\/figure>/i',
                            '<div class="table-responsive"><table class="table table-bordered table-hover mb-0">$1</table></div>',
                            $description
                        );
                    }
                @endphp

                <div class="row">
                    @if($bulletin_details->title || $bulletin_details->desc)
                        <div class="col-12 col-md-12">
                            <div class="event-detail-content-sec">
                                @if($bulletin_details->title)
                                    <h4 class="event-detail-title">{{ $bulletin_details->title }}</h4>
                                @endif

                                @php
                                    // Clean and replace <figure><table> with your Bootstrap table structure
                                    $desc = $bulletin_details->desc;
                                    $desc = str_replace(
                                        ['<figure class="table"><table>', '</table></figure>'],
                                        ['<table class="table table-bordered table-hover"><tbody>', '</tbody></table>'],
                                        $desc
                                    );
                                @endphp

                                {!! $desc ?? '<p>No details available for this event.</p>' !!}
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