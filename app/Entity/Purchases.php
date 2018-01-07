<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
	protected $fillable = [
		'book_id',
		'buyer_id',
		'quantity',
		'is_paid'
	];
}