<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $table = 'contact_requests';
    protected $primaryKey = 'request_id';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status'
    ];
    
    public $timestamps = false;
    // Status constants
    const STATUS_NEW = 'new';
    const STATUS_PROCESSING = 'processing';
    const STATUS_COMPLETED = 'completed';
    // Get status label for display
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                return '<span class="badge badge-info">Mới</span>';
            case self::STATUS_PROCESSING:
                return '<span class="badge badge-warning">Đang xử lý</span>';
            case self::STATUS_COMPLETED:
                return '<span class="badge badge-success">Đã xử lý</span>';
            default:
                return '<span class="badge badge-secondary">Không xác định</span>';
        }
    }
} 