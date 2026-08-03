<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderConfirmationMail extends Mailable
{
    use SerializesModels;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        if ($this->order->exists && !$this->order->relationLoaded('items')) {
            $this->order->load(['items.product', 'legacyProduct', 'user']);
        }

        $invoiceNumber = 'INV-' . str_pad($this->order->id, 4, '0', STR_PAD_LEFT);

        $pdf = Pdf::loadView('pdf.invoice', [
            'order' => $this->order,
            'invoiceNumber' => $invoiceNumber
        ]);

        return $this->subject('Order Confirmation - Invoice #' . $invoiceNumber)
                    ->view('emails.order-confirmation')
                    ->attachData($pdf->output(), $invoiceNumber . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}

