@extends('admin.layout')

@section('content')
<style>
    @media (min-width: 992px) {
        .dash-low-stock-count, .dash-low-stock-item, .dash-table-td, .dash-table-th, .dash-badge, .dash-product-stock, .dash-product-name, .dash-chart-scale-numbers span {
            font-size: 17px !important;
        }
    }
</style>

<div class="container-fluid">

 <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">

    <h2 class="m-0 fs-3">
        Welcome Admin
    </h2>

    <input
        type="date"
        class="form-control dash-date-input"
        value="{{ now()->format('Y-m-d') }}"
        max="{{ now()->format('Y-m-d') }}" style="max-width: 200px;">
</div>

<div class="row g-3 mb-4">

    <!-- Card 1: Total Products -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-2">
        <div class="card dash-stat-card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <div class="dash-stat-label">Total Products</div>
                <div class="dash-stat-value">{{ $products }}</div>
                <div class="dash-stat-trend">&#8593; 12% vs last month</div>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Orders -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-2">
        <div class="card dash-stat-card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <div class="dash-stat-label">Total Orders</div>
                <div class="dash-stat-value">{{ $orders }}</div>
                <div class="dash-stat-trend">&#8593; 8%</div>
            </div>
        </div>
    </div>

    <!-- Card 3: Total Users -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-2">
        <div class="card dash-stat-card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <div class="dash-stat-label">Total Users</div>
                <div class="dash-stat-value">{{ $users }}</div>
                <div class="dash-stat-trend">&#8593; 5%</div>
            </div>
        </div>
    </div>

    <!-- Card 4: Total Revenue -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-2">
        <div class="card dash-stat-card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <div class="dash-stat-label">Total Revenue</div>
                <div class="dash-stat-value">&#8377;{{ number_format($totalRevenue) }}</div>
                <div class="dash-stat-trend">&#8593; 18%</div>
            </div>
        </div>
    </div>

    <!-- Card 5: Today's Orders -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-2">
        <div class="card dash-stat-card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <div class="dash-stat-label">Today's Orders</div>
                <div class="dash-stat-value">{{ $todayOrders }}</div>
                <div class="dash-stat-trend">&#8593; 150%</div>
            </div>
        </div>
    </div>

    <!-- Card 6: Low Stock -->
    <div class="col-12 col-sm-6 col-md-4 col-xl-2">
        <div class="card dash-stat-card shadow-sm border-0 h-100">
            <div class="card-body p-3">
                <div class="dash-stat-label">Low Stock</div>
                <div class="dash-stat-value">{{ $lowStockItems }}</div>
                <div class="dash-stat-trend dash-stat-trend-down">&#8595; 5%</div>
            </div>
        </div>
    </div>

</div>
  


<div class="row g-4">

    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header fw-bold text-uppercase bg-white text-dark dash-card-header fs-4">
                Orders Overview
            </div>
            <div class="card-body p-3">
                <canvas id="ordersChart" class="dash-chart-canvas"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header fw-bold text-uppercase bg-white text-dark dash-card-header fs-4">
                Sales Overview
            </div>
            <div class="card-body p-3">
                <canvas id="salesChart" class="dash-chart-canvas"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header fw-bold text-uppercase bg-white text-dark dash-card-header fs-4">
                Revenue Overview
            </div>
            <div class="card-body p-3">
                <canvas id="revenueChart" class="dash-chart-canvas"></canvas>
            </div>
        </div>
    </div>

</div>
 
    <div class="row g-4 mt-4">

        <div class="col-lg-8">
            <div class="card shadow border-0">
                <div class="card-header fw-bold text-uppercase bg-white text-dark dash-card-header fs-4">
                    Recent Orders
                </div>

                <div class="card-body p-0">

                    <div class="table-responsive"><table class="table table-hover mb-0">

                        <thead>
                        <tr>
                            <th class="dash-table-th">ID</th>
                            <th class="dash-table-th">CUSTOMER</th>
                            <th class="dash-table-th">TOTAL</th>
                            <th class="dash-table-th">STATUS</th>
                        </tr>
                        </thead>

                        <tbody>

                        @forelse($recentOrders as $order)

                            <tr>
                                <td class="dash-table-td">#{{ $order->id }}</td>
                                <td class="dash-table-td">{{ $order->name }}</td>
                                <td class="dash-table-td">&#8377;{{ number_format($order->total_amount ?? $order->total_price, 2) }}</td>

                                <td class="dash-table-td-status">
                                    @if($order->status === \App\Enums\OrderStatus::DELIVERED)
                                        <span class="badge5 dash-badge">
                                            DELIVERED
                                        </span>

                                    @elseif($order->status === \App\Enums\OrderStatus::CANCELLED)
                                        <span class="badge5 dash-badge">
                                            CANCELLED
                                        </span>

                                    @else
                                        <span class="badge5 dash-badge">
                                            {{ strtoupper($order->status->value) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center">
                                    No Orders Found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table></div>

                </div>
            </div>
        </div>

     
        <div class="col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header fw-bold text-uppercase bg-white text-dark dash-card-header fs-4">
                    Top Products
                </div>

                <div class="card-body p-4">

                    @forelse($topProducts as $product)
                        <div class="d-flex align-items-center mb-3">
                            <div class="dash-product-name text-truncate pe-2" style="max-width: 40%; flex: 1;">{{ $product->name }}</div>
                            <div class="dash-product-bar-container flex-grow-1">
                                <div class="dash-product-bar admin-extracted-style-7"></div>
                            </div>
                            <div class="dash-product-stock ps-2">{{ $product->stock }}</div>
                        </div>
                    @empty
                        <p>No Products Found</p>
                    @endforelse

                    <div class="d-flex justify-content-end mt-4 pt-2 border-top dash-stat-label">
                        <div class="d-flex justify-content-between dash-chart-scale-numbers flex-grow-1" style="max-width: 60%;">
                            <span>0</span>
                            <span>5</span>
                            <span>10</span>
                            <span>15</span>
                            <span>20</span>
                            <span>25</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

  
    <div class="row g-4 mt-4 mb-4">

        <div class="col-lg-8">
            <div class="card shadow border-0 h-100">
                <div class="card-header fw-bold text-uppercase bg-white text-dark dash-card-header fs-4">
                    Low Stock Alert
                </div>

                <div class="card-body card-body p-3">
                    @forelse($lowStockProducts as $item)
                        <div class="d-flex justify-content-between border-bottom py-2 dash-low-stock-item">
                            <span>{{ $item->name }}</span>
                            <span class="fw-bold dash-low-stock-count">
                                Stock : {{ $item->stock }}
                            </span>
                        </div>
                    @empty
                        <p class="py-2">No Low Stock Products</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow border-0 h-100">
                <div class="card-header fw-bold text-uppercase bg-white text-dark dash-card-header fs-4">
                    Quick Actions
                </div>

                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('admin.product.create') }}" class="btn5 m-0 dash-btn-outline w-100 d-block text-center text-truncate">
                                <i class="fas fa-plus mb-1 d-block"></i> Add Product
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('admin.orders') }}" class="btnm m-0 dash-btn-solid w-100 d-block text-center text-truncate">
                                <i class="fas fa-shopping-cart mb-1 d-block"></i> View Orders
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('admin.users') }}" class="btn5 m-0 dash-btn-outline w-100 d-block text-center text-truncate">
                                <i class="fas fa-users mb-1 d-block"></i> Users
                            </a>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('admin.products') }}" class="btn5 m-0 dash-btn-outline w-100 d-block text-center text-truncate">
                                <i class="fas fa-box mb-1 d-block"></i> Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
Chart.defaults.font.size = 17;
Chart.defaults.font.family = "'Inter', sans-serif";

document.addEventListener("DOMContentLoaded", function () {
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#000',
                    usePointStyle: true,
                    boxWidth: 8,
                    font: {
                        size: 17,
                        family: "'Inter', sans-serif"
                    }
                }
            }
        },
        scales: {
            x: {
                grid: {
                    display: false,
                    drawBorder: true,
                    borderColor: '#c06b1f'
                },
                ticks: {
                    color: '#000',
                    font: { size: 17, family: "'Inter', sans-serif" }
                }
            },
            y: {
                grid: {
                    color: '#f0f0f0',
                    drawBorder: true,
                    borderColor: '#c06b1f'
                },
                ticks: {
                    color: '#000',
                    font: { size: 17, family: "'Inter', sans-serif" }
                }
            }
        }
    };

    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: '    Orders',
                data: [8, 12, 10, 15, 22, 17, 9],
                borderColor: '#c06b1f',
                backgroundColor: '#c06b1f',
                borderWidth: 2,
                pointBackgroundColor: '#c06b1f',
                pointRadius: 4,
                tension: 0.1
            }]
        },
        options: {
            ...commonOptions,
            scales: {
                ...commonOptions.scales,
                y: {
                    ...commonOptions.scales.y,
                    min: 0,
                    max: 25,
                    ticks: {
                        stepSize: 5,
                        color: '#000'
                    }
                }
            }
        }
    });

    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: '    Sales (₹)',
                data: [60000, 80000, 100000, 130000, 210000, 160000, 90000],
                backgroundColor: '#c06b1f',
                barThickness: 20
            }]
        },
        options: {
            ...commonOptions,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#000',
                        usePointStyle: true,
                        boxWidth: 8,
                        font: { size: 17, family: "'Inter', sans-serif" }
                    }
                }
            },
            scales: {
                ...commonOptions.scales,
                y: {
                    ...commonOptions.scales.y,
                    min: 0,
                    max: 250000,
                    ticks: {
                        stepSize: 50000,
                        callback: function(value) {
                            return value === 0 ? '0' : (value / 1000) + 'K';
                        },
                        color: '#000'
                    }
                }
            }
        }
    });

    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: '    Revenue (₹)',
                data: [70000, 90000, 100000, 140000, 200000, 160000, 90000],
                borderColor: '#c06b1f',
                backgroundColor: '#c06b1f',
                borderWidth: 2,
                pointBackgroundColor: '#c06b1f',
                pointRadius: 4,
                tension: 0.1
            }]
        },
        options: {
            ...commonOptions,
            scales: {
                ...commonOptions.scales,
                y: {
                    ...commonOptions.scales.y,
                    min: 0,
                    max: 250000,
                    ticks: {
                        stepSize: 50000,
                        callback: function(value) {
                            return value === 0 ? '0' : (value / 1000) + 'K';
                        },
                        color: '#000'
                    }
                }
            }
        }
    });
});
</script>
@endsection
