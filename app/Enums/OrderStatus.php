<?php

namespace App\Enums;

enum OrderStatus: string
{
    case CREATED = 'Created';
    case PENDING = 'Pending';
    case SHIPPED = 'Shipped';
    case DELIVERED = 'Delivered';
    case CANCELLED = 'Cancelled';
}
