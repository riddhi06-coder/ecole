<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-bulletin-board-breadcrumb-sec"  
            style="background-image: url('{{ asset('uploads/bulletin/' . $category->banner_image) }}'); 
                background-size: cover; 
                background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>{{ $category->banner_heading }}</h1>
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="{{ route('frontend.bulletin_board') }}">Bulletin Board<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{ $category->banner_heading }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        <section class="bulletin-board-sec">
            <div class="container">
                <div class="row">

                <div class="col-md-8">
                    <div class="bulletin-board-blog-wrap">
                        <div class="row">
                            @forelse($bulletin_board_category_list as $bulletin)
                                <div class="col-md-6 bull-bb-card-sec">
                                    <div class="bb-card-inner-sec">
                                        <div class="bb-img-sec">
                                            <a href="{{ route('frontend.bulletin_board_details', [
                                                    'category_slug' => $category->slug ?? '',
                                                    'article_slug'  => $bulletin->slug ?? ''
                                                ]) }}">
                                                @if(!empty($bulletin->thumbnail_image))
                                                    <img class="bb-img-main" 
                                                         src="{{ asset('uploads/bulletin/' . $bulletin->thumbnail_image) }}" 
                                                         alt="{{ $bulletin->title }}">
                                                @elseif(!empty($bulletin->thumbnail_video))
                                                    <video class="bb-img-main" autoplay muted loop playsinline>
                                                        <source src="{{ asset('uploads/bulletin/videos/' . $bulletin->thumbnail_video) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @else
                                                    NA
                                                @endif
                                               
                                                <span class="bb-date">{{ \Carbon\Carbon::parse($bulletin->article_date)->format('d M') }}</span>
                                                <span class="bb-author-sec"><img src="{{ asset('frontend/assets/img/icons/user-icon.webp') }}" alt="User Icon"> By {{ $bulletin->article_author ?? 'EMWS1' }}</span>
                                            </a>
                                        </div>
                                        <div class="bb-content-sec">
                                            <h4>
                                                <a href="{{ route('frontend.bulletin_board_details', [
                                                    'category_slug' => $category->slug ?? '',
                                                    'article_slug'  => $bulletin->slug ?? ''
                                                ]) }}">{{ $bulletin->article_name }}</a>
                                            </h4>
                                            <p>
                                                <a href="{{ route('frontend.bulletin_board_details', [
                                                    'category_slug' => $category->slug ?? '',
                                                    'article_slug'  => $bulletin->slug ?? ''
                                                ]) }}">{{ $bulletin->short_desc  }}</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">
                                    <p>No Bulletins Available.</p>
                                </div>
                            @endforelse

                            @if($bulletin_board_category_list->count() > 6)
                                <div class="gallery-btn-sec">
                                    <button id="viewMorebbb-btn" class="gallery-btn btn">View More</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="bb-side-bar-search-sec">
                        <h4 class="bb-sidebar-title">Search</h4>

                        <div class="bb-search_widget">
                            <form action="{{ route('frontend.bulletin_board_category_list', $category->slug) }}" method="GET">
                                <input class="search-input" type="search" name="search" placeholder="Search Here" value="{{ request('q') }}">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>

                    </div>


                    <!-- Categories -->
                    <div class="bb-side-bar-categories-sec">
                        <h4 class="bb-sidebar-title">Categories</h4>
                        <div class="bb-catego-listing-sec">
                            <ul>
                                @foreach($bulletin_categories ?? [] as $category)
                                <li>
                                    <a href="{{ route('frontend.bulletin_board_category_list', ['category_slug' => $category->slug]) }}">
                                        {{ $category->category }} 
                                        <span class="post_counter">{{ $category->listings_count }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Recent Posts -->
                    @if(!empty($recent_posts) && $recent_posts->count() > 0)
                        <div class="bb-sidebar-recent-blog-sec">
                            <h4 class="bb-sidebar-title">Recent Posts</h4>
                            <div class="bb-recent-blog-inner-sec">
                                @foreach($recent_posts as $post)
                                    <div class="blog-img-content">
                                        <div class="blog-img">
                                            @if(!empty($post->thumbnail_image))
                                                <img src="{{ asset('uploads/bulletin/' . $post->thumbnail_image) }}" alt="{{ $post->article_name }}">
                                            @elseif(!empty($post->thumbnail_video))
                                                <video autoplay muted loop playsinline style="width: 100%; height: auto; object-fit: cover;">
                                                    <source src="{{ asset('uploads/bulletin/videos/' . $post->thumbnail_video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                NA
                                            @endif
                                        </div>

                                        <div class="blog-text headline">
                                            <p class="dd-ecol-sidebar-date-sec">{{ \Carbon\Carbon::parse($post->article_date)->format('d M') }}</p>
                                            <h3>
                                                <a href="{{ route('frontend.bulletin_board_details', [
                                                    'category_slug' => $post->category->slug ?? '',
                                                    'article_slug'  => $post->slug ?? ''
                                                ]) }}">
                                                    {{ $post->article_name }}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tags -->
                    @php
                        // Step 1: Collect all comma-separated tags from non-empty entries
                        $allTags = $bulletin_board_category_list
                            ->filter(function($item) {
                                return !empty($item->special_tags);
                            })
                            ->flatMap(function($item) {
                                // Step 2: Split and trim each tag
                                return collect(explode(',', $item->special_tags))->map(fn($t) => trim($t))
                                    ->filter(); // remove empty after trimming
                            })
                            ->unique() // Step 3: Remove duplicate tags
                            ->values(); // reset keys
                    @endphp

                    @if($allTags->count())
                        <div class="bb-tag-sec">
                            <h4 class="bb-sidebar-title">Tags</h4>
                            <div class="bb-popular_tag">
                                <ul>
                                    @foreach($allTags as $tag)
                                        <li>
                                            <a href="{{ route('frontend.bulletin_board_category_list', ['category_slug' => $bulletin_board_category_list->first()->category->slug ?? '']) }}?tag={{ urlencode($tag) }}">
                                                {{ $tag }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif


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

        // Hide all first, then show first 6
        $(".bull-bb-card-sec").hide();
        $(".bull-bb-card-sec").slice(0, itemsToShow).show();

        $("#viewMorebbb-btn").on("click", function () {
            let hiddenItems = $(".bull-bb-card-sec:hidden");
            hiddenItems.slice(0, increment).slideDown();

            // Hide button if no more items
            if ($(".bull-bb-card-sec:hidden").length === 0) {
            $(this).fadeOut();
            }
        });
        });
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.bb-content-sec p').forEach(p => {
                if (!p.textContent.trim()) {
                    p.style.display = 'none';
                }
            });
        });
    </script>
    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".bull-bb-card-sec");
    
        cards.forEach(card => {
            const img = card.querySelector(".bb-img-main");
            const content = card.querySelector(".bb-content-sec");
    
            if (!img || !content) return;
    
            const pTag = content.querySelector("p");
    
            // If <p> doesn't exist or is empty
            if (!pTag || pTag.textContent.trim() === "") {
                img.style.height = "310px";  // Larger height when no paragraph
            } else {
                img.style.height = "250px";  // Normal height when paragraph exists
            }
    
            img.style.objectFit = "cover";
        });
    });
    </script>

    
    



</body>
</html>