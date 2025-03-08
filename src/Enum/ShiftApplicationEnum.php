<?php

namespace App\Enum;

enum ShiftStatusEnum: string {
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';
}