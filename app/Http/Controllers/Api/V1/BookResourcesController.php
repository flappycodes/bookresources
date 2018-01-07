<?php

namespace App\Http\Controllers\Api\V1;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Entity\BookResources;
use App\Entity\Purchases;
use App\User;

class BookResourcesController extends BaseController {

	public function index(Request $req){
		$books = BookResources::where('is_deleted', 0)->get();
		
		return BookResources::where('is_deleted', 0)->get();
	}

	public function store(Request $req){
		$success = false;

		$validate = $this->validate($req, [
            'author_id' => 'required',
            'name' => 'required',
			'quantity' => 'required',
			'genre' => 'required',
			'price' => 'required'
        ]);

        $data = array(
        	'author_id' => $req->author_id,
            'name' => $req->name,
			'quantity' => $req->quantity,
			'genre' => $req->genre,
			'price' => $req->price
        );

        $create = BookResources::create($data);

        if ($create) {
        	$success = true;
        }

        return compact('success', 'data');
	}

	public function edit(Request $req, $id){
		return response()->json(['data' => BookResources::find($id)]);
	}

	public function update(Request $req, $id){
		$success = false;

		$validate = $this->validate($req, [
            'author_id' => 'required',
            'name' => 'required',
			'quantity' => 'required',
			'genre' => 'required',
			'price' => 'required'
        ]);

        $data = array(
        	'author_id' => $req->author_id,
            'name' => $req->name,
			'quantity' => $req->quantity,
			'genre' => $req->genre,
			'price' => $req->price
        );

        $update = BookResources::where('id', $id)->update($data);

        if ($update) {
        	$success = true;
        }

        return compact('success', 'data');
	}

	public function delete(Request $req, $id){
		$success = false;
		$exist = BookResources::find($id);
		if ($exist) {
			$delete = BookResources::where('id', $id)->update(['is_deleted' => 1]);

			if ($delete) {
				$success = true;
				$msg = 'Successfully deleted!';
			}
		}else{
			$msg = 'Undefined given id.';
		}
		
		return compact('success', 'msg');
	}

	public function search(Request $req, $search){
		return BookResources::where('name', 'LIKE', '%'.$search.'%')->get();
	}

	public function purchase(Request $req, $id){
		$quantity = 0;
		$remaining = 0;
		$success = false;
		$validate = $this->validate($req, [
            'buyer_id' => 'required',
			'quantity' => 'required'
        ]);
        $exist = BookResources::find($id);

		$data = array(
			'book_id' => $id,
			'buyer_id' => $req->buyer_id,
			'quantity' => $req->quantity
		);

		if ($exist) {
			$check_available = Purchases::where('book_id', $exist->id)->get();
			$buyer_exist = User::find($req->buyer_id);

			if (count($check_available) > 0) {
				foreach ($check_available as $ca) {
					$quantity += $ca->quantity;
				}
				$remaining = $exist->quantity - $quantity;
				if ($remaining >= $req->quantity) {
					if ($exist->quantity == $quantity) {
						$msg = "This is book is soled out";
					}else{
						if ($buyer_exist) {
							$success = true;
							$purchased = Purchases::create($data);
						}else{
							$msg = "Undefined given buyer's id.";
						}
					}
				}else{
					$msg = "Cannot purchase with a remaining quantity of ". $remaining;
				}				
			}else{
				if ($buyer_exist) {
					$success = true;
					$purchased = Purchases::create($data);
				}else{
					$msg = "Undefined given buyer's id.";
				}
			}
		}else{
			$msg = 'Undefined given book id.';
		}

		return compact('success', 'msg', 'data');
	}
}