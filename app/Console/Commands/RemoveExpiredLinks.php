<?php

namespace App\Console\Commands;

use App\Models\Url;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:remove-expired-links')]
#[Description('Command description')]
class RemoveExpiredLinks extends Command
{
    protected $signature = 'app:remove-expired-links';

    protected $description = 'Removes Expired Links From Database';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start: Removing Expired Links...');

        $old_urls = Url::whereBetween('created_at', [now()->subDay(), now()]);

        $this->info("INFO: {$old_urls->count()} Urls Found...");

        $old_urls->each(fn($url) => $url->delete());

        $this->info('End: Removing Expired Links...');
    }
}
