<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')


    <main class="main">

       <section class="ecolemon-breadcrumb-sec ecol-apply-for-admission-breadcrumb-sec" style="background: url(/frontend/assets/img/bg/apply-for-admission-banner-img.webp);">

            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>Billing / Shipping Address</h1>
                    <ul class="bread-list">
                    <li><a href="./">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Apply For Admission<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">Billing / Shipping Address</a></li>
                    </ul>
                </div>
                </div>
            </div>
            
        </section>

        <section class="apply-for-admission-one-sec">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12">

                        <form method="POST" action="{{ route('proceed.to.payment') }}">
                            @csrf
                            <!-- ✅ Hidden fields -->
                            <input type="hidden" id="order_id" name="order_id" value="{{ $order_id }}">
                            <input type="hidden" id="t_id" name="t_id" value="{{ $t_id }}">
                            <input type="hidden" id="admission_id" name="admission_id" value="{{ $admission->id }}">
                            <input type="hidden" id="amount" name="amount" value="{{ $amount }}">


                            <!-- BILLING SECTION -->
                            <div class="procced-payment-billing-sec">
                                <h4 class="afas-details-title">Billing Information</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" id="billing_name" name="billing_name" class="form-control" placeholder="Billing Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="billing_address" name="billing_address" class="form-control" placeholder="Billing Address" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="billing_city" name="billing_city" class="form-control" placeholder="Billing City" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="billing_state" name="billing_state" class="form-control" placeholder="Billing State" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="billing_zip" name="billing_zip" class="form-control" placeholder="Billing Zip" required>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="billing_country" name="billing_country" class="form-select" required>
                                            @foreach($countries as $country)
                                                <option value="" selected disabled>Select Country *</option>
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="tel" id="billing_phone" name="billing_phone" class="form-control" placeholder="Billing Telephone" minlength="10" maxlength="16" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" id="billing_email" name="billing_email" class="form-control" placeholder="Billing Email" required>
                                    </div>
                                </div>
                            </div>

                            <!-- ✅ Checkbox for Same as Billing -->
                            <div class="form-check mt-4 mb-4">
                                <input class="form-check-input" type="checkbox" id="sameAsBilling">
                                <label class="form-check-label" for="sameAsBilling">
                                    Shipping information same as Billing
                                </label>
                            </div>

                            <!-- SHIPPING SECTION -->
                            <div class="procced-payment-shipping-sec">
                                <h4 class="afas-details-title mt-4">Shipping Information</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" id="shipping_name" name="shipping_name" class="form-control" placeholder="Shipping Name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="shipping_address" name="shipping_address" class="form-control" placeholder="Shipping Address" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="shipping_city" name="shipping_city" class="form-control" placeholder="Shipping City" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="shipping_state" name="shipping_state" class="form-control" placeholder="Shipping State" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id="shipping_zip" name="shipping_zip" class="form-control" placeholder="Shipping Zip" required>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="shipping_country" name="shipping_country" class="form-select" required>
                                            @foreach($countries as $country)
                                                <option value="" selected disabled>Select Country *</option>
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="tel" id="shipping_phone" name="shipping_phone" class="form-control" placeholder="Shipping Telephone" minlength="10" maxlength="16" required>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" id="shipping_email" name="shipping_email" class="form-control" placeholder="Shipping Email" required>
                                    </div>

                                    <!-- <div class="form-group col-12">
                                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                    </div> -->

                                    <div class="col-md-12 apply-other-info-btn">
                                        <button type="submit" class="btn">Proceed To Payment</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')

    <!-- Google reCAPTCHA Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        $(document).ready(function() {
            const admissionData = @json($admission);

            // Prefill Billing Info
            $("#billing_name").val(admissionData.student_name);
            $("#billing_address").val(admissionData.address);
            $("#billing_city").val(admissionData.city);
            $("#billing_zip").val(admissionData.pincode);

            // Set country by ID
            $("#billing_country").val(admissionData.country_id);

            const father = JSON.parse(admissionData.father_details);
            $("#billing_phone").val(father.mobile);
            $("#billing_email").val(father.email);

            // Same as billing toggle
            $("#sameAsBilling").on("change", function() {
                if (this.checked) {
                    $("#shipping_name").val($("#billing_name").val());
                    $("#shipping_address").val($("#billing_address").val());
                    $("#shipping_city").val($("#billing_city").val());
                    $("#shipping_state").val($("#billing_state").val());
                    $("#shipping_zip").val($("#billing_zip").val());
                    $("#shipping_country").val($("#billing_country").val());
                    $("#shipping_phone").val($("#billing_phone").val());
                    $("#shipping_email").val($("#billing_email").val());
                } else {
                    $("#shipping_name, #shipping_address, #shipping_city, #shipping_state, #shipping_zip, #shipping_country, #shipping_phone, #shipping_email").val('');
                }
            });
        });

    </script>



</body>
</html>