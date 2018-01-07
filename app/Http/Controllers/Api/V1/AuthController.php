<?php 
namespace App\Http\Controllers\Api\V1;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\User;

class Authcontroller extends BaseController {
	public function create(Request $req){
		$validate = $this->validate($req, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => $req->password
        ]);

        $client = \Laravel\Passport\Client::where('password_client', 1)->first();

        $req->request->add([
            'client_id' => $client->id,
            'secret' => $client->secret
        ]);
        
        // Fire off the internal request. 
        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return $proxy;
	}
}