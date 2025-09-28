<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">


        <section class="ecolemon-breadcrumb-sec" style="background-image: url('{{ asset('uploads/about/'.$child_safeguarding_policy->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; 
                    <!-- background-repeat: no-repeat;" -->>
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $child_safeguarding_policy->banner_heading ? $child_safeguarding_policy->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $child_safeguarding_policy->banner_heading ? $child_safeguarding_policy->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="child-protection-policy-sec">
            <div class="container">
                <div class="row">
                <div class="col-12 col-md-12">
                    <div class="child-protection-policy-img-sec">
                    <img src="{{ asset('uploads/about/'.$child_safeguarding_policy->section_image) }}"  class="img-fluid"
                        alt="Child Protection Policy Image">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="child-protection-policy-content-sec">
                    <h4 class="child-protection-policy-title">{{ $child_safeguarding_policy->section_heading }}</h4>
                    <p>{!! $child_safeguarding_policy->section_description !!}</p>
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