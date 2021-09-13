<?php


namespace App;


class HelperFunctions
{
    public function GetUserName($uid)
    {
        $GetUser = User::select('name')->where('id', $uid)->get();
    }
}
