<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">


        <section class="ecolemon-breadcrumb-sec ecol-academics-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$college_counselling_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>{{  $college_counselling_banner->banner_heading ? $college_counselling_banner->banner_heading : 'What sets us apart?' }}</h1>
                        <ul class="bread-list">
                            <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">Academics<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{  $college_counselling_banner->banner_heading ? $college_counselling_banner->banner_heading : 'What sets us apart?' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="college-counselling-sec">
            <div class="container">
                <div class="college-counselling-inner-one-sec">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="college-counselling-img-sec">
                                <img src="{{ asset('uploads/academics/' . $college_counselling_banner->section_image) }}" class="img-fluid"
                                    alt="College Counselling Image">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="college-counselling-content-sec">
                                <h4 class="college-counselling-title">{{  $college_counselling_banner->section_heading ? $college_counselling_banner->section_heading : 'What sets us apart?' }}</h4>
                                <p>{!! $college_counselling_banner->section_description  !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="colcouns-drop-filter-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 acedemic-desc">
                        <p>{!! $college_counselling_banner->description  !!}</p>
                    </div>

                    <div class="country-filter-sec">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <label for="country" class="form-label country-filter-title">
                                    Choose Your Country
                                </label>
                                <select id="country" class="form-select" name="country">
                                    <option value="">-- Select Country --</option>
                                    @foreach($availableCountries as $country)
                                        @if($country) <!-- safety check -->
                                            <option value="{{ $country->id }}" 
                                                {{ $country->id == 99 ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-12 col-lg-12 country-available-wrap-sec">
                                <div id="schools" class="country-ava-school-sec">
                                    @foreach($colleges as $college)
                                        @php
                                            $universityNames = array_filter(json_decode($college->name, true) ?? [], fn($name) => !empty($name));
                                            $universityUrls  = json_decode($college->url, true) ?? [];
                                            $isIndia = $college->country_id == 99;
                                        @endphp

                                        @if(count($universityNames) > 0)
                                            <div class="country-{{ $college->country_id }}-sec" style="{{ $isIndia ? '' : 'display:none;' }}">
                                                <div class="row">
                                                    @foreach($universityNames as $key => $uniName)
                                                        <div class="col-12 col-md-3">
                                                            <div class="coun-ava-card-sec" data-country="{{ $college->country_id }}">
                                                                <div class="coun-ava-card-inner">
                                                                    <div class="coun-ava-icon">
                                                                        <i class="fas fa-university"></i>
                                                                    </div>
                                                                    <h6>{{ $uniName }}</h6>
                                                                    <small>{{ $college->country_name }}</small>
                                                                    @if(!empty($universityUrls[$key]))
                                                                        <div>
                                                                            <a href="{{ $universityUrls[$key] }}" target="_blank">Visit</a>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="college-counsell-btn-sec">
            <div class="containert">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="ieypy-programme-five-btn-sec text-center">
                            @if($college_counselling_banner && $college_counselling_banner->document && file_exists(public_path('uploads/academics/' . $college_counselling_banner->document)))
                                <a class="ieypy-programme-five-inner-btn"
                                href="{{ asset('uploads/academics/' . $college_counselling_banner->document) }}"
                                target="_blank">
                                Download School Brochure (PDF)
                                </a>
                            @else
                                <a class="ieypy-programme-five-inner-btn"
                                href="{{ $college_counselling_banner->url }}"
                                target="_blank">
                                Download School Brochure (PDF)
                                </a>
                            @endif
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
            function filterSchools() {
                var selectedCountry = $("#country").val();

                if (selectedCountry === "") {
                    $(".country-ava-school-sec > div").show(); // Show all country sections
                } else {
                    $(".country-ava-school-sec > div").hide(); // Hide all sections
                    $('.country-' + selectedCountry + '-sec').show(); // Show selected country
                }
            }

            // Run filter on change
            $("#country").on("change", filterSchools);

            // Run on page load (default)
            filterSchools();
        });
    </script>


</body>
</html>