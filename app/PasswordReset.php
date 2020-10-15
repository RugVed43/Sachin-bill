<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
	protected $table ="password_resets";
	protected $fillable = [
	'email',
	'token',
	'resetable_type',
	'resetable_id',
	];

	/**
	 * PasswordReset morphs to models in resetable_type.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphTo
	 */
	public function resetable()
	{
		// morphTo($name = resetable, $type = resetable_type, $id = resetable_id)
		// requires resetable_type and resetable_id fields on $this->table
		return $this->morphTo();
	}
}
