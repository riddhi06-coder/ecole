<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />

<body>

    @include('components.frontend.header')



        <main class="main">

            <section class="ecolemon-breadcrumb-sec ecol-apply-for-admission-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$apply_for_admission->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
                <div class="container">
                    <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1>{{  $apply_for_admission->banner_heading ? $apply_for_admission->banner_heading : 'What sets us apart?' }}</h1>
                        <ul class="bread-list">
                        <li><a href="../">Home<i class="fa fa-angle-right"></i></a></li>
                        <li><a href="javascript:void(0)">Admissions<i class="fa fa-angle-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0)">{{  $apply_for_admission->banner_heading ? $apply_for_admission->banner_heading : 'What sets us apart?' }}</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
            </section>

            <form action="{{ route('admission.store') }}" method="POST" id="applyAdmissionForm">
                @csrf
  
                <section class="apply-for-admission-one-sec">
                    <div class="container">
                        <div class="row">

                            <div class="col-12 col-md-12">
                                <div class="apply-for-admission-content-sec">
                                <p> {!! $apply_for_admission->description !!}</p>
                                <p>Fill up the application form below. The mandatory fields are marked with an *</p>
                                </div>
                            </div>

                           <div class="col-12 col-md-4">
                                <div class="apply-for-admission-choose-sec">
                                    <div class="form-check applyforad-choose-form-check">
                                    <input class="form-check-input" type="radio" name="radioDefault" id="apply_for_admission" data-type="1" checked>
                                    <label class="form-check-label" for="apply_for_admission">
                                        Apply for admission
                                    </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                            <div class="apply-for-admission-choose-sec">
                                <div class="form-check applyforad-choose-form-check">
                                <input class="form-check-input" type="radio" name="radioDefault" id="schedule_a_visit" data-type="2">
                                <label class="form-check-label" for="schedule_a_visit">
                                    Schedule a visit for admission
                                </label>
                                </div>
                            </div>
                            </div>

                            <div class="col-12 col-md-4">
                            <div class="apply-for-admission-choose-sec">
                                <div class="form-check applyforad-choose-form-check">
                                <input class="form-check-input" type="radio" name="radioDefault" id="enquiry_for_admission" data-type="3">
                                <label class="form-check-label" for="enquiry_for_admission">
                                    Enquiry about admission
                                </label>
                                </div>
                            </div>
                            </div>

                            <!-- Hidden input to store numeric form_type -->
                            <input type="hidden" id="form_type" name="form_type" value="1">

                        </div>
                    </div>
                </section>

                <section class="apply-for-admission-form-sec">
                    <div class="container">

                            <div class="apply-for-admission-student-details-sec">
                                <h4 class="afas-details-title">Student Details</h4>
                                <div class="row g-3">

                                    <!-- Student Name & DOB -->
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Student Name *" id="name" name="name" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="date" class="form-control" placeholder="Date of birth *" id="dob" name="dob" required>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-12">
                                        <input type="text" class="form-control" placeholder="Residential Address *" id="address" name="address" required>
                                    </div>

                                    <!-- Country & City -->
                                    <div class="col-md-6">
                                        <select class="form-select" id="country" name="country" required>
                                            <option value="" selected disabled>Select Country *</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="City *" id="city" name="city" required>
                                    </div>

                                    <!-- Pincode & Present School -->
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Pincode *" id="pincode" name="pincode" required>
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Name of Present school *" id="present_school" name="present_school" required>
                                    </div>

                                    <!-- Present Grade & Grade to join -->
                                    <div class="col-md-6">
                                        <select class="form-select" id="grade" name="grade" required>
                                            <option value="" selected disabled>Present Grade *</option>
                                            <option value="1">Playschool</option>
                                            <option value="2">Nursery</option>
                                            <option value="3">Kindergarten 1</option>
                                            <option value="4">Kindergarten 2</option>
                                            <option value="5">Grade 1</option>
                                            <option value="6">Grade 2</option>
                                            <option value="7">Grade 3</option>
                                            <option value="8">Grade 4</option>
                                            <option value="9">Grade 5</option>
                                            <option value="10">Grade 6</option>
                                            <option value="11">Grade 7</option>
                                            <option value="12">Grade 8</option>
                                            <option value="13">Grade 9</option>
                                            <option value="14">Grade 10</option>
                                            <option value="15">Grade 11</option>
                                            <option value="16">Grade 12</option>
                                            <option value="17">Not Applicable</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <select class="form-select" id="join_grade" name="join_grade" required>
                                            <option value="" selected disabled>Grade to join *</option>
                                            @foreach($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->grade }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Academic Year & Nationality -->
                                    <div class="col-md-6">
                                        <select class="form-select" id="year" name="year" required>
                                            <option value="" selected disabled>Seeking Admission for Academic Year</option>
                                            @foreach($academicYears as $year)
                                                <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <select class="form-select" id="nationality" name="nationality" required>
                                            <option value="" selected disabled>Nationality</option>
                                            @foreach($nationality as $item)
                                                <option value="{{ $item->id }}">{{ $item->nationality }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="apply-for-admission-parent-details-sec">
                                <h4 class="afas-details-title">Parent/Guardian Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="father-details-sec">
                                            <div class="row g-3">

                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Father's/Guardian Name *" id="f.name" name="f.name" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <input id="fatherMobile" type="tel" class="form-control" placeholder="Father's Mobile No *" id="f.mobile" name="f.mobile"  maxlength="10" minlength="16" required>
                                                    <input type="hidden" id="fatherMobileCode" name="f.mobile_code">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Father's Occupation *" id="f.occupation" name="f.occupation" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Father's Designation *" id="f.designation" name="f.designation" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Father's Organisation *" id="f.organization" name="f.organization" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="email" class="form-control" placeholder="Father's Email *" id="f.email" name="f.email" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <input id="fatherResidence" type="tel" class="form-control"
                                                    placeholder="Father's Residence/Office No *" id="f.offtel" name="f.offtel" maxlength="10" minlength="6"  required>
                                                    <input type="hidden" id="fatherResidenceCode" name="f.offtel_code">
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Father's Office Address *" id="f.offadd" name="f.offadd" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mother-details-sec">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Mother's/Guardian Name *" id="m.name" name="m.name" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <input id="motherMobile" type="tel" class="form-control" placeholder="Mother's Mobile No *" id="m.mobile" name="m.mobile"  maxlength="10" minlength="16"
                                                    required>
                                                    <input type="hidden" id="motherMobileCode" name="m.mobile_code">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Mother's Occupation *" id="m.occupation" name="m.occupation" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" placeholder="Mother's Designation *" id="m.designation" name="m.designation" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Mother's Organisation *" id="m.organization" name="m.organization" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="email" class="form-control" placeholder="Mother's Email *" id="m.email" name="m.email" required>
                                                </div>
                                                <div class="col-md-12">
                                                    <input id="motherResidence" type="tel" class="form-control"
                                                    placeholder="Mother's Residence/Office No *" id="m.offtel" name="m.offtel"  maxlength="10" minlength="6" required>
                                                    <input type="hidden" id="motherResidenceCode" name="m.offtel_code">
                                                </div>
                                                <div class="col-md-12">
                                                    <input type="text" class="form-control" placeholder="Mother's Office Address *" id="m.offadd" name="m.offadd" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="other-information-sec">
                                <h4 class="afas-details-title">Other Information</h4>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <select class="form-select" id="passport_type" name="passport_type" required>
                                            <option value="" selected disabled>Student's Passport Type *</option>
                                            <option value="1">Indian Passport</option>
                                            <option value="2">Foreign Passport</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <select class="form-select" id="foregin_passport_type" name="foregin_passport_type" required>
                                            <option value="" selected disabled>Foreign Passport Type *</option>
                                            <option value="1">OCI (Overseas Citizenship of India)</option>
                                            <option value="2">PIO (Person of Indian Origin)</option>
                                            <option value="3">Not Applicable</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="Please share if your child has any specific learning needs / development considerations:" id="specific_learning" name="specific_learning" required>
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" class="form-control" placeholder="How did you hear about our School? *" id="heard_from" name="heard_from" required>
                                    </div>

                                    <div class="col-md-12">
                                        <textarea class="form-control" rows="3" placeholder="What do you wish to know?" id="wish_you_know" name="wish_you_know"></textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <img src="{{ asset('frontend/assets/img/logo/cc-avenue.webp') }}" alt="CC Avenue" class="img-fluid">
                                    </div>

                                    <!-- 🧩 Add reCAPTCHA Section -->
                                    <!-- <div class="form-group col-12">
                                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                    </div> -->

                                    <div class="col-md-12 apply-other-info-btn">
                                        <button type="submit" class="btn" id="heyy">Submit as Enquiry</button>
                                        <button type="button" id="proceedToPaymentBtn" class="btn">Proceed to Payment</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </section>
            
            </form>

        </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')

    <!-- Google reCAPTCHA Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

    <!----- Fetching Country code for mobile nos---->
    <script>
        // Father's Mobile
        const fatherInput = document.querySelector("#fatherMobile");
        window.intlTelInput(fatherInput, {
        initialCountry: "in",
        preferredCountries: ["in", "us", "gb"],
        separateDialCode: true
        });

        // Mother's Mobile
        const motherInput = document.querySelector("#motherMobile");
        window.intlTelInput(motherInput, {
        initialCountry: "in",
        preferredCountries: ["in", "us", "gb"],
        separateDialCode: true
        });

        // Father's Residence/Office
        const fatherResInput = document.querySelector("#fatherResidence");
        window.intlTelInput(fatherResInput, {
        initialCountry: "in",
        preferredCountries: ["in", "us", "gb"],
        separateDialCode: true
        });

        // Mother's Residence/Office
        const motherResInput = document.querySelector("#motherResidence");
        window.intlTelInput(motherResInput, {
        initialCountry: "in",
        preferredCountries: ["in", "us", "gb"],
        separateDialCode: true
        });


        $('#passport_type').on('change', function () {
            var id = $(this).val();

            if (id == 1) {
                // Disable and clear the foreign passport field
                $('#foregin_passport_type').prop('disabled', true);
                $('#foregin_passport_type').removeAttr('required');
                $('#foregin_passport_type').val(null).trigger('change'); // ✅ Proper way to clear Select2
            } else {
                // Enable and make it required again
                $('#foregin_passport_type').prop('disabled', false);
                $('#foregin_passport_type').attr('required', 'required');
            }
        });


    </script>

    <!----- Form Validations ---->
    <script>
        $(document).ready(function () {

            // 🧹 Remove existing error message when typing/selecting
            $(document).on("input change", "input, select, textarea", function () {
                $(this).removeClass("is-invalid");
                $(this).next(".error-message").remove();
            });

            // 🧍 Allow only alphabets & spaces for name fields
            $(document).on("input", "input[name*='name']", function () {
                this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
            });

            // ☎️ Allow only digits for phone and pincode fields
            $(document).on("input", "input[type='tel'], #pincode", function () {
                this.value = this.value.replace(/\D/g, '');
            });

            // 🧾 Validate on both buttons
            $("#heyy").on("click", function (e) {
                e.preventDefault(); // temporarily prevent submission for validation
                let isValid = true;
                const clickedButton = $(this).text().trim(); // Detect which button was clicked

                $(".error-message").remove();
                $("input, select, textarea").removeClass("is-invalid");

                $("input[required], select[required], textarea[required]").each(function () {
                    const field = $(this);
                    const value = field.val()?.trim();
                    const type = field.attr("type");
                    const nameAttr = field.attr("name");
                    const placeholder = field.attr("placeholder") || field.find("option:selected").text();
                    const fieldName = placeholder.replace("*", "").replace(":", "").trim();

                    // ✅ Required field check
                    if (!value) {
                        showError(field, fieldName + " is required");
                        isValid = false;
                    }
                    // ✅ Email validation
                    else if (type === "email" && !validateEmail(value)) {
                        showError(field, "Please enter a valid " + fieldName);
                        isValid = false;
                    }
                    // ✅ Mobile number validation
                    else if (type === "tel" && nameAttr !== "pincode") {
                        if (value.length < 10 || value.length > 15 || !/^\d+$/.test(value)) {
                            showError(field, "Please enter a valid " + fieldName + " (10–15 digits only)");
                            isValid = false;
                        }
                    }
                    // ✅ Pincode validation (only integers)
                    else if (nameAttr === "pincode" || field.attr("id") === "pincode") {
                        if (!/^\d+$/.test(value)) {
                            showError(field, fieldName + " must contain only numbers");
                            isValid = false;
                        }
                    }
                    // ✅ Name validation
                    else if (nameAttr?.includes("name") && !/^[A-Za-z\s]+$/.test(value)) {
                        showError(field, fieldName + " must contain only letters");
                        isValid = false;
                    }
                });


                // ✅ Grade comparison: Present Grade must be less than Grade to Join
                const presentGradeText = $("#grade option:selected").text().trim();
                const joinGradeText = $("#join_grade option:selected").text().trim();

                // Static order list (includes all grades in logical order)
                const gradeOrder = [
                    "Playschool",
                    "Nursery",
                    "Kindergarten 1",
                    "Kindergarten 2",
                    "Grade 1",
                    "Grade 2",
                    "Grade 3",
                    "Grade 4",
                    "Grade 5",
                    "Grade 6",
                    "Grade 7",
                    "Grade 8",
                    "Grade 9",
                    "Grade 10",
                    "Grade 11",
                    "Grade 12",
                    "Not Applicable"
                ];

                // Dynamic grade list from DB (Blade-injected)
                const dynamicGradeOrder = @json($grades->pluck('grade')->toArray());

                // Combine both (ensuring order from static list but allowing DB data)
                const fullGradeOrder = gradeOrder.filter(g => dynamicGradeOrder.includes(g) || gradeOrder.includes(g));

                const presentIndex = fullGradeOrder.indexOf(presentGradeText);
                const joinIndex = fullGradeOrder.indexOf(joinGradeText);

                // Compare based on grade sequence, not IDs
                if (presentIndex !== -1 && joinIndex !== -1 && presentIndex >= joinIndex) {
                    showError($("#join_grade"), "Grade to join must be higher than Present Grade");
                    isValid = false;
                }

                // ✅ reCAPTCHA validation
                // const captchaResponse = grecaptcha.getResponse();
                // if (!captchaResponse) {
                //     const captchaContainer = $(".g-recaptcha");
                //     captchaContainer.after('<div class="error-message text-danger small mt-1">Please verify that you are not a robot</div>');
                //     isValid = false;
                // }



                if (isValid) {


                    const form = document.getElementById("applyAdmissionForm");
                    const submitButtons = form.querySelectorAll("button[type='submit'], button[type='button']");

                    submitButtons.forEach((btn) => {
                        btn.disabled = true;
                        btn.classList.add("disabled");
                        btn.style.opacity = "0.6";

                        // ✅ Change text only if it's NOT the Proceed to Payment button
                        if (!btn.textContent.trim().toLowerCase().includes("proceed to payment")) {
                            btn.textContent = "Submitting...";
                        }
                    });


                    // Before submission, set hidden fields for country codes
                    const fatherMobile = window.intlTelInputGlobals.getInstance(document.querySelector("#fatherMobile"));
                    const motherMobile = window.intlTelInputGlobals.getInstance(document.querySelector("#motherMobile"));
                    const fatherResidence = window.intlTelInputGlobals.getInstance(document.querySelector("#fatherResidence"));
                    const motherResidence = window.intlTelInputGlobals.getInstance(document.querySelector("#motherResidence"));

                    $("#fatherMobileCode").val(fatherMobile.getSelectedCountryData().dialCode);
                    $("#motherMobileCode").val(motherMobile.getSelectedCountryData().dialCode);
                    $("#fatherResidenceCode").val(fatherResidence.getSelectedCountryData().dialCode);
                    $("#motherResidenceCode").val(motherResidence.getSelectedCountryData().dialCode);

                    // 🧭 Detect which button clicked and set hidden input for form type
                    const selectedRadio = $("input[name='radioDefault']:checked");
                    const formType = selectedRadio.data("type") || 1;
                    $("#form_type").val(formType);

                    // ✅ Now submit form normally
                    $("form")[0].submit();
                }
            });


            // 🧩 Helper functions
            function showError(field, message) {
                field.addClass("is-invalid");
                field.after('<div class="error-message text-danger small mt-1">' + message + '</div>');
            }

            function validateEmail(email) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            }
        });
    </script>



    <script>
        $(document).ready(function () {
            // When Proceed to Payment button is clicked
            $('#proceedToPaymentBtn').on('click', function (e) {
                e.preventDefault();

                let isValid = true;
                $(".error-message").remove();
                $("input, select, textarea").removeClass("is-invalid");

                // ✅ Run same validation logic as form submission
                $("input[required], select[required], textarea[required]").each(function () {
                    const field = $(this);
                    const value = field.val()?.trim();
                    const type = field.attr("type");
                    const nameAttr = field.attr("name");
                    const placeholder = field.attr("placeholder") || field.find("option:selected").text();
                    const fieldName = placeholder.replace("*", "").replace(":", "").trim();

                    if (!value) {
                        showError(field, fieldName + " is required");
                        isValid = false;
                    } else if (type === "email" && !validateEmail(value)) {
                        showError(field, "Please enter a valid " + fieldName);
                        isValid = false;
                    } else if (type === "tel" && nameAttr !== "pincode") {
                        if (value.length < 10 || value.length > 15 || !/^\d+$/.test(value)) {
                            showError(field, "Please enter a valid " + fieldName + " (10–15 digits only)");
                            isValid = false;
                        }
                    } else if (nameAttr === "pincode" || field.attr("id") === "pincode") {
                        if (!/^\d+$/.test(value)) {
                            showError(field, fieldName + " must contain only numbers");
                            isValid = false;
                        }
                    } else if (nameAttr?.includes("name") && !/^[A-Za-z\s]+$/.test(value)) {
                        showError(field, fieldName + " must contain only letters");
                        isValid = false;
                    }
                });

                // ✅ Grade comparison
                const presentGradeText = $("#grade option:selected").text().trim();
                const joinGradeText = $("#join_grade option:selected").text().trim();
                const gradeOrder = [
                    "Playschool", "Nursery", "Kindergarten 1", "Kindergarten 2",
                    "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5",
                    "Grade 6", "Grade 7", "Grade 8", "Grade 9", "Grade 10",
                    "Grade 11", "Grade 12", "Not Applicable"
                ];
                const dynamicGradeOrder = @json($grades->pluck('grade')->toArray());
                const fullGradeOrder = gradeOrder.filter(g => dynamicGradeOrder.includes(g) || gradeOrder.includes(g));

                const presentIndex = fullGradeOrder.indexOf(presentGradeText);
                const joinIndex = fullGradeOrder.indexOf(joinGradeText);

                if (presentIndex !== -1 && joinIndex !== -1 && presentIndex >= joinIndex) {
                    showError($("#join_grade"), "Grade to join must be higher than Present Grade");
                    isValid = false;
                }

                if (!isValid) return false;

                // ✅ Prepare AJAX data
                const form = $("#applyAdmissionForm");
                const formData = form.serializeArray();

                // Add extra hidden data (like mobile country codes)
                const fatherMobile = window.intlTelInputGlobals.getInstance(document.querySelector("#fatherMobile"));
                const motherMobile = window.intlTelInputGlobals.getInstance(document.querySelector("#motherMobile"));
                const fatherResidence = window.intlTelInputGlobals.getInstance(document.querySelector("#fatherResidence"));
                const motherResidence = window.intlTelInputGlobals.getInstance(document.querySelector("#motherResidence"));

                formData.push(
                    { name: "fatherMobileCode", value: fatherMobile.getSelectedCountryData().dialCode },
                    { name: "motherMobileCode", value: motherMobile.getSelectedCountryData().dialCode },
                    { name: "fatherResidenceCode", value: fatherResidence.getSelectedCountryData().dialCode },
                    { name: "motherResidenceCode", value: motherResidence.getSelectedCountryData().dialCode }
                );

                // Optional form type logic
                const selectedRadio = $("input[name='radioDefault']:checked");
                const formType = selectedRadio.data("type") || 1;
                formData.push({ name: "form_type", value: formType });

                // ✅ Disable button during processing
                const btn = $(this);
                btn.prop("disabled", true).text("Processing...");

                // ✅ AJAX call
                $.ajax({
                    url: "{{ route('frontend.proceed_to_payment') }}",
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        btn.prop("disabled", false).text("Proceed to Payment");

                        if (response.status === "success") {
                            alert(
                                "Order Created Successfully!\n" +
                                "Order ID: " + response.order_id + "\n" +
                                "Transaction ID: " + response.t_id
                            );

                            // Optionally redirect or open payment page
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            }
                        } else {
                            alert(response.message || "Something went wrong. Please try again.");
                        }
                    },
                    error: function (xhr) {
                        btn.prop("disabled", false).text("Proceed to Payment");
                        console.error(xhr.responseText);
                        alert("Something went wrong. Please try again.");
                    }
                });
            });

            // Helper functions
            function showError(field, message) {
                field.addClass("is-invalid");
                if (!field.next(".error-message").length) {
                    field.after('<div class="error-message text-danger small mt-1">' + message + '</div>');
                }
            }
            function validateEmail(email) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            }
        });
    </script>














</body>
</html>