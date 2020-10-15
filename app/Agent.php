<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class Agent extends Authenticatable
{
    use HasMultiAuthApiTokens;
    protected $table = 'agents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password', 'fname', 'lname', 'bname', 'addr1', 'addr2', 'addr3', 'addr4', 'city', 'state', 'country', 'pincode', 'mobile', 'phone1', 'phone2', 'email', 'photo', 'provider', 'provider_id', 'kyc_aadhar', 'kyc_aadhar_copy', 'kyc_passport', 'kyc_passport_copy', 'kyc_pan', 'kyc_pan_copy', 'kyc_driving', 'kyc_driving_copy', 'kyc_other', 'kyc_other_copy', 'notes'];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['deleted_at'];

    protected $migrationAttributes = [['name' => 'username', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'password', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'fname', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'lname', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'bname', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'addr1', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'addr2', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'addr3', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'addr4', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'city', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'state', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'country', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'pincode', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'mobile', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'phone1', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'phone2', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'email', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'photo', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'provider', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'provider_id', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_aadhar', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_aadhar_copy', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_passport', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_passport_copy', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_pan', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_pan_copy', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_driving', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_driving_copy', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_other', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'kyc_other_copy', 'properties' => ['string', 'nullable', 'fillable']], ['name' => 'notes', 'properties' => ['string', 'nullable', 'fillable']]];

    /**
     * Return the attributes used to generate a migration.
     *
     * @return array
     */
    public function migrationAttributes()
    {
        return $this->migrationAttributes;
    }
    /**
     * User morphs many reset.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function resets()
    {
        // morphMany(MorphedModel, morphableName, type = able_type, relatedKeyName = able_id, localKey = id)
        return $this->morphMany("App\Agent", 'resetable');
    }
    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }
}
