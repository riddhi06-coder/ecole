<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-faq-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$gallery_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $gallery_banner->banner_heading ? $gallery_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="../">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $gallery_banner->banner_heading ? $gallery_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="gallery-tab-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <ul class="nav nav-tabs row g-12 custom-tabs w-100" id="mediaTab" role="tablist">
                    <li class="nav-item col-6" role="presentation">
                        <button class="nav-link active w-100" id="images-tab" data-bs-toggle="tab" data-bs-target="#images"
                        type="button" role="tab" aria-controls="images" aria-selected="true">
                        Images
                        </button>
                    </li>
                    <li class="nav-item col-6" role="presentation">
                        <button class="nav-link w-100" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos"
                        type="button" role="tab" aria-controls="videos" aria-selected="false">
                        Videos
                        </button>
                    </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content" id="mediaTabContent">
                        <!-- Images Tab -->
                        <div class="tab-pane fade show active" id="images" role="tabpanel" aria-labelledby="images-tab">
                            <div class="gallery-one-sec">
                                <div class="row gallery-wrapper">
                                    @forelse($gallery as $item)
                                        @php
                                            $images = json_decode($item->gallery_images, true) ?? [];
                                            $imageCount = count($images);
                                        @endphp

                                        <div class="col-md-4 gallery-card-sec">
                                            <div class="gallery-inner-sec">
                                                <div class="album-card">
                                                    <div class="album-counter">
                                                        <img src="{{ asset('frontend/assets/img/icons/gallery-icon.webp') }}" alt="Gallery Icon">
                                                        {{ $imageCount }}
                                                    </div>

                                                    @if(isset($images[0]))
                                                        <img src="{{ asset('uploads/campus-life/gallery/' . $images[0]) }}"
                                                            alt="{{ $item->event_name }}" class="img-responsive">
                                                    @else
                                                        <img src="{{ asset('assets/img/default-placeholder.png') }}"
                                                            alt="No Image" class="img-responsive">
                                                    @endif

                                                    <div class="album-overlay">
                                                        <div class="album-header">
                                                            <h3>
                                                                <a href="{{ route('gallery.show', $item->slug) }}">
                                                                    {{ $item->event_name }}
                                                                </a>
                                                            </h3>
                                                        </div>
                                                        <div class="album-details">
                                                            <a href="{{ route('gallery.show', $item->slug) }}" class="btn-link">
                                                                <i class="fa-solid fa-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">No gallery images available.</p>
                                    @endforelse
                                </div>

                                <div class="gallery-btn-sec">
                                    <button id="viewMoreBtn" class="gallery-btn btn">View More</button>
                                </div>
                            </div>
                        </div>
              

                        <!-- Videos Tab -->
                        <div class="tab-pane fade show" id="videos" role="tabpanel" aria-labelledby="videos-tab">
                            <div class="gallery-video-sec">
                                <div class="row gallery-video-wrapper">
                                    @forelse($gallery_videos as $video)
                                        <div class="col-md-4 gallery-video-card">
                                            <div class="media-gallery">
                                                <div class="media-card">
                                                    <div class="media-video">
                                                        <iframe 
                                                            src="{{ $video->video_iframe_url }}" 
                                                            title="{{ $video->title }}" 
                                                            frameborder="0" 
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                            allowfullscreen>
                                                        </iframe>
                                                    </div>
                                                    <div class="media-overlay">
                                                        <div class="media-header">
                                                            <h3>
                                                                <a href="{{ $video->video_url }}" target="_blank">
                                                                    {{ $video->title }}
                                                                </a>
                                                            </h3>
                                                        </div>
                                                        <div class="media-action">
                                                            <a href="{{ $video->video_url }}" target="_blank" class="media-btn">
                                                                <i class="fa-solid fa-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">No videos found.</p>
                                    @endforelse

                                    <div class="gallery-btn-sec w-100 text-center mt-3">
                                        <button id="viewMorevideoBtn" class="gallery-btn btn">View More</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

    </main>

    
    @include('components.frontend.footer')

    @include('components.frontend.main-js')


    <script>
        $(document).ready(function () {
        let itemsToShow = 6; // show first 6
        let increment = 6;   // show 6 more on each click

        // Initially show first 6
        $(".gallery-card-sec").slice(0, itemsToShow).show();

        $("#viewMoreBtn").on("click", function () {
            let hiddenItems = $(".gallery-card-sec:hidden");
            hiddenItems.slice(0, increment).slideDown();

            // Hide button if no more items
            if ($(".gallery-card-sec:hidden").length === 0) {
            $(this).fadeOut();
            }
        });
        });
    </script>

    <script>
        $(document).ready(function () {
        let itemsToShow = 6; // show first 6
        let increment = 6;   // show 6 more on each click

        // Initially show first 6
        $(".gallery-video-card").slice(0, itemsToShow).show();

        $("#viewMorevideoBtn").on("click", function () {
            let hiddenItems = $(".gallery-video-card:hidden");
            hiddenItems.slice(0, increment).slideDown();

            // Hide button if no more items
            if ($(".gallery-video-card:hidden").length === 0) {
            $(this).fadeOut();
            }
        });
        });
    </script>


</body>
</html>