<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use App\Jobs\SendLowStockNotification;


class StockCheckCommand extends Command
{
  
    protected $signature = 'stock:check';

    protected $description = 'Check product';

   
    public function handle()
    {
        $products = Product::where('stock', '<' ,5)
        ->where('stock', '>' ,0)
        ->get();

        if($products->isEmpty()){
            $this->info('No low stock products found. ');

            return Command::SUCCESS;
        }
       

        foreach ($products as $product) {

           $this->warn(
             $product->name . '- stock: ' . $product->stock
           );

           SendLowStockNotification::dispatch($product->id);
        }

            $this->info('Low stock check complated. ');
            
            return command::SUCCESS;

    }
}
