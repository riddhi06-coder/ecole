<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$cas_service_programme_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; ">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1> {{  $cas_service_programme_banner->banner_heading ? $cas_service_programme_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)"> {{  $cas_service_programme_banner->banner_heading ? $cas_service_programme_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="creativity-service-programme-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="creativity-service-programme-img-sec">
                    <img src="{{ asset('uploads/academics/'.$cas_service_programme_banner->section_image) }}" class="img-fluid"
                        alt="What sets us apart Image">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="creativity-service-programme-content-sec">
                        <h4 class="creativity-service-programme-title">{{  $cas_service_programme_banner->section_heading ? $cas_service_programme_banner->section_heading : 'What sets us apart?' }}</h4>
                        <p>{{  $cas_service_programme_banner->section_description ? $cas_service_programme_banner->section_description : 'What sets us apart?' }}</p>




                        <h6>Creativity:</h6>
                        <p>'Exploring or extending ideas leading to an original or interpretive product or performance'</p>
                        <p>The school provide after-school activities that involve students in various roles and responsibilities
                            to use their creative minds and plan for school events such as the EMUN, the Coffee House, the
                            Battlelaureate, and TEDxÉMWS</p>
                        <h6>EMUN:</h6>
                        <ul class="listing-one">
                            <li><a href="#">Coffee House</a></li>
                            <li><a href="#">Battlelaureate</a></li>
                            <li><a href="#">TEDxÉMWS</a></li>
                        </ul>
                        <h6>Activity:</h6>
                        <p>'Physical exertion contributes to a healthy lifestyle'</p>
                        <p>The annual CAS trips happen in late October each year. The students undertake challenging and exciting
                            physical activities to not only learn some life skill but also develop their personality and leadership
                            qualities. The trips also provide opportunities to perform acts of service or create some delightful art
                            pieces.</p>
                        <h6>CAS Trips:</h6>
                        <ul class="listing-one">
                            <li><a href="#">Prague and Berlin</a></li>
                            <li><a href="#">Rishikesh</a></li>
                            <li><a href="#">Uttrakhand</a></li>
                            <li><a href="#">Pondicherry</a></li>
                            <li><a href="#">Nepal</a></li>
                        </ul>
                        <h6>Service:</h6>
                        <p>'Collaborative and reciprocal engagement with the community in response to an authentic community
                            need.' École Mondiale in collaboration with NGOs provides platforms for the students to get involved
                            with their communities. Listed below are examples of NGO's that we connect with.</p>
                        <ul class="listing-one">
                            <li><a href="#">Sol’s Arc Sports Day preparation</a></li>
                            <li>Sanskardham Annual day preparations</li>
                            <li>Angel Express Teaching activities</li>
                            <li>Sane Guruji Sports activities</li>
                            <li><a href="#">Compete to Defeat</a></li>
                            <li>Computer lessons to Asha Kiran students</li>
                            <li>Computer lessons to C.H.I.P</li>
                        </ul>
                        <h6>Unheard Voices:</h6>
                        <p>The Unheard voice is an event to spotlight the situation of the communities or strata of society less
                            heard of, such as the transgender community and the Scavengers amidst us. Guest speakers and volunteers
                            from these communities are invited to the school to highlight the situation.</p>
                        <h6>Habitat for Humanity Karjat build project:</h6>
                        <p>Once a year and mostly on a Saturday very early morning, the volunteer students of the DP program go to
                            the nearby town of Karjat to literally get their hand dirty and help build houses for the villagers in
                            the area.</p>
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