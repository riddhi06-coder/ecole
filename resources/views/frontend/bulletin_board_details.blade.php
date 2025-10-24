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
                <img src="{{ asset('uploads/bulletin/'assets/img/about-us/events-details-img.webp" class="img-fluid"
                    alt="What sets us apart Image">
                </div>
            </div>
            </div>
            
            <div class="event-details-one-sec">
                <div class="row">
                <div class="col-12 col-md-8">
                <div class="event-detail-content-sec">
                    <h4 class="event-detail-title">The Thrift Shift</h4>
                </div>
                <div class="event-detail-icon-sec">
                    <p><i class="fa-solid fa-clock"></i> 05:00 PM To 06:00 PM</p>
                    <p><i class="fa-solid fa-location-dot"></i> EMWS, Juhu</p>
                </div>
                
            </div>
            <div class="col-12 col-md-4">
                <a class="progress-offers-btn" target="_blank" href="#"><i class="fa-regular fa-calendar"></i> Add To Calendar</a>
            </div>
            </div>
            </div>
            
            <div class="row">
            <div class="col-12 col-md-12">
                <div class="event-detail-content-sec">
                <h4 class="event-detail-title">Event Information</h4>
                <p>Grade 9 would like to cordially invite you to the ThriftShift Auction. As part of our group service project, The Thrift Shift, we have organised the renewal and modification of various donated clothing items.</p>
                <p>Thank you for your support in our efforts to promote sustainability, assist children from the SOS village, and make the world a better place.</p>
                    <p>We are excited to see you there on October 19th at 5:00 p.m. in the DP Canteen.</p>
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