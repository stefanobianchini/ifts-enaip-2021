<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DemoController extends Controller
{
    public function getUsers() {
        return response('get users');
    }

    public function getSingleUser($id) {
        return response('get user with id '.$id);
    }

    public function postUsers(Request $request) {

        //username obbligatorio, max 255
        //password minimo 8 caratteri, max 255
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required|max:255|min:8'
        ]);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        return response('post users');
    }

    public function putUsers($id) {
        return response('put users');
    }

    public function patchUsers($id) {
        return response('patch users');
    }

    public function deleteUsers($id) {
        return response('delete users');
    }
}
