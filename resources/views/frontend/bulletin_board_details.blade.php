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
                            @if($bulletin_details->article_time_from || $bulletin_details->article_time_to)
                                <div class="event-detail-icon-sec">
                                    @if($bulletin_details->article_time_from || $bulletin_details->article_time_to)
                                        <p><i class="fa-solid fa-clock"></i> 
                                            {{ $bulletin_details->article_time_from ? \Carbon\Carbon::parse($bulletin_details->article_time_from)->format('h:i A') : '' }} 
                                            @if($bulletin_details->article_time_from && $bulletin_details->article_time_to)
                                                To 
                                            @endif
                                            {{ $bulletin_details->article_time_to ? \Carbon\Carbon::parse($bulletin_details->article_time_to)->format('h:i A') : '' }}
                                        </p>
                                    @endif

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
                
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="event-detail-content-sec">
                            <h4 class="event-detail-title">{{ $bulletin_details->title }}</h4>
                            {!! $bulletin_details->desc ?? '<p>No details available for this event.</p>' !!}
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