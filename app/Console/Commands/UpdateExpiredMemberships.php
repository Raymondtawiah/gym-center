<?php

namespace App\Console\Commands;

use App\Models\ClassBooking;
use Illuminate\Console\Command;
use Carbon\Carbon;

class UpdateExpiredMemberships extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'memberships:update-expired 
                            {--dry-run : Run without making any changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update membership statuses to expired when end_date has passed';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Starting membership expiry update...');
        
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->warn('Running in dry-run mode - no changes will be made.');
        }

        // Find memberships that should be marked as expired
        $expiredBookings = ClassBooking::query()
            ->where('status', 'confirmed')
            ->whereNotNull('end_date')
            ->where('end_date', '<', Carbon::now())
            ->get();

        $count = $expiredBookings->count();

        if ($count === 0) {
            $this->info('No memberships need to be expired.');
            return Command::SUCCESS;
        }

        $this->info("Found {$count} memberships to expire.");

        if (!$dryRun) {
            foreach ($expiredBookings as $booking) {
                $booking->update(['status' => 'expired']);
                
                $this->line("Marked membership #{$booking->id} as expired for user #{$booking->user_id}");
            }
            
            $this->info("Successfully expired {$count} memberships.");
        } else {
            $this->warn("Would have expired {$count} memberships.");
        }

        return Command::SUCCESS;
    }
}
