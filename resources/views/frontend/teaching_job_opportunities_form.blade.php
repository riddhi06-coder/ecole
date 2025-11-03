<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')

<body>

    @include('components.frontend.header')



    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-career-breadcrumb-sec" style="background-image: url('{{ asset('uploads/careers/'.$teaching_job_opportunities_banner->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center;">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $teaching_job_opportunities_banner->banner_heading ? $teaching_job_opportunities_banner->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="{{ route('frontend.index') }}">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Careers<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="{{ route('frontend.career_opportunities') }}">Career Opportunities<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $teaching_job_opportunities_banner->banner_heading ? $teaching_job_opportunities_banner->banner_heading : 'What sets us apart?' }}</a></li>
                    </ul>
                </div>
                </div>
            </div>
        </section>
        
        <section class="apply-for-admission-one-sec">
        <div class="container">
            <div class="row">
            <div class="col-12 col-md-12">
                <div class="apply-for-admission-content-sec">
                <p>Fill up the application form below. The mandatory fields are marked with an *</p>
                </div>
            </div>
            </div>
        </div>
        </section>
        
        <section class="apply-for-admission-form-sec">
            <div class="container">
                <div class="apply-for-admission-student-details-sec">
                <h4 class="afas-details-title">1. Personal Details</h4>
                <div class="row g-3">
                    <!-- Student Name & DOB -->
                    <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Name *" required>
                    </div>

                    <!-- Country & City -->
                    <div class="col-md-6">
                    <select class="form-select" name="position_applied" required>
                        <option value="" selected disabled>Position Applied for</option>

                        @foreach($teaching_job_opportunities_form_banner as $job)
                            <option value="{{ $job->id }}">{{ $job->job_roles }}</option>
                        @endforeach
                    </select>

                    </div>

                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Select Gender *</option>
                        <option value="1">Male</option>
                        <option value="2">Female</option>	
                    </select>
                    </div>
                    <div class="col-md-6">
                    <input type="date" class="form-control" placeholder="Date of birth *" required>
                    </div>
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Nationality</option>
                        <option value="1">Afghan</option>
                        <option value="2">Albanian</option>
                        <option value="3">Algerian</option>
                        <option value="4">American Samoan</option>
                        <option value="5">Andorran</option>
                        <option value="6">Angolan</option>
                        <option value="7">Anguillan</option>
                        <option value="8">Antarctic</option>
                        <option value="9">Antiguan or Barbudan</option>
                        <option value="10">Argentine</option>
                        <option value="11">Armenian</option>
                        <option value="12">Aruban</option>
                        <option value="13">Australian</option>
                        <option value="14">Austrian</option>
                        <option value="15">Azerbaijani, Azeri</option>
                        <option value="16">Bahamian</option>
                        <option value="17">Bahraini</option>
                        <option value="18">Bangladeshi</option>
                        <option value="19">Barbadian</option>
                        <option value="20">Belarusian</option>
                        <option value="21">Belgian</option>
                        <option value="22">Belizean</option>
                        <option value="23">Beninese, Beninois</option>
                        <option value="24">Bermudian, Bermudan</option>
                        <option value="25">Bhutanese</option>
                        <option value="26">Bolivian</option>
                        <option value="27">Bosnian or Herzegovinian</option>
                        <option value="28">Motswana, Botswanan</option>
                        <option value="29">Bouvet Island</option>
                        <option value="30">Brazilian</option>
                        <option value="31">BIOT</option>
                        <option value="32">Bruneian</option>
                        <option value="33">Bulgarian</option>
                        <option value="34">Burkinabé</option>
                        <option value="35">Burundian</option>
                        <option value="36">Cambodian</option>
                        <option value="37">Cameroonian</option>
                        <option value="38">Canadian</option>
                        <option value="39">Cabo Verdean</option>
                        <option value="40">Caymanian</option>
                        <option value="41">Central African</option>
                        <option value="42">Chadian</option>
                        <option value="43">Chilean</option>
                        <option value="44">Chinese</option>
                        <option value="45">Christmas Island</option>
                        <option value="46">Cocos Island</option>
                        <option value="47">Colombian</option>
                        <option value="48">Comoran, Comorian</option>
                        <option value="49">Congolese</option>
                        <option value="50">Congolese</option>
                        <option value="51">Cook Island</option>
                        <option value="52">Costa Rican</option>
                        <option value="53">Ivorian</option>
                        <option value="54">Croatian</option>
                        <option value="55">Cuban</option>
                        <option value="56">Cypriot</option>
                        <option value="57">Czech</option>
                        <option value="58">Danish</option>
                        <option value="59">Djiboutian</option>
                        <option value="60">Dominican</option>
                        <option value="61">Dominican</option>
                        <option value="62">Ecuadorian</option>
                        <option value="63">Egyptian</option>
                        <option value="64">Salvadoran</option>
                        <option value="65">Equatorial Guinean, Equatoguinean</option>
                        <option value="66">Eritrean</option>
                        <option value="67">Estonian</option>
                        <option value="68">Ethiopian</option>
                        <option value="69">Falkland Island</option>
                        <option value="70">Faroese</option>
                        <option value="71">Fijian</option>
                        <option value="72">Finnish</option>
                        <option value="73">French</option>
                        <option value="74">French Guianese</option>
                        <option value="75">French Polynesian</option>
                        <option value="76">French Southern Territories</option>
                        <option value="77">Gabonese</option>
                        <option value="78">Gambian</option>
                        <option value="79">Georgian</option>
                        <option value="80">German</option>
                        <option value="81">Ghanaian</option>
                        <option value="82">Gibraltar</option>
                        <option value="83">Greek, Hellenic</option>
                        <option value="84">Greenlandic</option>
                        <option value="85">Grenadian</option>
                        <option value="86">Guadeloupe</option>
                        <option value="87">Guamanian, Guambat</option>
                        <option value="88">Guatemalan</option>
                        <option value="89">Guinean</option>
                        <option value="90">Bissau-Guinean</option>
                        <option value="91">Guyanese</option>
                        <option value="92">Haitian</option>
                        <option value="93">Heard Island or McDonald Islands</option>
                        <option value="94">Vatican</option>
                        <option value="95">Honduran</option>
                        <option value="96">Hong Kong, Hong Kongese</option>
                        <option value="97">Hungarian, Magyar</option>
                        <option value="98">Icelandic</option>
                        <option value="99">Indian</option>
                        <option value="100">Indonesian</option>
                        <option value="101">Iranian, Persian</option>
                        <option value="102">Iraqi</option>
                        <option value="103">Irish</option>
                        <option value="104">Israeli</option>
                        <option value="105">Italian</option>
                        <option value="106">Jamaican</option>
                        <option value="107">Japanese</option>
                        <option value="108">Jordanian</option>
                        <option value="109">Kazakhstani, Kazakh</option>
                        <option value="110">Kenyan</option>
                        <option value="111">I-Kiribati</option>
                        <option value="112">North Korean</option>
                        <option value="113">South Korean</option>
                        <option value="114">Kuwaiti</option>
                        <option value="115">Kyrgyzstani, Kyrgyz, Kirgiz, Kirghiz</option>
                        <option value="116">Lao, Laotian</option>
                        <option value="117">Latvian</option>
                        <option value="118">Lebanese</option>
                        <option value="119">Basotho</option>
                        <option value="120">Liberian</option>
                        <option value="121">Libyan</option>
                        <option value="122">Liechtenstein</option>
                        <option value="123">Lithuanian</option>
                        <option value="124">Luxembourg, Luxembourgish</option>
                        <option value="125">Macanese, Chinese</option>
                        <option value="126">Macedonian</option>
                        <option value="127">Malagasy</option>
                        <option value="128">Malawian</option>
                        <option value="129">Malaysian</option>
                        <option value="130">Maldivian</option>
                        <option value="131">Malian, Malinese</option>
                        <option value="132">Maltese</option>
                        <option value="133">Marshallese</option>
                        <option value="134">Martiniquais, Martinican</option>
                        <option value="135">Mauritanian</option>
                        <option value="136">Mauritian</option>
                        <option value="137">Mahoran</option>
                        <option value="138">Mexican</option>
                        <option value="139">Micronesian</option>
                        <option value="140">Moldovan</option>
                        <option value="141">Monégasque, Monacan</option>
                        <option value="142">Mongolian</option>
                        <option value="143">Montserratian</option>
                        <option value="144">Moroccan</option>
                        <option value="145">Mozambican</option>
                        <option value="146">Burmese</option>
                        <option value="147">Namibian</option>
                        <option value="148">Nauruan</option>
                        <option value="149">Nepali, Nepalese</option>
                        <option value="150">Dutch, Netherlandic</option>
                        <option value="151"></option>
                        <option value="152">New Caledonian</option>
                        <option value="153">New Zealand, NZ</option>
                        <option value="154">Nicaraguan</option>
                        <option value="155">Nigerien</option>
                        <option value="156">Nigerian</option>
                        <option value="157">Niuean</option>
                        <option value="158">Norfolk Island</option>
                        <option value="159">Northern Marianan</option>
                        <option value="160">Norwegian</option>
                        <option value="161">Omani</option>
                        <option value="162">Pakistani</option>
                        <option value="163">Palauan</option>
                        <option value="165">Panamanian</option>
                        <option value="166">Papua New Guinean, Papuan</option>
                        <option value="167">Paraguayan</option>
                        <option value="168">Peruvian</option>
                        <option value="169">Philippine, Filipino</option>
                        <option value="170">Pitcairn Island</option>
                        <option value="171">Polish</option>
                        <option value="172">Portuguese</option>
                        <option value="173">Puerto Rican</option>
                        <option value="174">Qatari</option>
                        <option value="175">Réunionese, Réunionnais</option>
                        <option value="176">Romanian</option>
                        <option value="177">Russian</option>
                        <option value="178">Rwandan</option>
                        <option value="179">Saint Helenian</option>
                        <option value="180">Kittitian or Nevisian</option>
                        <option value="181">Saint Lucian</option>
                        <option value="182">Saint-Pierrais or Miquelonnais</option>
                        <option value="183">Saint Vincentian, Vincentian</option>
                        <option value="184">Samoan</option>
                        <option value="185">Sammarinese</option>
                        <option value="186">São Toméan</option>
                        <option value="187">Saudi, Saudi Arabian</option>
                        <option value="188">Senegalese</option>
                        <option value="190">Seychellois</option>
                        <option value="191">Sierra Leonean</option>
                        <option value="192">Singaporean</option>
                        <option value="193">Slovak</option>
                        <option value="194">Slovenian, Slovene</option>
                        <option value="195">Solomon Island</option>
                        <option value="196">Somali, Somalian</option>
                        <option value="197">South African</option>
                        <option value="199">Spanish</option>
                        <option value="200">Sri Lankan</option>
                        <option value="201"></option>
                        <option value="202">Surinamese</option>
                        <option value="203">Svalbard</option>
                        <option value="204">Swazi</option>
                        <option value="205">Swedish</option>
                        <option value="206">Swiss</option>
                        <option value="207">Syrian</option>
                        <option value="208">Chinese, Taiwanese</option>
                        <option value="209">Tajikistani</option>
                        <option value="210">Tanzanian</option>
                        <option value="211">Thai</option>
                        <option value="213">Togolese</option>
                        <option value="214">Tokelauan</option>
                        <option value="215">Tongan</option>
                        <option value="216">Trinidadian or Tobagonian</option>
                        <option value="217">Tunisian</option>
                        <option value="218">Turkish</option>
                        <option value="219">Turkmen</option>
                        <option value="220">Turks and Caicos Island</option>
                        <option value="221">Tuvaluan</option>
                        <option value="222">Ugandan</option>
                        <option value="223">Ukrainian</option>
                        <option value="224">Emirati, Emirian, Emiri</option>
                        <option value="225">British, UK</option>
                        <option value="226">American</option>
                        <option value="228">Uruguayan</option>
                        <option value="229">Uzbekistani, Uzbek</option>
                        <option value="230">Ni-Vanuatu, Vanuatuan</option>
                        <option value="231">Venezuelan</option>
                        <option value="232">Vietnamese</option>
                        <option value="233">British Virgin Island</option>
                        <option value="234">U.S. Virgin Island</option>
                        <option value="235">Wallis and Futuna, Wallisian or Futunan</option>
                        <option value="236">Sahrawi, Sahrawian, Sahraouian</option>
                        <option value="237">Yemeni</option>
                        <option value="238">Zambian</option>
                        <option value="239">Zimbabwean</option>
                    </select>
                    </div>
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Marital Status *</option>
                        <option value="1">Unmarried</option>
                        <option value="2">Married</option>
                        <option value="3">Other</option>
                    </select>
                    </div>
                    <div class="col-12">
                    <input type="text" class="form-control" placeholder="Current Address *" required>
                    </div>
                    <div class="col-6">
                    <input type="text" class="form-control" placeholder="Children's Age (In Years)" required>
                    </div>
                    <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Zipcode *" required>
                    </div>
                    <div class="col-md-6">
                        <input type="tel" class="form-control" placeholder="Landline No." required>
                    </div>
                    <div class="col-md-6">
                        <input type="tel" class="form-control" placeholder="Mobile No." required>
                    </div>
                    <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="Permanent Address" required>
                    </div>
                    <div class="col-md-6">
                    <input type="date" class="form-control" placeholder="Earliest Date of Availability *" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" placeholder="Email Id *" required>
                    </div>
                    <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Notice Period (In Days)" required>
                    </div>
                    <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Skype Id" required>
                    </div>
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Have you ever been convicted of a criminal offence?</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="file" name="image" id="photo_upload" class="form-control" placeholder="Upload Photograph" value="" accept="image/*" required="required">
                        <span class="error-photo-upload" style="color:red"></span>
                        <span class="text-danger"></span>
                    </div>
                </div>
                </div>
                <div class="apply-for-admission-parent-details-sec">
                <h4 class="afas-details-title">2. Passport Details</h4>
                <div class="row g-3">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="passport_no" placeholder="Passport No." value="">
                        <span class="text-danger"></span>
                    </div>
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="passport_issue_place" placeholder="Passport Issue Place" value="">
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="col-12 col-md-12 control-label">Passport Issue Date</label>
                    <input type="date" class="form-control" placeholder="Passport Issue Date" required>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="col-12 col-md-12 control-label">Passport Expiry Date</label>
                    <input type="date" class="form-control" placeholder="Passport Expiry Date" required>
                    </div>
                </div>
                </div>
                <div class="other-information-sec">
                <h4 class="afas-details-title">3. Educational Details</h4>
                <p>Starting with the educational course completed last</p>
                
                <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-light">
                    <tr class="text-center small fw-semibold">
                        <th>Name of School / College / University *</th>
                        <th>Board / Degree / Diploma *</th>
                        <th>Specialist Subject Area/s</th>
                        <th>Start Date *</th>
                        <th>Completion Date</th>
                        <th>Grade *</th>
                        <th>Percentage</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody class="table-body">
                    <tr class="main-clone-tr">
                        <td>
                        <input type="text" class="form-control" name="edu[university][]" placeholder="(e.g. Mumbai University)" required>
                        </td>
                        <td>
                        <input type="text" class="form-control" name="edu[board][]" placeholder="(e.g. HSC)" required>
                        </td>
                        <td>
                        <input type="text" class="form-control" name="edu[sp_subject][]" placeholder="(e.g. Economics)">
                        </td>
                        <td>
                        <div class="input-group">
                            <input type="text" name="edu[start_date][]" class="form-control start-date" placeholder="Start Date" required>
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                        </td>
                        <td>
                        <div class="input-group">
                            <input type="text" name="edu[completion_date][]" class="form-control end-date" placeholder="Completion Date">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                        </td>
                        <td>
                        <input type="text" class="form-control" name="edu[grade][]" placeholder="Grade" required>
                        </td>
                        <td>
                        <input type="text" class="form-control" name="edu[percentage][]" placeholder="Percentage">
                        </td>
                        <td class="text-center">
                        <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                            <i class="fa fa-plus"></i>
                        </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
                
                </div>
                <div class="other-information-sec">
                <h4 class="afas-details-title">4. List the professional development courses attended by you, if any</h4>
                <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle pctbl">
                    <thead class="table-light">
                    <tr class="text-center small fw-semibold">
                        <th>Attended</th>
                        <th>Course Description</th>
                        <th>Start Date</th>
                        <th>Completion Date</th>
                        <th>Location</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr class="main-clone-tr">
                        <td>
                        <input type="text" class="form-control" name="pd_courses_attended[attended][]" placeholder="">
                        </td>
                        <td>
                        <input type="text" class="form-control" name="pd_courses_attended[course][]" placeholder="">
                        </td>
                        <td>
                        <div class="input-group">
                            <input type="text" name="pd_courses_attended[start_date][]" class="form-control start-date" placeholder="Start Date">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                        </td>
                        <td>
                        <div class="input-group">
                            <input type="text" name="pd_courses_attended[completion_date][]" class="form-control end-date" placeholder="Completion Date">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                        </td>
                        <td>
                        <input type="text" class="form-control" name="pd_courses_attended[location][]" placeholder="Location">
                        </td>
                        <td class="text-center">
                        <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                            <i class="fa fa-plus"></i>
                        </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
                </div>
                <div class="other-information-sec">
                <h4 class="afas-details-title">5. List the professional development course description conducted by you, if any</h4>
                <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle pctbl">
                    <thead class="table-light">
                    <tr class="text-center small fw-semibold">
                        <th>Conducted</th>
                        <th>Course Description</th>
                        <th>Start Date</th>
                        <th>Completion Date</th>
                        <th>Location</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr class="main-clone-tr">
                        <td><input type="text" class="form-control" name="pd_courses_conducted[attended][]" placeholder=""></td>
                        <td><input type="text" class="form-control" name="pd_courses_conducted[course][]" placeholder=""></td>
                        <td>
                        <div class="input-group">
                            <input type="text" name="pd_courses_conducted[start_date][]" class="form-control start-date" placeholder="Start Date">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                        </td>
                        <td>
                        <div class="input-group">
                            <input type="text" name="pd_courses_conducted[completion_date][]" class="form-control end-date" placeholder="Completion Date">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                        </td>
                        <td><input type="text" class="form-control" name="pd_courses_conducted[location][]" placeholder="Location"></td>
                        <td class="text-center">
                        <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                            <i class="fa fa-plus"></i>
                        </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
                </div>
                <div class="other-information-sec">
                <h4 class="afas-details-title">6. Publications/Research Papers/Documents produced (in the last 5 years)</h4>
                <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle prtbl">
                    <thead class="table-light">
                    <tr class="text-center small fw-semibold">
                        <th>Title</th>
                        <th>Published in</th>
                        <th>Date of Publishing</th>
                        <th>Presented at</th>
                        <th>Date of Presentation</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody class="table-body">
                    <tr class="main-clone-tr">
                        <td><input type="text" class="form-control" name="prd[title][]" placeholder=""></td>
                        <td><input type="text" class="form-control" name="prd[publish_in][]" placeholder=""></td>
                        <td>
                        <div class="input-group">
                            <input type="text" name="prd[publish_date][]" class="form-control start-date" placeholder="Publish Date">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                        </td>
                        <td><input type="text" class="form-control" name="prd[presented_at][]" placeholder=""></td>
                        <td>
                        <div class="input-group">
                            <input type="text" name="prd[presentation_date][]" class="form-control end-date" placeholder="Presentation Date">
                            <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        </div>
                        </td>
                        <td class="text-center">
                        <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                            <i class="fa fa-plus"></i>
                        </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
                </div>
                <div class="other-information-sec">
                <h4 class="afas-details-title">7. Other Details</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Experience at International Schools *</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    </div>
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Has any Supervisor ever raised concerns regarding you working with children ? *</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                    </div>
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Direct Experience In</option>
                        <option value="IBPYP">IBPYP</option>
                        <option value="IBMYP">IBMYP</option>
                        <option value="IBDP">IBDP</option>
                        <option value="IGCSE">IGCSE</option>
                        <option value="A Level">A Level</option>
                        <option value="None">None</option>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="current-employer" placeholder="Current Employer (eg: School/Organization Name)" value="">
                    </div>
                    
                    <div class="col-md-3">
                        <label for="title" class="col-12 col-md-12 control-label">Experience</label>
                    <select class="form-select" required>
                        <option value="" selected disabled>Select Years</option>
                        <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                <option value="32">32</option>
                <option value="33">33</option>
                <option value="34">34</option>
                <option value="35">35</option>
                <option value="35+">35+</option>
                    </select>
                    </div>
                    <div class="col-md-3">
                        <label for="title" class="col-12 col-md-12 control-label"></label>
                    <select class="form-select" required>
                        <option value="" selected disabled>Select Months</option>
                        <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="title" class="col-12 col-md-12 control-label"></label>
                            <input type="text" class="form-control" name="current_designation" placeholder="Current Designation">
                    </div>
                </div>
                </div>
                
                
                <div class="other-information-sec">
                <h4 class="afas-details-title">8. Employment Details (List the most recent first)</h4>
                <div class="row g-3">
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="school-organization" placeholder="School/Organization *">
                    </div>
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="desgination" placeholder="Desgination *">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">				
                            <input type="checkbox" class="current-working-cls" name=""> I'm still working here
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="col-12 col-md-12 control-label">Date of Joining *</label>
                    <input type="date" class="form-control" placeholder="Date of Joining *" required>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="col-12 col-md-12 control-label">Date of Leaving *</label>
                    <input type="date" class="form-control" placeholder="Date of Leaving *" required>
                    </div>
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="subject-taught" placeholder="Subject Taught">
                    </div>
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="curriculum" placeholder="Curriculum *(e.g. IB / IGCSE / ICSE)">
                    </div>
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="additional-responsibility" placeholder="Additional Responsibility">
                    </div>
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="reason-of-leaving" placeholder="Reason of Leaving">
                    </div>
                    
                    
                </div>
                </div>
                
                <div class="other-information-sec">
                <h4 class="afas-details-title">9. IT Skills & Interests</h4>
                <div class="row g-3">
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="it_skills" placeholder="IT Skills">
                    </div>
                    <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="hobbies" placeholder="Interests">
                    </div>
                    <div class="form-group col-md-12">
                        <textarea class="form-control" name="language_skills" rows="3" placeholder=" Language Skills * (e.g. English,French)" required="required" oninvalid="scroll_to_validator(this)"></textarea>		
                    </div>
                    
                </div>
                </div>
                
                <div class="other-information-sec">
                <h4 class="afas-details-title">10. Emoluments (current and expected salary)</h4>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="col-12 col-md-12 control-label">Current (Monthly) Salary In INR *</label>
                    <input type="number" class="form-control" name="current_salary" placeholder=" e.g. 20000" required>
                    </div>
                    <div class="col-md-6">
                        <label for="title" class="col-12 col-md-12 control-label">Expected (Monthly) Salary In INR *</label>
                    <input type="number" class="form-control" name="expected_salary" placeholder=" e.g. 25000" required>
                    </div>
                    
                </div>
                </div>
                
                <div class="other-information-sec">
                <h4 class="afas-details-title">11. Confidential Referees who Supervised you (minimum of three)</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle ertbl">
                            <thead class="table-light">
                            <tr class="text-center small fw-semibold">
                                <th>Reference Name *</th>
                                <th>Designation *</th>
                                <th>Phone *</th>
                                <th>Email *</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody class="table-body">
                            <tr class="main-clone-tr">
                                <td>
                                <input type="text" class="form-control required-fields" name="referees[name][]" placeholder="" required>
                                </td>
                                <td>
                                <input type="text" class="form-control required-fields" name="referees[designation][]" placeholder="" required>
                                </td>
                                <td>
                                <input type="text" class="form-control" name="referees[phone][]" maxlength="16" placeholder="Enter 10-15 digits" required>
                                <span class="mobile-error text-danger small" style="display:none;"></span>
                                </td>
                                <td>
                                <input type="email" class="form-control required-fields" name="referees[email][]" placeholder="" required>
                                </td>
                                <td>
                                <input type="text" class="form-control" name="referees[address][]" placeholder="">
                                </td>
                                <td class="text-center">
                                <button type="button" class="btn btn-primary btn-sm add-more teaching-btn-sec" onclick="addmore(this)">
                                    <i class="fa fa-plus"></i>
                                </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <textarea class="form-control" name="philosophy" rows="3" placeholder=" Describe your Philosophy of Education Maximum 500 characters" maxlength="500"></textarea>
                    </div>
                    <div class="col-md-6">
                        <textarea class="form-control" name="other_information" placeholder=" Any other information, if required" rows="3"></textarea>		
                    </div>
                    <div class="form-group col-md-6">
                        <input type="file" name="image" id="photo_upload" class="form-control" placeholder="Upload Photograph" value="" accept="image/*" required="required">
                        <span class="error-photo-upload" style="color:red"></span>
                        <span class="text-danger"></span>
                    </div>
                </div>
                </div>
                
                <div class="other-information-sec">
                <h4 class="afas-details-title">Upload Resume *</h4>
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="file" name="image" id="photo_upload" class="form-control" placeholder="Upload Photograph" value="" accept="image/*" required="required">
                        <span class="error-photo-upload" style="color:red"></span>
                        <span class="text-danger"></span>
                    </div>
                    <p>Resume Accepted file doc, docx, pdf</p>
                    <div class="form-group col-md-12">	    		 
                            <input type="checkbox" class="" name="agree_for_terms_condition" id="agree_for_terms_condition" value="1" required="required" oninvalid="scroll_to_validator(this)"> <label for="agree_for_terms_condition">I hereby declare that the above statement is true to the best of my knowledge and belief.</label>
                            <span class="text-danger"></span>
                        </div>	
                </div>
                </div>
                
                <div class="teaching-form-btn-sec">
                    <div class="teaching-job-opp-btn-sec">
                        <a href="#" class="btn-ecol btn">Submit</a>
                    </div>
                    <div class="teaching-job-opp-btn-sec">
                        <a href="#" class="btn-ecol btn">Clear All</a>
                    </div>
                </div>
                
                


            </div>
        </section>
    
    </main>

    @include('components.frontend.footer')

    @include('components.frontend.main-js')


    <script>
        function addmore(btn) {
            let row = $(btn).closest('tr').clone();
            row.find('input').val('');
            row.find('.add-more').removeClass('btn-primary').addClass('btn-danger')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');
            $('.table-body').append(row);
        }

        function removeRow(btn) {
        $(btn).closest('tr').remove();
        }
    </script>
  
    <script>
        function addmore(btn) {
            let row = $(btn).closest('tr').clone();
            row.find('input').val('');
            row.find('.add-more')
                .removeClass('btn-primary').addClass('btn-danger')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');
            $('.pctbl .table-body').append(row);
        }

        function removeRow(btn) {
        $(btn).closest('tr').remove();
        }
    </script>
    
    <script>
        function addmore(btn) {
            var $tableBody = $(btn).closest('table').find('.table-body');
            var $row = $(btn).closest('tr').clone();

            // Clear all input values in cloned row
            $row.find('input').val('');

            // Change "+" button to "-" button
            $row.find('.add-more')
                .removeClass('btn-primary add-more')
                .addClass('btn-danger remove-row')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');

            // Append cloned row to the table
            $tableBody.append($row);
        }

        function removeRow(btn) {
            $(btn).closest('tr').remove();
        }
    </script>


    <script>
        function addmore(btn) {
            var $tableBody = $(btn).closest('table').find('.table-body');
            var $row = $(btn).closest('tr').clone();

            // Clear all input values
            $row.find('input').val('');

            // Change "+" button to "-" button
            $row.find('.add-more')
                .removeClass('btn-primary add-more')
                .addClass('btn-danger remove-row')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');

            // Append cloned row to the table
            $tableBody.append($row);
        }

        function removeRow(btn) {
        $(btn).closest('tr').remove();
        }

    </script>
    
    <script>
        function addmore(btn) {
            var $tableBody = $(btn).closest('table').find('.table-body');
            var $row = $(btn).closest('tr').clone();

            // Clear all input values
            $row.find('input').val('');

            // Change "+" button to "-" button
            $row.find('.add-more')
                .removeClass('btn-primary add-more')
                .addClass('btn-danger remove-row')
                .html('<i class="fa fa-minus"></i>')
                .attr('onclick', 'removeRow(this)');

            // Append cloned row to the table
            $tableBody.append($row);
        }

        function removeRow(btn) {
            $(btn).closest('tr').remove();
        }
    </script>

</body>
</html>