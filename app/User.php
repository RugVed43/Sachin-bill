<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Laravel\Passport\HasApiTokens;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class User extends Authenticatable
{
    use HasMultiAuthApiTokens,Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'username',
    'password',
    'fname',
    'lname',
    'bname',
    'addr1',
    'addr2',
    'addr3',
    'addr4',
    'city',
    'state',
    'country',
    'pincode',
    'mobile',
    'phone1',
    'phone2',
    'email',
    'photo',
    'provider',
    'provider_id',
    'kyc_aadhar',
    'kyc_aadhar_copy',
    'kyc_passport',
    'kyc_passport_copy',
    'kyc_pan',
    'kyc_pan_copy',
    'kyc_driving',
    'kyc_driving_copy',
    'kyc_other',
    'kyc_other_copy',
    'notes',
    'dob',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];
    protected $dates = ['deleted_at'];
    protected $appends = ['name','addressp','address','numbers'];

    public function setPasswordAttribute($pass){
        $this->attributes['password'] = bcrypt($pass);
    }
    public function getNameAttribute()
    {
        return $this->fname . " ". $this->lname;

    }
    public function getAddresspAttribute()
    {
        $addr = '';
        $addr .= (!empty($this->addr1)) ? $this->addr1 : null;
        $addr .= (!empty($this->addr2)) ? ", ".$this->addr2 : null;
        $addr .= (!empty($this->addr3)) ? ", ".$this->addr3 : null;
        $addr .= (!empty($this->addr4)) ? ", ".$this->addr4 : null;
        $addr .= (!empty($this->city)) ? ", ".$this->city : null;
        $addr .= (!empty($this->pincode)) ? " - ".$this->pincode : null;
        $addr .= (!empty($this->state)) ? ", ".$this->state : null;
        $addr .= (!empty($this->country)) ? ", ".$this->country : null;
        return $addr;

    }
    public function getAddressAttribute()
    {
        $addr = '';
        $addr .= (!empty($this->addr1)) ? $this->addr1 : null;
        $addr .= (!empty($this->addr2)) ? ", <br>".$this->addr2 : null;
        $addr .= (!empty($this->addr3)) ? ", <br>".$this->addr3 : null;
        $addr .= (!empty($this->addr4)) ? ", <br>".$this->addr4 : null;
        $addr .= (!empty($this->city)) ? ", <br>".$this->city : null;
        $addr .= (!empty($this->pincode)) ? " - ".$this->pincode : null;
        $addr .= (!empty($this->state)) ? ", <br>".$this->state : null;
        $addr .= (!empty($this->country)) ? ", <br>".$this->country : null;
        return $addr;

    }
    public function getnumbersAttribute()
    {
        $details = '';

        $details .= (!empty($this->mobile)) ? $this->mobile . " / " : null;
        $details .= (!empty($this->phone1)) ? $this->phone1 : null;
        $details .= (!empty($this->phone2)) ? " / ".$this->phone2 : null;
        return $details;

    }
    /**
     * User morphs many reset.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function resets()
    {
        // morphMany(MorphedModel, morphableName, type = able_type, relatedKeyName = able_id, localKey = id)
        return $this->morphMany("App\User", 'resetable');
    }
}
