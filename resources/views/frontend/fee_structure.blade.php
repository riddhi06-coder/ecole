<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-admission-procedure-breadcrumb-sec" style="background-image: url('{{ asset('uploads/admissions/'.$fee_structure_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $fee_structure_banner->banner_heading ? $fee_structure_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ url('/') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Admissions<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $fee_structure_banner->banner_heading ? $fee_structure_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>


        <section class="fee-structure-sec">
            <div class="container">
                
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="fee-structure-content-sec">
                            <h4 class="fee-structure-title">{{  $fee_structure_banner->section_heading ? $fee_structure_banner->section_heading : 'What sets us apart?' }}</h4>
                            <p><strong>{{  $fee_structure_banner->section_description ? $fee_structure_banner->section_description : 'What sets us apart?' }}</strong></p>


                            <p class="one-time-fees-one-sec"><strong>One-Time Fees</strong></p>
                            <p>(Payable at the time of admission)</p>
                            <div class="table-responsive fees-table-one-sec">
                                <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                    <td scope="col"></td>
                                    <td scope="col">Indian Residents/OCI &amp; PIO CardHolders (Rs)</td>
                                    <td scope="col">Non-Indians (Euros)</td>
                                    </tr>
                                    <tr>
                                    <td>Brochure &amp; Application Processing Fee (Non-refundable)</td>
                                    <td>12,000</td>
                                    <td>200</td>
                                    </tr>
                                    <tr>
                                    <td>One time Admission Fee (Non-refundable)</td>
                                    <td>3,00,000</td>
                                    <td>7,500</td>
                                    </tr>
                                    <tr>
                                    <td>Security Deposit (Refundable only at the time of leaving, non-interest bearing)</td>
                                    <td>3,00,000</td>
                                    <td>7,500</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                            <p><strong>Annual Fees</strong></p>
                            <div class="table-responsive fees-table-one-sec">
                                <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                    <td scope="col">Grade</td>
                                    <td scope="col">Indian Residents /OCI & PIO CardHolders (Rs)</td>
                                    <td scope="col">Non-Indians (Euros)</td>
                                    </tr>
                                    <tr>
                                    <td>Nursery / KG – I / KG – II</td>
                                    <td>6,90,000</td>
                                    <td>16,000</td>
                                    </tr>
                                    <tr>
                                    <td>Grade 1-10</td>
                                    <td>9,90,000</td>
                                    <td>23,000</td>
                                    </tr>
                                    <tr>
                                    <td>Grade 11-12</td>
                                    <td>10,90,000</td>
                                    <td>26,000</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                            <p><strong>The Annual Fees Include:</strong></p>
                            <ul class="listing-one">
                                <li>Textbooks, including IB Diploma Programme textbooks</li>
                                <li>Basic exercise books</li>
                                <li>Three sets of essential uniforms</li>
                                <li>Two sports uniforms</li>
                                <li>Use of the school laboratories</li>
                                <li>Use of the school computer centres</li>
                                <li>Use of the school libraries</li>
                                <li>Use of the school swimming pool</li>
                                <li>Use of the school gymnasium</li>
                                <li>The cost of consumables in courses such as Art, Craft, Design Technology, Drama and Theatre etc.
                                </li>
                                <li>Identity cards issued to students, parents and caretakers</li>
                            </ul>

                            <p><strong>Optional:</strong></p>
                            <div class="table-responsive fees-table-one-sec">
                                <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                    <td>1.</td>
                                    <td>School Bus Service (air-conditioned)</td>
                                    <td>Rs. 2,25,000/- per annum / Euros 4,500 per annum (Andheri to Bandra - Rs. 1,75,000/- per annum
                                        / Euros 3,500 per annum)</td>
                                    </tr>
                                    <tr>
                                    <td>2.</td>
                                    <td>Meals in the school dining hall</td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td>3.</td>
                                    <td>Examination Fees (Grade 10 – MYP eAssessment & Grade 12 – IBDP)</td>
                                    <td></td>
                                    </tr>
                                    <tr>
                                    <td>4.</td>
                                    <td>Field Trips</td>
                                    <td></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                            <p><strong>Payment of Fees :</strong></p>
                            <ol class="listing-two">
                                <li>The Admission Fee, Security Deposit and Annual Fee are payable in Indian Rupees/Euros, as applicable
                                within 7 days of notification of admission.</li>
                                <li>Fees once paid to the school will not be refunded under any circumstances.</li>
                                <li>The Application Processing Fee can be paid online by credit card on the school website or by demand
                                draft in favour of “École Mondiale World School”.</li>
                                <li>In case of an NRI student where the Security Deposit has been paid in rupees (equivalent to the Euro
                                rate) at the time of admission, the same amount in rupees will be refunded from the refundable portion
                                whenever the student is leaving the school.</li>
                                <li>École Mondiale World School reserves the right to revise the fee structure in the future.</li>
                                <li>The Security Deposit is collected against damage to, or loss of, library books, laboratory
                                equipment, computer facilities and other equipment or assets or sending courier on behalf of the
                                student of the school. It will be refunded without interest, after adjustment of dues, if any, on
                                completion of the student’s studies at École Mondiale World School.</li>
                            </ol>

                            <p>Ecole Mondiale World School formulates regulations necessary for the smooth and effective functioning
                                of the school. The school reserves the right to amend the regulations wherever and whenever considered
                                necessary and appropriate. Therefore, this publication and the descriptions contained herein are not to
                                be construed as a contract binding Ecole Mondiale World School to any specific policies. The information
                                given in the brochure and application material is an indication of Ecole Mondiale World School’s plans
                                on the date of publication of this document. The submission of an application for admission does not
                                guarantee admission.
                            </p>
                            
                        </div>
                    </div>
                </div>


                <div class="programmes-offer-btn-sec">
                    <div class="row">
                        <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                        <a class="progress-offers-btn" target="_blank"
                            href="https://api.whatsapp.com/send/?phone=9326020914&amp;text=Hello%20%C3%89cole%20Admissions%20Team%2C%0A%0AI%E2%80%99m%20interested%20in%20admissions%202026-27.&amp;utm_source=website&amp;utm_medium=cta&amp;utm_campaign=admissions_whatsapp">Schedule
                            a Campus Tour</a>
                        </div>
                        <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                        <a class="progress-offers-btn" target="_blank"
                            href="https://api.whatsapp.com/send/?phone=9326020914&amp;text=Hello%20%C3%89cole%20Admissions%20Team%2C%0A%0AI%E2%80%99m%20interested%20in%20admissions%202026-27.&amp;utm_source=website&amp;utm_medium=cta&amp;utm_campaign=admissions_whatsapp">Download
                            School Brochure (PDF)</a>
                        </div>
                        <div class="col-12 col-md-4 prog-offer-btn-sub-sec">
                        <a class="progress-offers-btn" target="_blank"
                            href="https://api.whatsapp.com/send/?phone=9326020914&amp;text=Hello%20%C3%89cole%20Admissions%20Team%2C%0A%0AI%E2%80%99m%20interested%20in%20admissions%202026-27.&amp;utm_source=website&amp;utm_medium=cta&amp;utm_campaign=admissions_whatsapp">Speak
                            to Admissions Advisor</a>
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