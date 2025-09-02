<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Campaign;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample campaigns
        $campaigns = [
            [
                'campaign_id' => 'CAM-20250902-3001',
                'name' => 'Summer Product Launch',
                'status' => 'active',
                'days' => 30,
                'start_date' => '2025-06-01 09:00:00',
                'end_date' => '2025-06-30 18:00:00',
                'customer_id' => 1,
                'organizer_id' => 1,
                'notes' => 'Major product launch campaign for summer season',
            ],
            [
                'campaign_id' => 'CAM-20250902-3002',
                'name' => 'Holiday Marketing Blitz',
                'status' => 'pending',
                'days' => 45,
                'start_date' => '2025-12-01 10:00:00',
                'end_date' => '2025-12-31 20:00:00',
                'customer_id' => 2,
                'organizer_id' => 2,
                'notes' => 'Holiday season marketing campaign',
            ],
            [
                'campaign_id' => 'CAM-20250902-3003',
                'name' => 'Brand Awareness Campaign',
                'status' => 'completed',
                'days' => 60,
                'start_date' => '2025-03-01 08:00:00',
                'end_date' => '2025-04-30 17:00:00',
                'customer_id' => 3,
                'organizer_id' => 3,
                'notes' => 'Successfully completed brand awareness campaign',
            ],
            [
                'campaign_id' => 'CAM-20250902-3004',
                'name' => 'Digital Marketing Push',
                'status' => 'active',
                'days' => 25,
                'start_date' => '2025-08-15 09:00:00',
                'end_date' => '2025-09-10 18:00:00',
                'customer_id' => 4,
                'organizer_id' => 4,
                'notes' => 'Digital marketing campaign for online presence',
            ],
            [
                'campaign_id' => 'CAM-20250902-3005',
                'name' => 'Customer Retention Program',
                'status' => 'inactive',
                'days' => 40,
                'start_date' => '2025-02-01 10:00:00',
                'end_date' => '2025-03-15 19:00:00',
                'customer_id' => 5,
                'organizer_id' => 5,
                'notes' => 'Customer retention campaign (currently inactive)',
            ],
            [
                'campaign_id' => 'CAM-20250902-3006',
                'name' => 'Social Media Campaign',
                'status' => 'active',
                'days' => 20,
                'start_date' => '2025-07-01 08:00:00',
                'end_date' => '2025-07-21 17:00:00',
                'customer_id' => 1,
                'organizer_id' => 2,
                'notes' => 'Social media focused campaign',
            ],
            [
                'campaign_id' => 'CAM-20250902-3007',
                'name' => 'Product Demo Series',
                'status' => 'pending',
                'days' => 35,
                'start_date' => '2025-10-01 09:00:00',
                'end_date' => '2025-11-05 18:00:00',
                'customer_id' => 2,
                'organizer_id' => 3,
                'notes' => 'Product demonstration series campaign',
            ],
            [
                'campaign_id' => 'CAM-20250902-3008',
                'name' => 'Trade Show Promotion',
                'status' => 'completed',
                'days' => 15,
                'start_date' => '2025-05-01 08:00:00',
                'end_date' => '2025-05-16 17:00:00',
                'customer_id' => 3,
                'organizer_id' => 4,
                'notes' => 'Trade show promotion campaign completed successfully',
            ],
        ];

        foreach ($campaigns as $campaignData) {
            Campaign::firstOrCreate(
                ['campaign_id' => $campaignData['campaign_id']],
                $campaignData
            );
        }
    }
}
