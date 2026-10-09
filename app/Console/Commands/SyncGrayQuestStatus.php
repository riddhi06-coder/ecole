<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\GrayquestPaymentDetails;
use Illuminate\Support\Facades\Log;

class SyncGrayQuestStatus extends Command
{
    protected $signature = 'grayquest:sync-status';
    protected $description = 'Fetch GrayQuest EMI status for all applications and update DB efficiently';

    public function handle()
    {
        // Log::info('🟢 GrayQuest status sync started');

        try {
            $client = new Client([
                'base_uri' => rtrim(config('services.grayquest.base_url'), '/'),
                'timeout'  => 30,
            ]);

            // Fetch all applications that have a GrayQuest application ID
            $applications = GrayquestPaymentDetails::whereNotNull('gq_application_id')->get();
            Log::info('ℹ️ Applications fetched for status check', ['count' => $applications->count()]);

            if ($applications->isEmpty()) {
                Log::info('ℹ️ No applications to sync.');
                return;
            }

            foreach ($applications as $app) {
                Log::info('🔹 Processing application', [
                    'application_id' => $app->gq_application_id,
                    'student_id'     => $app->gq_student_id,
                    'reference_id'   => $app->gq_reference_id,
                    'current_status' => $app->gq_emi_status,
                ]);

                try {
                    $response = $client->get('/v1/applications/check-status', [
                        'query' => [
                            'application_id' => $app->gq_application_id,
                            'student_id'     => $app->gq_student_id,
                            'reference_id'   => $app->gq_reference_id,
                        ],
                        'headers' => [
                            'Authorization' => 'Basic ' . base64_encode(
                                config('services.grayquest.client_id') . ':' .
                                config('services.grayquest.client_secret')
                            ),
                            'GQ-API-Key' => config('services.grayquest.api_key'),
                        ],
                    ]);

                    // Log::info('📡 API response received', ['application_id' => $app->gq_application_id]);

                    $data = json_decode($response->getBody(), true);
                    Log::info('📝 Decoded API response', ['application_id' => $app->gq_application_id, 'response' => $data]);

                    // Use stage_slug from API
                    $statusSlug = $data['data'][0]['stage_slug'] ?? null;

                    if (!$statusSlug) {
                        Log::warning('⚠️ stage_slug missing in API response', ['application_id' => $app->gq_application_id]);
                        continue;
                    }

                    // Update only if status has changed
                    if ($statusSlug !== $app->gq_emi_status) {
                        Log::info('💾 Status changed, updating DB', [
                            'application_id' => $app->gq_application_id,
                            'old_status' => $app->gq_emi_status,
                            'new_status' => $statusSlug,
                        ]);

                        $updated = $app->update([
                            'gq_emi_status'   => $statusSlug,
                            'gq_last_event'   => $statusSlug,
                            'gq_webhook_data' => json_encode($data),
                            'gq_disbursed_at' => $statusSlug === 'loan-live' ? now() : $app->gq_disbursed_at,
                        ]);

                        if ($updated) {
                            Log::info('✅ DB updated successfully', [
                                'application_id' => $app->gq_application_id,
                                'status' => $statusSlug,
                            ]);
                        } else {
                            Log::warning('⚠️ DB update failed', ['application_id' => $app->gq_application_id]);
                        }
                    } else {
                        Log::info('ℹ️ Status unchanged, skipping DB update', [
                            'application_id' => $app->gq_application_id,
                            'status' => $statusSlug,
                        ]);
                    }

                } catch (\Exception $e) {
                    Log::error('❌ API call failed for application', [
                        'application_id' => $app->gq_application_id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                    ]);
                }
            }

            Log::info('🟢 GrayQuest status sync completed');

        } catch (\Exception $e) {
            Log::error('❌ GrayQuest cron failed entirely', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
