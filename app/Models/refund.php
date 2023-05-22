<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Mail\ContactMail;
  
class Refund extends Model
{
    use HasFactory;
  
    public $fillable = ['Firstname', 'Lastname', 'email', 'shipment_id'];
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public static function boot() {
  
        parent::boot();
  
        static::created(function ($item) {
                
            $adminEmail = "cptn989@gmail.com";
            Mail::to($adminEmail)->send(new ContactMail($item));
        });
    }
}