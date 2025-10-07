<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-policies-breadcrumb-sec" style="background-image: url('{{ asset('uploads/academics/'.$primary_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center; ">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $primary_banner->banner_heading ? $primary_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="academic.html">Academics<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="curriculum-overview.html">Curriculum Overview<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $primary_banner->banner_heading ? $primary_banner->banner_heading : 'What sets us apart?' }}</a></li>
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
                            $tableHtml = $curriculum_overview_banner->ib_diploma_desc ?? '<p>No table data available.</p>';

                            $dom = new \DOMDocument('1.0', 'UTF-8');
                            libxml_use_internal_errors(true);
                            $dom->loadHTML(mb_convert_encoding($tableHtml, 'HTML-ENTITIES', 'UTF-8'));
                            libxml_clear_errors();

                            $rows = $dom->getElementsByTagName('tr');

                            // Track rowspans
                            $rowspanTracker = [];

                            foreach ($rows as $row) {
                                $cells = [];
                                foreach (['th', 'td'] as $tag) {
                                    foreach ($row->getElementsByTagName($tag) as $cell) {
                                        $cells[] = $cell;
                                    }
                                }

                                // Determine first visual column (skip rowspans)
                                $visualColIndex = 0;
                                foreach ($cells as $cell) {
                                    while (isset($rowspanTracker[$visualColIndex]) && $rowspanTracker[$visualColIndex] > 0) {
                                        $visualColIndex++;
                                    }

                                    // Only color first visual column if cell has content
                                    $text = trim($cell->textContent);
                                    if ($visualColIndex === 0 && !empty($text) && $text !== '&nbsp;') {
                                        $existingClass = $cell->getAttribute('class');
                                        $cell->setAttribute('class', trim($existingClass . ' blue-bg'));
                                    }

                                    // Track rowspan
                                    $rowspan = $cell->getAttribute('rowspan');
                                    if ($rowspan && $rowspan > 1) {
                                        $rowspanTracker[$visualColIndex] = (int)$rowspan - 1;
                                    }

                                    $visualColIndex++;
                                }

                                // Decrease all active rowspans
                                foreach ($rowspanTracker as $col => $span) {
                                    if ($span > 0) {
                                        $rowspanTracker[$col]--;
                                    }
                                }
                            }

                            $processedHtml = $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
                        @endphp

                        <div class="table-responsive curriculum-overview-table-three-sec">
                            {!! $processedHtml !!}
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