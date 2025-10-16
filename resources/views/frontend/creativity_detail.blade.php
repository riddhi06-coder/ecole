<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        @php
            // Find the current detailed section by slug
            $currentSection = null;
            if($activity && !empty($activity->detailed_sections)) {
                $sections = json_decode($activity->detailed_sections, true);
                foreach($sections as $section) {
                    if($section['slug'] === request()->segment(2)) {
                        $currentSection = $section;
                        break;
                    }
                }
            }

            // Page title
            $pageTitle = $currentSection['event_name']  ?? 'Activity';

            // Determine the banner image
            $bannerImage = null;
            if ($currentSection['banner_image'] ?? false) {
                $bannerImage = asset('uploads/academics/' . $currentSection['banner_image']);
            } elseif ($activity->banner_image) {
                $bannerImage = asset('uploads/academics/' . $activity->banner_image);
            }
        @endphp

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec"
                @if($bannerImage)
                style="background-image: url('{{ $bannerImage }}'); background-size: cover; background-position: center;"
                @endif>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>{{ $pageTitle }}</h1>
                        <ul class="bread-list">
                            <li><a href="{{ route('frontend.index') }}">Home<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{ $pageTitle }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Event Detail Section --}}
        <section class="coffee-house-apart-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="coffee-house-content-sec">
                            <h4 class="coffee-house-title">{{ $pageTitle }}</h4>
                            <p>{!! $currentSection['detailed_description'] ?? $activity->description ?? '' !!}</p>
                        </div>
                    </div>
                </div>

                @if(!empty($currentSection['gallery_images']))
                    <div class="coffee-gallery">
                        <div class="row g-3">
                            @foreach($currentSection['gallery_images'] as $key => $image)
                                <div class="col-md-4 col-sm-6">
                                    <div class="gallery-item">
                                        <img src="{{ asset('uploads/academics/' . $image) }}" class="img-fluid" alt="{{ $pageTitle }} {{ $key+1 }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </section>

    </main>



    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>