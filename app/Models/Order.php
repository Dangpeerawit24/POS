<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders'; // ระบุชื่อตาราง

    // ระบุฟิลด์ที่อนุญาตให้ใช้ Mass Assignment
    protected $fillable = [
        'order_number',       // เพิ่มฟิลด์นี้
        'total_amount',
        'payment_method',
        'proof_image',
        'received_amount',
        'change',
        'user_id',
    ];

    /**
     * ความสัมพันธ์ระหว่าง Order และ OrderItem (1:N)
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    
    /**
     * Getter สำหรับรูปแบบการแสดงผลวันที่สร้างคำสั่งซื้อ
     * 
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d/m/Y H:i');
    }

    /**
     * Getter สำหรับยอดรวมในรูปแบบที่แสดงตัวเลขเป็นสกุลเงิน
     *
     * @return string
     */
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total_amount, 2) . ' ฿';
    }

    /**
     * Getter สำหรับวิธีการชำระเงินในรูปแบบที่อ่านง่าย
     * 
     * @return string
     */
    public function getPaymentMethodLabelAttribute()
    {
        return $this->payment_method === 'cash' ? 'เงินสด' : 'ออนไลน์';
    }
}
