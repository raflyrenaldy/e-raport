<?php


namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//use App\Traits\NasabahTrait;
use Illuminate\Support\Facades\Auth;

class Classes extends Model
{

//    use NasabahTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'total',
    ];

//    protected $appends = [
//        'status_name',
//        'ktp_link',
//        'npwp_link',
//        'profilelink',
//        'default_pict',
//        'edit_customer',
//        'marketings_name'
//    ];

    /**
     * Get marketing data
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User','user_id');
    }


}
