<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')

    <main class="main">


        <section class="ecolemon-breadcrumb-sec ecol-faq-breadcrumb-sec" style="background-image: url('{{ asset('uploads/admissions/'.$faq_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $faq_banner->banner_heading ? $faq_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Admissions<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $faq_banner->banner_heading ? $faq_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="faq-one-sec">
            <div class="container">
                <div class="accordion" id="accordionExample">
                    @foreach($faq as $index => $item)
                        <div class="accordion-item my-4">
                            <h2 class="accordion-header" id="heading{{ $index+1 }}">
                                <button class="accordion-button {{ $index > 0 ? 'collapsed' : '' }}" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{ $index+1 }}" 
                                        aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" 
                                        aria-controls="collapse{{ $index+1 }}">
                                    {{ $item->faq_qts }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index+1 }}" 
                                class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" 
                                aria-labelledby="heading{{ $index+1 }}" 
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    {!! $item->faq_ans !!}
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