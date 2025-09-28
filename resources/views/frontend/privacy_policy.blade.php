<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec"    style="background-image: url('{{ asset('uploads/privacy-policy/'.$privacy_policy_banner->banner_image) }}'); 
               background-size: cover; 
               background-position: center; 
               background-repeat: no-repeat;">
            <div class="container">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{ $privacy_policy_banner->section_heading ?? 'privacy_policy_banner' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <!--<li><a href="javascript:void(0)">About us<i class="fa fa-angle-right"></i></a></li>-->
                    <li class="active"><a href="javascript:void(0)">{{ $privacy_policy_banner->section_heading ?? 'privacy_policy_banner' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="what-sets-us-apart-sec">
        <div class="container">
            <div class="row">
            <div class="col-12 col-md-12">
                <div class="what-sets-us-apart-content-sec">
                    <h4 class="what-sets-us-title">{{ $privacy_policy_banner->section_heading ?? 'Governance' }}</h4>
                    <p>{!! $privacy_policy_banner->description ?? 'Governance' !!}</p>


                        @if($privacy_policy && $privacy_policy->count())
                            @foreach($privacy_policy as $policy)
                                <div class="privacy-section">
                                    @if($policy->policy_title)
                                        <p><strong>{{ $policy->policy_title }}</strong></p>
                                    @endif

                                    @if($policy->policy)
                                        <p>{!! $policy->policy !!}</p>
                                    @endif
                                </div>
                            @endforeach
                        @endif


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