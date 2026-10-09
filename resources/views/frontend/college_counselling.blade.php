<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')
    
    <style>
        .country-filter-card {
            position: relative;
            width: 100%;
            max-width: 280px;
            padding: 1.5rem 1.25rem 1.25rem;
            border-radius: 16px;
            background: linear-gradient(135deg, #ffffff, #f7f8ff);
            box-shadow: 0 8px 22px rgba(99, 102, 241, 0.15);
            border: 1px solid rgba(99, 102, 241, 0.15);
            text-align: center;
            overflow: hidden;
            margin: 1rem 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .country-filter-card::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: 2px;
            border-radius: 16px;
            background: linear-gradient(120deg, #6366f1, #ec4899, #06b6d4, #6366f1);
            background-size: 300% 300%;
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            animation: borderFlow 5s linear infinite;
            pointer-events: none;
        }
        
        @keyframes borderFlow {
            0% { background-position: 0% 50%; }
            100% { background-position: 300% 50%; }
        }
        
        .country-filter-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(99, 102, 241, 0.22);
        }
        
        .icon-badge {
            width: 42px;
            height: 42px;
            margin: 0 auto 0.6rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #ec4899);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px rgba(99, 102, 241, 0.4);
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .globe-emoji {
            font-size: 1.2rem;
        }
        
        .country-filter-title {
            display: block;
            font-weight: 800;
            font-size: 1rem;
            color: #1e1b4b;
            margin-bottom: 0.2rem;
            letter-spacing: 0.2px;
        }
        
        .country-filter-subtitle {
            font-size: 0.75rem;
            color: #7c7fa8;
            margin-bottom: 0.9rem;
        }
        
        .country-select-wrapper {
            position: relative;
            text-align: left;
        }
        
        .country-select {
            appearance: none;
            -webkit-appearance: none;
            width: 100%;
            padding: 0.55rem 2.2rem 0.55rem 0.9rem;
            border: none;
            border-radius: 10px;
            background: #ffffff;
            font-size: 0.85rem;
            font-weight: 600;
            color: #2d3748;
            box-shadow: inset 0 0 0 2px #e5e7ff;
            transition: box-shadow 0.3s ease;
            cursor: pointer;
        }
        
        .country-select:hover {
            box-shadow: inset 0 0 0 2px #c7c9ff;
        }
        
        .country-select:focus {
            outline: none;
            box-shadow: inset 0 0 0 2px #6366f1, 0 0 0 4px rgba(99, 102, 241, 0.18);
        }
        
        .select-arrow {
            position: absolute;
            right: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6366f1;
            pointer-events: none;
            font-size: 0.7rem;
            transition: transform 0.3s ease;
        }
        
        .country-select-wrapper:focus-within .select-arrow {
            transform: translateY(-50%) rotate(180deg);
        }
    </style>

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
                           <div class="col-12 d-flex justify-content-center">
                                <div class="country-filter-card">
                                 
                                    <label for="country" class="country-filter-title">
                                        Choose Your Country
                                    </label>
                                    <p class="country-filter-subtitle">Select your location to get started</p>
                                    <div class="country-select-wrapper">
                                        <select id="country" class="form-select country-select" name="country">
                                            <option value="">-- Select Country --</option>
                                            @foreach($availableCountries as $country)
                                                @if($country) <!-- safety check -->
                                                    <option value="{{ $country->id }}" 
                                                        {{ $country->id == 226 ? 'selected' : '' }}>
                                                        {{ $country->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down select-arrow"></i>
                                    </div>
                                </div>
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