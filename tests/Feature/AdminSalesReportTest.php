<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSalesReportTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->user = User::factory()->create([
            'role' => 'user',
        ]);
    }

    public function test_admin_can_view_sales_report_page()
    {
        $response = $this->actingAs($this->admin)->get(route('admin.sales-report'));

        $response->assertStatus(200);
        $response->assertSee('Sales Report Filters');
        $response->assertSee('Export CSV');
    }

    public function test_non_admin_cannot_access_sales_report_csv_export()
    {
        $response = $this->actingAs($this->user)->get(route('admin.sales-report.export'));

        $response->assertRedirect('/');
    }

    public function test_admin_can_export_sales_report_to_csv()
    {
        $customer = User::factory()->create([
            'name' => 'Jane ExportUser',
            'email' => 'jane.export@example.com',
        ]);

        $order = Order::create([
            'user_id' => $customer->id,
            'name' => 'Jane ExportUser',
            'phone' => '9988776655',
            'total_amount' => 2499.50,
            'payment_method' => 'Razorpay',
            'status' => 'Delivered',
            'payment_status' => 'paid',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.sales-report.export'));

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/csv; charset=UTF-8');

        $disposition = $response->headers->get('content-disposition');
        $this->assertStringContainsString('attachment; filename=sales-report-', $disposition);
        $this->assertStringContainsString('.csv', $disposition);

        $content = $response->streamedContent();

        // Verify UTF-8 BOM
        $this->assertStringStartsWith("\xEF\xBB\xBF", $content);

        // Verify CSV header columns
        $this->assertStringContainsString('Order ID', $content);
        $this->assertStringContainsString('Customer Name', $content);
        $this->assertStringContainsString('Customer Email', $content);
        $this->assertStringContainsString('Order Date', $content);
        $this->assertStringContainsString('Total Amount', $content);
        $this->assertStringContainsString('Payment Method', $content);
        $this->assertStringContainsString('Payment Status', $content);
        $this->assertStringContainsString('Order Status', $content);

        // Verify order data values in CSV
        $this->assertStringContainsString($order->id, $content);
        $this->assertStringContainsString('Jane ExportUser', $content);
        $this->assertStringContainsString('jane.export@example.com', $content);
        $this->assertStringContainsString('2499.50', $content);
        $this->assertStringContainsString('Razorpay', $content);
    }

    public function test_csv_export_respects_date_range_filters()
    {
        $customer = User::factory()->create([
            'email' => 'datefilter@example.com',
        ]);

        // Order 1: Created today (Inside date range)
        $todayOrder = Order::create([
            'user_id' => $customer->id,
            'name' => 'Today Customer',
            'phone' => '1111111111',
            'total_amount' => 1500.00,
            'payment_method' => 'COD',
            'status' => 'Pending',
            'payment_status' => 'pending',
            'created_at' => now(),
        ]);

        // Order 2: Created 10 days ago (Outside filtered range)
        $pastOrder = Order::create([
            'user_id' => $customer->id,
            'name' => 'Past Customer',
            'phone' => '2222222222',
            'total_amount' => 3000.00,
            'payment_method' => 'COD',
            'status' => 'Pending',
            'payment_status' => 'pending',
        ]);
        $pastOrder->timestamps = false;
        $pastOrder->created_at = now()->subDays(10);
        $pastOrder->save();

        $startDate = now()->startOfDay()->format('Y-m-d');
        $endDate = now()->endOfDay()->format('Y-m-d');

        $response = $this->actingAs($this->admin)->get(route('admin.sales-report.export', [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]));

        $response->assertStatus(200);

        $content = $response->streamedContent();

        $this->assertStringContainsString('Today Customer', $content);
        $this->assertStringNotContainsString('Past Customer', $content);
    }
}
