<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-policies-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$policies_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $policies_banner->banner_heading ? $policies_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="../index.html">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Academics<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $policies_banner->banner_heading ? $policies_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>

        <section class="policies-pdf-sec">
            <div class="container">
                <div class="row">
                    @forelse($job_opportunities as $policy)
                        <div class="col-12 col-md-4">
                            <div class="policies-pdf-inner-sec">
                                <img src="{{ asset('frontend/assets/img/icons/pdf.png') }}" alt="Pdf Icon" class="img-fluid">
                                <h5>
                                    <a href="{{ asset('uploads/academics/' . $policy['file']) }}" target="_blank">
                                        {{ $policy['name'] }}
                                    </a>
                                </h5>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No policies available.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        
    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>