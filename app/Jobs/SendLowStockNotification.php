<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendLowStockNotification implements ShouldQueue
{
    use Queueable;

    public $productId;

    public function __construct($productId)
    {
        $this->productId = $productId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $product = Product::find($this->productId);

        if($product){
            echo "Low stock notification for: ". $product->name . "\n";
        }
    }
}
