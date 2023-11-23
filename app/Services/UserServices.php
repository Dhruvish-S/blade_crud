<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;


class UserServices {
    public function get()
    {
        return User::get();
    }
    public function add($data)
    {
        return User::create($data);
    }

}


?>
