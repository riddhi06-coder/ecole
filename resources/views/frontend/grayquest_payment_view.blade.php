<!DOCTYPE html>
<html lang="en">
@include('components.frontend.head')

<style>
    body {
        background: #f4f6f9;
        font-family: 'Segoe UI', sans-serif;
    }

    .payment-wrapper {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .payment-card {
        background: #ffffff;
        max-width: 420px;
        width: 100%;
        padding: 30px;
        border-radius: 14px;
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
        text-align: center;
    }

    .payment-card h2 {
        font-size: 22px;
        margin-bottom: 10px;
        color: #1f2937;
    }

    .payment-card p {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 20px;
    }

    .amount-box {
        background: #f1f5f9;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 25px;
        font-size: 18px;
        font-weight: 600;
        color: #0f172a;
    }

    #payNow {
        width: 100%;
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 14px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    #payNow:hover {
        background: #1d4ed8;
    }

    .secure-note {
        margin-top: 15px;
        font-size: 12px;
        color: #64748b;
    }
</style>

<body>

@include('components.frontend.header')

<div class="payment-wrapper">
    <div class="payment-card">

        <h2>Fee Payment</h2>
        <p>
            By clicking <strong>Pay Now</strong>, you’ll be redirected to the <strong>GrayQuest payment portal</strong>,
            an RBI-compliant platform used by leading educational institutions.
        </p>


        <div class="amount-box">
            ₹ {{ number_format($student->amount, 2) }}
        </div>

        <button id="payNow">Pay Now</button>

        <div class="secure-note">
            🔒 100% secure payment • Powered by GrayQuest
        </div>

    </div>
</div>

@include('components.frontend.footer')
@include('components.frontend.main-js')

<!-- Scripts stay exactly as you already have them -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--- Testing URl---->
<!--<script src="https://erp-sdk-stage.graydev.tech/v1.1/gqerp-sdk.min.js?v=latest"></script>-->

<!--- Prod URl---->
<script src="https://erp-sdk.grayquest.com/v1.1/gqerp-sdk.min.js?v=latest"></script>

<script>
window.GrayQuestConfig = {
    client_id: "{{ config('services.grayquest.client_id') }}",
    client_secret: "{{ config('services.grayquest.client_secret') }}",
    api_key: "{{ config('services.grayquest.api_key') }}",
    // base_url: "https://cust-api-stage.graydev.tech/v1"
    base_url: "https://cust-api.grayquest.com/v1"
};
</script>

<script>
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" }
});
</script>

<script>
const gqStudentId      = "{{ $student->gq_student_id }}";
const gqApplicationId = "{{ $student->gq_application_id }}";
const gqReferenceId   = "{{ $student->gq_reference_id }}";
const mobile          = "{{ $student->father_mobile }}";
const amount          = "{{ $student->amount }}";
const firstName = "{{ $firstName }}";
const lastName  = "{{ $lastName }}";
const grade = "{{ $student->grade }}";

</script>

<script>
document.getElementById('payNow').onclick = function () {

    if (typeof window.GqErpSDK === 'undefined') {
        alert('Payment service is still loading. Please try again.');
        return;
    }

    window.GqErpSDK.setOptions({
        // env: "staging",
        env: "production",
        api_base: window.GrayQuestConfig.base_url,
        auth: {
            client_id: window.GrayQuestConfig.client_id,
            client_secret: window.GrayQuestConfig.client_secret,
            api_key: window.GrayQuestConfig.api_key
        },
        
        // pp_config: { slug: "ems-juhu" },
        pp_config: { slug: "emws-juhu" },
        student_id: gqStudentId,
        application_id: gqApplicationId,
        reference_id: gqReferenceId,
        
      
        student_first_name: firstName,
        student_last_name: lastName,
        customer_mobile: mobile,

        student_class: grade,
    
        fee_headers: {
            total_payable: amount
        },

        notes: {
            erp_name: "Ecole Mondiale World School",
            academic_year: "2025-2026",
            platform: "ERP Portal",
            src: "WEB"
        }
    });

    window.GqErpSDK.render();
};
</script>

</body>
</html>
