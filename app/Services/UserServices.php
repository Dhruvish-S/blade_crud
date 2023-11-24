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
    public function getById($id)
    {
        return User::where('id', $id)->get();
    }
    public function update($id, $data)
    {
        return User::where('id', $id)->update($data);
    }
    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }

}


?>
