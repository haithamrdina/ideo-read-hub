<?php

namespace App\Console\Commands;

use App\Jobs\YouscribeCategoryProduct;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CategoryProductCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:category-product-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $start_datetime = date('Y-m-d H:i:s');
        Log::info("[$start_datetime]: Update category products process has started.");
        YouscribeCategoryProduct::dispatch();
        $end_datetime = date('Y-m-d H:i:s');
        Log::info("[$end_datetime]: Update category products process has finished.");
    }
}
