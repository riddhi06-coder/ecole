<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-policies-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$curriculum_overview_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; ">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $primary_banner->banner_heading }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Academics<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $primary_banner->banner_heading }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


          <section class="curriculum-overview-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">

                        @php
                            $tableHtml = $curriculum_overview_banner->ib_primary_desc ?? '<p>No table data available.</p>';

                            // Row counter
                            $rowIndex = 0;

                            $processedHtml = preg_replace_callback('/<tr>(.*?)<\/tr>/s', function($matches) use (&$rowIndex) {
                                $rowContent = $matches[1];

                                $rowIndex++;

                                // Only apply yellow-bg to first cell of first 3 rows (adjust as needed)
                                if (in_array($rowIndex, [1,2,3])) { 
                                    // Add class to first <td>
                                    $rowContent = preg_replace('/<td(.*?)>/', '<td$1 class="yellow-bg">', $rowContent, 1);

                                    // Add class to first <th>
                                    $rowContent = preg_replace('/<th(.*?)>/', '<th$1 class="yellow-bg">', $rowContent, 1);
                                }

                                return '<tr>' . $rowContent . '</tr>';
                            }, $tableHtml);
                        @endphp

                        <div class="table-responsive curriculum-overview-table-one-sec">
                            {!! $processedHtml !!}
                        </div>

                    </div>
                </div>

            </div>

            <p>{{ $primary_banner->ib_primary_desc  }}</p>
        </section>

    </main>




    @include('components.frontend.footer')

    @include('components.frontend.main-js')


</body>
</html>