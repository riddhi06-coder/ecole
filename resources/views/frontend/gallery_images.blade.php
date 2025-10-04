<!DOCTYPE html>
<html lang="en">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
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
                    <h1>{{ $galleryItem->event_name }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Images<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{ $galleryItem->event_name }}</a>
                    </li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="images-gallery-details-sec">
            <div class="container">
                <div class="row">
                    @forelse($images as $image)
                        <div class="col-12 col-md-4">
                            <div class="images-inner-wrap">
                                <a href="{{ asset('uploads/campus-life/gallery/' . $image) }}"
                                data-lightbox="gallery"
                                data-title="{{ $galleryItem->event_name }}">
                                    <img src="{{ asset('uploads/campus-life/gallery/' . $image) }}"
                                        alt="{{ $galleryItem->event_name }}">
                                    <i class="fa-solid fa-magnifying-glass overlay-icon"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">No images available for this gallery.</p>
                    @endforelse
                </div>
            </div>
        </section>

    </main>


    @include('components.frontend.footer')
    
    @include('components.frontend.main-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>


</body>
</html>