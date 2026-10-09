<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')
    
    <style>
        /* ========== */
        .ib-learner-profile-cards-sec {
          padding: 0 0 60px;
        }
        
        .ib-learner-pro-card-row-sec {
          border: 1px solid #11317B;
          padding: 20px;
          border-radius: 10px;
        }
        
        .ib-learner-pro-card-row-sec {
          border: 1px solid #11317B;
          padding: 20px;
          border-radius: 10px;
          position: relative;
          margin-top: 20px;
          /* required */
        }
        
        .ib-learner-pro-card-row-sec:before {
          content: "";
          /*background-image: url(https://anvayafoundation.com/ecole-mondiale/public/frontend/assets/img/icons/find.png);*/
          /* replace with your icon */
          background-size: contain;
          background-repeat: no-repeat;
          width: 60px;
          height: 60px;
          opacity: 0.5;
          position: absolute;
          right: 20px;
          bottom: 30px;
          animation: upDown 6.5s ease-in-out infinite alternate;
        }
        
        /*.ib-learner-pro-card-row-sec.bg-1:before {*/
        /*  background-image: url(https://anvayafoundation.com/ecole-mondiale/public/frontend/assets/img/icons/find.png);*/
        /*}*/
        
        /*.ib-learner-pro-card-row-sec.bg-2:before {*/
        /*  background-image: url(https://anvayafoundation.com/ecole-mondiale/public/frontend/assets/img/icons/knowledge.png);*/
        /*}*/
        
        @keyframes upDown {
          0% {
            transform: translateY(10px);
          }
        
          50% {
            transform: translateY(-20px);
          }
        
          100% {
            transform: translateY(10px);
          }
        }
        
        
        .ib-learner-pro-card-row-sec .row {
          align-items: center;
        }
        
        .ib-learner-pro-card-image-sec img {
          width: 100%;
          border-radius: 10px;
        }
        
        .ib-learner-pro-card-content-sec h3 {
          color: #11317B;
          font-size: 26px;
          font-weight: 600;
          text-transform: capitalize;
          margin-bottom: 12px;
          margin-top: 12px;
        }
        
        .ib-learner-pro-card-content-sec p {
          color: #000000;
        }
        
        @media screen and (max-width: 768px) {
          .ib-learner-pro-card-row-sec {
            margin-bottom: 20px;
          }
        
          .ib-learner-pro-card-content-sec {
            text-align: center;
          }
        }
    </style>

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

                <!--<div class="ib-learner-profile-inner-two-sec">-->
                <!--    <div class="row">-->
                <!--        <div class="col-12 col-md-12">-->
                <!--            <div class="ib-learner-profile-content-sec">-->
                <!--                @foreach($ib_learner_profile as $profile)-->
                <!--                    @if($profile->title && $profile->description)-->
                <!--                        <p><strong>{{ $profile->title }}</strong></p>-->
                <!--                        <p>{!! $profile->description !!}</p>-->
                <!--                    @endif-->
                <!--                @endforeach-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->

            </div>
        </section>
        
        <section class="ib-learner-profile-cards-sec">
            <div class="container">
                <div class="row">
        
                    @foreach($ib_learner_profile as $profile)
                        <div class="col-md-6">
                            <div class="ib-learner-pro-card-row-sec bg-1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="ib-learner-pro-card-image-sec">
                                            <img src="{{ asset('uploads/academics/' . $profile->image) }}" alt="">
                                        </div>
                                    </div>
        
                                    <div class="col-md-8">
                                        <div class="ib-learner-pro-card-content-sec">
                                            <!--<h3>{{ $profile->title }}</h3>-->
                                            <p>{!! $profile->description !!}</p>
                                        </div>
                                    </div>
        
                                </div>
                            </div>
                        </div>
                    @endforeach
        
                </div>
            </div>
        </section>


    </main>

    
    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>