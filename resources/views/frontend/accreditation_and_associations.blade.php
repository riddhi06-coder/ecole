<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

    <main class="main">

       {{-- Breadcrumb Section --}}
        <section class="ecolemon-breadcrumb-sec" 
                style="background-image: url('{{ asset('uploads/about/'.$accreditation_and_associations->first()->banner_image) }}'); background-size: cover; background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1>{{ $accreditation_and_associations->first()?->section_heading ?? 'Accreditation and Associations' }}</h1>
                        <ul class="bread-list">
                            <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{ $accreditation_and_associations->first()?->section_heading ?? 'Accreditation and Associations' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>


        {{-- Accreditation & Associations Section --}}
        <section class="accre-and-assoc-sec">
            <div class="container">
                {{-- Section heading and description --}}
                @if($accreditation_and_associations->first()?->section_desc)
                    <div class="row">
                        <div class="col-12">
                            <div class="accre-and-assoc-content-sec">
                                <h4 class="accre-and-assoc-title">
                                    {{ $accreditation_and_associations->first()->section_heading ?? 'Accreditation and associations' }}
                                </h4>
                                <p><strong>{!! $accreditation_and_associations->first()->section_desc !!}</strong></p>
                            </div>
                            <hr>
                        </div>
                    </div>
                @endif

                {{-- Organization / Association Details --}}
                @foreach($accreditation_and_associations as $index => $association)
                    <div class="accre-and-assoc-inner-sec">
                        <div class="row">
                            @if($association->org_image)
                                <div class="col-12 col-md-2">
                                    <div class="accre-and-assoc-img-sec">
                                        <img src="{{ asset('uploads/about/'.$association->org_image) }}" class="img-fluid" alt="{{ $association->org_name }}">
                                    </div>
                                </div>
                            @endif

                            <div class="col-12 col-md-10">
                                <div class="accre-and-assoc-inner-content-sec">
                                    <h4 class="accre-and-assoc-title">{{ $association->org_name }}</h4>
                                    <p>{!! $association->org_desc !!}</p>

                                    {{-- Show gallery images directly below description ONLY for last record --}}
                                    @if($loop->last && $association->gallery_images)
                                        <div class="d-flex flex-wrap mt-2">
                                            @foreach(json_decode($association->gallery_images) as $gallery)
                                                <div class="me-2 mb-2" style="width: auto;">
                                                    <img src="{{ asset('uploads/about/'.$gallery) }}" class="img-fluid" alt="Gallery Image" style="max-height: 80px;">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- For all non-last records, gallery images in separate row as before --}}
                            @if(!$loop->last && $association->gallery_images)
                                <div class="accre-and-assoc-inner-sec">
                                    <div class="row mt-2">
                                        @foreach(json_decode($association->gallery_images) as $gallery)
                                            <div class="col-12 col-md-3 mb-2">
                                                <div class="accre-and-assoc-img-sec">
                                                    <img src="{{ asset('uploads/about/'.$gallery) }}" class="img-fluid" alt="Gallery Image">
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </section>


    </main>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>