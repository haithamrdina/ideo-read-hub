<?php

namespace App\Jobs;

use App\Http\Integrations\Youscribe\Requests\YouscribeCategoryProducts;
use App\Http\Integrations\Youscribe\YouscribeConnector;
use App\Models\Catalogue;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class YouscribeCategoryProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $youscribeConnector = new YouscribeConnector('https://services.youscribe.com/api');
        $categories = Catalogue::whereNull("parent_id")->get();
        $start_datetime = date('Y-m-d H:i:s');
        Log::info("['start'][$start_datetime]: Categories products job has started.");
        foreach ($categories as $categorie) {
            $start_datetime = date('Y-m-d H:i:s');
            Log::info("['start'][$start_datetime]: Categorie " . $categorie->label . " : products job has started.");
            $paginator = $youscribeConnector->paginate(new YouscribeCategoryProducts($categorie->id_youscribe));
            foreach ($paginator as $response) {
                $products = $response->dto();
                DB::transaction(function () use ($products) {
                    Product::upsert(
                        $products,
                        ['productId'],
                        [
                            'ownerId',
                            'title',
                            'description',
                            'thumbnailUrl',
                            'onlineDate',
                            'publishDate',
                            'estimatedReadTime',
                            'nbPages',
                            'authors',
                            'ownerUsername',
                            'ownerDisplayableUserName',
                            'language',
                            'link',
                            'category_id',
                            'theme_id',
                            'tag_id',
                        ]
                    );
                });
            }
            $end_datetime = date('Y-m-d H:i:s');
            Log::info("['end'][$end_datetime]: Categorie " . $categorie->label . " : products job has finished.");
        }
        $end_datetime = date('Y-m-d H:i:s');
        Log::info("['end'][$end_datetime]: Categories products job has finished.");
    }
}
