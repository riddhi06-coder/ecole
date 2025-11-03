<!DOCTYPE html>
<html lang="en">

    @include('components.frontend.head')
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />

<body>

    @include('components.frontend.header')


    <main class="main">

        <section class="ecolemon-breadcrumb-sec ecol-apply-for-admission-breadcrumb-sec" style="background-image: url('{{ asset('uploads/campus-life/'.$schedule_a_visit_for_admission->banner_image) }}'); 
                    background-size: cover; 
                    background-position: center">
            <div class="container">
                <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1>{{  $schedule_a_visit_for_admission->banner_heading ? $schedule_a_visit_for_admission->banner_heading : 'What sets us apart?' }}</h1>
                    <ul class="bread-list">
                    <li><a href="../">Home<i class="fa fa-angle-right"></i></a></li>
                    <li><a href="javascript:void(0)">Admissions<i class="fa fa-angle-right"></i></a></li>
                    <li class="active"><a href="javascript:void(0)">{{  $schedule_a_visit_for_admission->banner_heading ? $schedule_a_visit_for_admission->banner_heading : 'What sets us apart?' }}</a></li>
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
                        <p> {!! $schedule_a_visit_for_admission->description !!} </p>
                        <p>Fill up the application form below. The mandatory fields are marked with an *</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="apply-for-admission-choose-sec">
                        <div class="form-check applyforad-choose-form-check">
                            <input class="form-check-input" type="radio" name="radioDefault" id="apply_for_admission" checked>
                            <label class="form-check-label" for="apply_for_admission">
                            Apply for admission
                            </label>
                        </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="apply-for-admission-choose-sec">
                        <div class="form-check applyforad-choose-form-check">
                            <input class="form-check-input" type="radio" name="radioDefault" id="schedule_a_visit" checked>
                            <label class="form-check-label" for="schedule_a_visit">
                            Schedule a visit for admission
                            </label>
                        </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="apply-for-admission-choose-sec">
                        <div class="form-check applyforad-choose-form-check">
                            <input class="form-check-input" type="radio" name="radioDefault" id="enquiry_for_admission">
                            <label class="form-check-label" for="enquiry_for_admission">
                            Enquiry About admission
                            </label>
                        </div>
                        </div>
                    </div>

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
                    <input type="text" class="form-control" placeholder="Student Name *" required>
                    </div>
                    <div class="col-md-6">
                    <input type="date" class="form-control" placeholder="Date of birth *" required>
                    </div>
                    <!-- Address -->
                    <div class="col-12">
                    <input type="text" class="form-control" placeholder="Residential Address *" required>
                    </div>
                    <!-- Country & City -->
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Select Country *</option>
                        <option value="1">Afghanistan</option>
                        <option value="2">Albania</option>
                        <option value="3">Algeria</option>
                        <option value="4">American Samoa</option>
                        <option value="5">Andorra</option>
                        <option value="6">Angola</option>
                        <option value="7">Anguilla</option>
                        <option value="8">Antarctica</option>
                        <option value="9">Antigua and Barbuda</option>
                        <option value="10">Argentina</option>
                        <option value="11">Armenia</option>
                        <option value="12">Aruba</option>
                        <option value="13">Australia</option>
                        <option value="14">Austria</option>
                        <option value="15">Azerbaijan</option>
                        <option value="16">Bahamas</option>
                        <option value="17">Bahrain</option>
                        <option value="18">Bangladesh</option>
                        <option value="19">Barbados</option>
                        <option value="20">Belarus</option>
                        <option value="21">Belgium</option>
                        <option value="22">Belize</option>
                        <option value="23">Benin</option>
                        <option value="24">Bermuda</option>
                        <option value="25">Bhutan</option>
                        <option value="26">Bolivia</option>
                        <option value="27">Bosnia and Herzegovina</option>
                        <option value="28">Botswana</option>
                        <option value="29">Bouvet Island</option>
                        <option value="30">Brazil</option>
                        <option value="31">British Indian Ocean Territory</option>
                        <option value="32">Brunei Darussalam</option>
                        <option value="33">Bulgaria</option>
                        <option value="34">Burkina Faso</option>
                        <option value="35">Burundi</option>
                        <option value="36">Cambodia</option>
                        <option value="37">Cameroon</option>
                        <option value="38">Canada</option>
                        <option value="39">Cape Verde</option>
                        <option value="40">Cayman Islands</option>
                        <option value="41">Central African Republic</option>
                        <option value="42">Chad</option>
                        <option value="43">Chile</option>
                        <option value="44">China</option>
                        <option value="45">Christmas Island</option>
                        <option value="46">Cocos (Keeling) Islands</option>
                        <option value="47">Colombia</option>
                        <option value="48">Comoros</option>
                        <option value="49">Congo</option>
                        <option value="50">Congo, the Democratic Republic of the</option>
                        <option value="51">Cook Islands</option>
                        <option value="52">Costa Rica</option>
                        <option value="53">Cote D&#039;Ivoire</option>
                        <option value="54">Croatia</option>
                        <option value="55">Cuba</option>
                        <option value="56">Cyprus</option>
                        <option value="57">Czech Republic</option>
                        <option value="58">Denmark</option>
                        <option value="59">Djibouti</option>
                        <option value="60">Dominica</option>
                        <option value="61">Dominican Republic</option>
                        <option value="62">Ecuador</option>
                        <option value="63">Egypt</option>
                        <option value="64">El Salvador</option>
                        <option value="65">Equatorial Guinea</option>
                        <option value="66">Eritrea</option>
                        <option value="67">Estonia</option>
                        <option value="68">Ethiopia</option>
                        <option value="69">Falkland Islands (Malvinas)</option>
                        <option value="70">Faroe Islands</option>
                        <option value="71">Fiji</option>
                        <option value="72">Finland</option>
                        <option value="73">France</option>
                        <option value="74">French Guiana</option>
                        <option value="75">French Polynesia</option>
                        <option value="76">French Southern Territories</option>
                        <option value="77">Gabon</option>
                        <option value="78">Gambia</option>
                        <option value="79">Georgia</option>
                        <option value="80">Germany</option>
                        <option value="81">Ghana</option>
                        <option value="82">Gibraltar</option>
                        <option value="83">Greece</option>
                        <option value="84">Greenland</option>
                        <option value="85">Grenada</option>
                        <option value="86">Guadeloupe</option>
                        <option value="87">Guam</option>
                        <option value="88">Guatemala</option>
                        <option value="89">Guinea</option>
                        <option value="90">Guinea-Bissau</option>
                        <option value="91">Guyana</option>
                        <option value="92">Haiti</option>
                        <option value="93">Heard Island and Mcdonald Islands</option>
                        <option value="94">Holy See (Vatican City State)</option>
                        <option value="95">Honduras</option>
                        <option value="96">Hong Kong</option>
                        <option value="97">Hungary</option>
                        <option value="98">Iceland</option>
                        <option value="99">India</option>
                        <option value="100">Indonesia</option>
                        <option value="101">Iran, Islamic Republic of</option>
                        <option value="102">Iraq</option>
                        <option value="103">Ireland</option>
                        <option value="104">Israel</option>
                        <option value="105">Italy</option>
                        <option value="106">Jamaica</option>
                        <option value="107">Japan</option>
                        <option value="108">Jordan</option>
                        <option value="109">Kazakhstan</option>
                        <option value="110">Kenya</option>
                        <option value="111">Kiribati</option>
                        <option value="112">Korea, Democratic People&#039;s Republic of</option>
                        <option value="113">Korea, Republic of</option>
                        <option value="114">Kuwait</option>
                        <option value="115">Kyrgyzstan</option>
                        <option value="116">Lao People&#039;s Democratic Republic</option>
                        <option value="117">Latvia</option>
                        <option value="118">Lebanon</option>
                        <option value="119">Lesotho</option>
                        <option value="120">Liberia</option>
                        <option value="121">Libyan Arab Jamahiriya</option>
                        <option value="122">Liechtenstein</option>
                        <option value="123">Lithuania</option>
                        <option value="124">Luxembourg</option>
                        <option value="125">Macao</option>
                        <option value="126">Macedonia, the Former Yugoslav Republic of</option>
                        <option value="127">Madagascar</option>
                        <option value="128">Malawi</option>
                        <option value="129">Malaysia</option>
                        <option value="130">Maldives</option>
                        <option value="131">Mali</option>
                        <option value="132">Malta</option>
                        <option value="133">Marshall Islands</option>
                        <option value="134">Martinique</option>
                        <option value="135">Mauritania</option>
                        <option value="136">Mauritius</option>
                        <option value="137">Mayotte</option>
                        <option value="138">Mexico</option>
                        <option value="139">Micronesia, Federated States of</option>
                        <option value="140">Moldova, Republic of</option>
                        <option value="141">Monaco</option>
                        <option value="142">Mongolia</option>
                        <option value="143">Montserrat</option>
                        <option value="144">Morocco</option>
                        <option value="145">Mozambique</option>
                        <option value="146">Myanmar</option>
                        <option value="147">Namibia</option>
                        <option value="148">Nauru</option>
                        <option value="149">Nepal</option>
                        <option value="150">Netherlands</option>
                        <option value="151">Netherlands Antilles</option>
                        <option value="152">New Caledonia</option>
                        <option value="153">New Zealand</option>
                        <option value="154">Nicaragua</option>
                        <option value="155">Niger</option>
                        <option value="156">Nigeria</option>
                        <option value="157">Niue</option>
                        <option value="158">Norfolk Island</option>
                        <option value="159">Northern Mariana Islands</option>
                        <option value="160">Norway</option>
                        <option value="161">Oman</option>
                        <option value="162">Pakistan</option>
                        <option value="163">Palau</option>
                        <option value="165">Panama</option>
                        <option value="166">Papua New Guinea</option>
                        <option value="167">Paraguay</option>
                        <option value="168">Peru</option>
                        <option value="169">Philippines</option>
                        <option value="170">Pitcairn</option>
                        <option value="171">Poland</option>
                        <option value="172">Portugal</option>
                        <option value="173">Puerto Rico</option>
                        <option value="174">Qatar</option>
                        <option value="175">Reunion</option>
                        <option value="176">Romania</option>
                        <option value="177">Russian Federation</option>
                        <option value="178">Rwanda</option>
                        <option value="179">Saint Helena</option>
                        <option value="180">Saint Kitts and Nevis</option>
                        <option value="181">Saint Lucia</option>
                        <option value="182">Saint Pierre and Miquelon</option>
                        <option value="183">Saint Vincent and the Grenadines</option>
                        <option value="184">Samoa</option>
                        <option value="185">San Marino</option>
                        <option value="186">Sao Tome and Principe</option>
                        <option value="187">Saudi Arabia</option>
                        <option value="188">Senegal</option>
                        <option value="190">Seychelles</option>
                        <option value="191">Sierra Leone</option>
                        <option value="192">Singapore</option>
                        <option value="193">Slovakia</option>
                        <option value="194">Slovenia</option>
                        <option value="195">Solomon Islands</option>
                        <option value="196">Somalia</option>
                        <option value="197">South Africa</option>
                        <option value="199">Spain</option>
                        <option value="200">Sri Lanka</option>
                        <option value="201">Sudan</option>
                        <option value="202">Suriname</option>
                        <option value="203">Svalbard and Jan Mayen</option>
                        <option value="204">Swaziland</option>
                        <option value="205">Sweden</option>
                        <option value="206">Switzerland</option>
                        <option value="207">Syrian Arab Republic</option>
                        <option value="208">Taiwan, Province of China</option>
                        <option value="209">Tajikistan</option>
                        <option value="210">Tanzania, United Republic of</option>
                        <option value="211">Thailand</option>
                        <option value="213">Togo</option>
                        <option value="214">Tokelau</option>
                        <option value="215">Tonga</option>
                        <option value="216">Trinidad and Tobago</option>
                        <option value="217">Tunisia</option>
                        <option value="218">Turkey</option>
                        <option value="219">Turkmenistan</option>
                        <option value="220">Turks and Caicos Islands</option>
                        <option value="221">Tuvalu</option>
                        <option value="222">Uganda</option>
                        <option value="223">Ukraine</option>
                        <option value="224">United Arab Emirates</option>
                        <option value="225">United Kingdom</option>
                        <option value="226">United States</option>
                        <option value="228">Uruguay</option>
                        <option value="229">Uzbekistan</option>
                        <option value="230">Vanuatu</option>
                        <option value="231">Venezuela</option>
                        <option value="232">VietNam</option>
                        <option value="233">Virgin Islands, British</option>
                        <option value="234">Virgin Islands, U.s.</option>
                        <option value="235">Wallis and Futuna</option>
                        <option value="236">Western Sahara</option>
                        <option value="237">Yemen</option>
                        <option value="238">Zambia</option>
                        <option value="239">Zimbabwe</option>
                    </select>
                    </div>
                    <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="City *" required>
                    </div>
                    <!-- Pincode & Present School -->
                    <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Pincode *" required>
                    </div>
                    <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Name of Present school *" required>
                    </div>
                    <!-- Present Grade & Grade to join -->
                    <div class="col-md-6">
                    <select class="form-select" required>
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
                    <select class="form-select" required>
                        <option value="" selected disabled>Grade to join *</option>
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
                    </select>
                    </div>
                    <!-- Academic Year & Nationality -->
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Seeking Admission for Academic Year</option>
                        <option value="2025 - 2026">2025 - 2026</option>
                        <option value="2026 - 2027">2026 - 2027</option>
                    </select>
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
                </div>
                </div>
                <div class="apply-for-admission-parent-details-sec">
                <h4 class="afas-details-title">Parent/Guardian Details</h4>
                <div class="row">
                    <div class="col-md-6">
                    <div class="father-details-sec">
                        <div class="row g-3">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Father's/Guardian Name *" required>
                        </div>
                        <div class="col-md-12">
                            <input id="fatherMobile" type="tel" class="form-control" placeholder="Father's Mobile No *"
                            required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Father's Occupation *" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Father's Designation *" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Father's Organisation *" required>
                        </div>
                        <div class="col-md-12">
                            <input type="email" class="form-control" placeholder="Father's Email *" required>
                        </div>
                        <div class="col-md-12">
                            <input id="fatherResidence" type="tel" class="form-control"
                            placeholder="Father's Residence/Office No *" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Father's Office Address *" required>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mother-details-sec">
                        <div class="row g-3">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Mother's/Guardian Name *" required>
                        </div>
                        <div class="col-md-12">
                            <input id="motherMobile" type="tel" class="form-control" placeholder="Mother's Mobile No *"
                            required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Mother's Occupation *" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Mother's Designation *" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Mother's Organisation *" required>
                        </div>
                        <div class="col-md-12">
                            <input type="email" class="form-control" placeholder="Mother's Email *" required>
                        </div>
                        <div class="col-md-12">
                            <input id="motherResidence" type="tel" class="form-control"
                            placeholder="Mother's Residence/Office No *" required>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Mother's Office Address *" required>
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
                    <select class="form-select" required>
                        <option value="" selected disabled>Student's Passport Type *</option>
                        <option value="1">Indian Passport</option>
                        <option value="2">Foreign Passport</option>
                    </select>
                    </div>
                    <div class="col-md-6">
                    <select class="form-select" required>
                        <option value="" selected disabled>Foreign Passport Type *</option>
                        <option value="1">OCI (Overseas Citizenship of India)</option>
                        <option value="2">PIO (Person of Indian Origin)</option>
                        <option value="3">Not Applicable</option>
                    </select>
                    </div>
                    <div class="col-md-12">
                    <input type="text" class="form-control" placeholder="How did you hear about our School? *" required>
                    </div>
                    <div class="col-md-12">
                    <textarea class="form-control" rows="3" placeholder="What do you wish to know?"></textarea>
                    </div>
                    <div class="col-md-12">
                    <img src="{{ asset('frontend/assets/img/logo/cc-avenue.webp') }}" alt="CC Avenue" class="img-fluid">
                    </div>
                    <div class="col-md-12 apply-other-info-btn">
                    <button type="submit" class="btn">Submit as Enquiry</button>
                    </div>
                </div>
                </div>



            </div>
        </section>

    </main>


    @include('components.frontend.footer')

    @include('components.frontend.main-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>

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
    </script>


</body>
</html>