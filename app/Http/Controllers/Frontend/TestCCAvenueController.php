<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class TestCCAvenueController extends Controller
{
    public function test()
    {
        // ⚙️ Live credentials from .env
        $merchant_id = env('CCAV_MERCHANT_ID');
        $access_code = env('CCAV_ACCESS_CODE');
        $working_key = env('CCAV_WORKING_KEY');

        // 🧾 Payment parameters (static test order)
        $parameters = [
            'merchant_id'    => $merchant_id,
            'order_id'       => 'ORD' . rand(1000,9999), // unique order
            'currency'       => 'INR',
            'amount'         => '100.00',
            'redirect_url'   => 'https://www.ecolemondiale.org/ccavenue/response',
            'cancel_url'     => 'https://www.ecolemondiale.org/ccavenue/cancel',
            'language'       => 'EN',
            'billing_name'   => 'John Doe',
            'billing_address'=> '123 Test Street',
            'billing_city'   => 'Mumbai',
            'billing_state'  => 'Maharashtra',
            'billing_zip'    => '400001',
            'billing_country'=> 'India',
            'billing_tel'    => '9999999999',
            'billing_email'  => 'test@example.com'
        ];

        // Convert to query string
        $merchant_data = http_build_query($parameters);

        // Encrypt
        $encryptedData = $this->encryptCCAvenueData($merchant_data, $working_key);

        return view('frontend.test-ccavenue', compact('encryptedData', 'access_code'));
    }

    // AES-128-CBC encryption
    private function encryptCCAvenueData($plainText, $workingKey)
    {
        $key = pack('H*', $workingKey);
        $iv  = pack('H*', '00000000000000000000000000000000');
        $encrypted = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $iv);
        return bin2hex($encrypted);
    }
}
