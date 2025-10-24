<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-bulletin-board-breadcrumb-sec"   style="background-image: url('frontend/assets/img/bg/bulletin-board-banner.webp'); 
                background-size: cover; 
                background-position: center; 
                background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>Bulletin Board</h1>
                    <ul class="bread-list">
                    <li><a href="{{ route('frontend.index') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">Bulletin Board</a></li>
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
                                @forelse($bulletin_board as $bulletin)
                                    <div class="col-md-6 bull-bb-card-sec">
                                        <div class="bb-card-inner-sec">
                                            <div class="bb-img-sec">
                                                <a href="{{ route('frontend.bulletin_board_details', [
                                                        'category_slug' => $bulletin->category->slug ?? '',
                                                        'article_slug' => $bulletin->slug ?? ''
                                                    ]) }}">
                                                    <img class="bb-img-main" 
                                                        src="{{ asset('uploads/bulletin/' . ($bulletin->thumbnail_image ?? 'default.webp')) }}" 
                                                        alt="{{ $bulletin->article_name }}">
                                                    <span class="bb-date">{{ \Carbon\Carbon::parse($bulletin->created_at)->format('d M') }}</span>
                                                    <span class="bb-author-sec">
                                                        <img src="{{ asset('frontend/assets/img/icons/user-icon.webp') }}" alt="User Icon">
                                                        By {{ $bulletin->author ?? 'EMWS' }}
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="bb-content-sec">
                                                <h4>
                                                    <a href="{{ route('frontend.bulletin_board_details', [
                                                            'category_slug' => $bulletin->category->slug ?? '',
                                                            'article_slug' => $bulletin->slug ?? ''
                                                        ]) }}">
                                                        {{ $bulletin->article_name }}
                                                    </a>
                                                </h4>
                                                <p>
                                                    <a href="{{ route('frontend.bulletin_board_details', [
                                                            'category_slug' => $bulletin->category->slug ?? '',
                                                            'article_slug' => $bulletin->slug ?? ''
                                                        ]) }}">
                                                        {{ $bulletin->short_desc }}
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-12 text-center">
                                        <p>No bulletin posts found.</p>
                                    </div>
                                @endforelse
                            </div>

                            @if($bulletin_board->count() > 4)
                                <div class="gallery-btn-sec">
                                    <button id="viewMorebbb-btn" class="gallery-btn btn">View More</button>
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-md-4">
                        <div class="bb-side-bar-search-sec">
                            <h4 class="bb-sidebar-title">Search</h4>
                            <div class="bb-search_widget">
                                <form action="{{ route('frontend.bulletin_board') }}" method="GET">
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
                        <div class="bb-sidebar-recent-blog-sec">
                            <h4 class="bb-sidebar-title">Recent Posts</h4>
                            <div class="bb-recent-blog-inner-sec">
                                @foreach($recent_posts as $post)
                                    <div class="blog-img-content">
                                        <div class="blog-img">
                                            <img src="{{ asset('uploads/bulletin/' . $post->thumbnail_image) }}" alt="{{ $post->article_name }}">
                                        </div>
                                        <div class="blog-text headline">
                                            <h3><a href="{{ route('frontend.bulletin_board_details', [
                                                    'category_slug' => $post->category->slug ?? '',
                                                    'article_slug'  => $post->slug ?? ''
                                                ]) }}">{{ $post->article_name }}</a></h3>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- Tags -->
                        @if(!empty($bulletin_board->special_tags) && $bulletin_board->count())
                            <div class="bb-tag-sec">
                                <h4 class="bb-sidebar-title">Tags</h4>
                                <div class="bb-popular_tag">
                                    <ul>
                                        @foreach($bulletin_board as $tag)
                                            <li><a href="#">{{ $tag->special_tags }}</a></li>
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



</body>
</html>