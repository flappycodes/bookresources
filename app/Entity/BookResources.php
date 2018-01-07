<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class BookResources extends Model
{
	protected $fillable = [
		'author_id',
		'name',
		'quantity',
		'genre',
		'price',
		'is_purchased',
		'is_deleted',
	];
}