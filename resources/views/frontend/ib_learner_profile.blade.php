<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-academics-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$ib_learner_profile_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>{{  $ib_learner_profile_banner->banner_heading ? $ib_learner_profile_banner->banner_heading : 'What sets us apart?' }}</h1>
                        <ul class="bread-list">
                            <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                            <li><a href="javascript:void(0)">Academics<i class="fa fa-angle-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">{{  $ib_learner_profile_banner->banner_heading ? $ib_learner_profile_banner->banner_heading : 'What sets us apart?' }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="ib-learner-profile-sec">
            <div class="container">
                <div class="ib-learner-profile-inner-one-sec">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="ib-learner-profile-img-sec">
                                <img src="{{ asset('uploads/academics/' . $ib_learner_profile_banner->section_image ) }}" class="img-fluid"
                                    alt="IB Learner Profile Image">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ib-learner-profile-content-sec">
                                <h4 class="ib-learner-profile-title">{{  $ib_learner_profile_banner->section_heading ? $ib_learner_profile_banner->section_heading : 'What sets us apart?' }}</h4>
                                <p>{!!  $ib_learner_profile_banner->section_description ? $ib_learner_profile_banner->section_description : 'What sets us apart?' !!}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ib-learner-profile-inner-two-sec">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="ib-learner-profile-content-sec">
                                @foreach($ib_learner_profile as $profile)
                                    @if($profile->title && $profile->description)
                                        <p><strong>{{ $profile->title }}</strong></p>
                                        <p>{!! $profile->description !!}</p>
                                    @endif
                                @endforeach
                            </div>
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