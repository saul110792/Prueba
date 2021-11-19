<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Phone;

class UsersController extends Controller
{
    /**
     * Función para obtener todos los usuarios
     */
    public function getUsers(){
        $users = User::get()->toJson(utf8_encode(JSON_UNESCAPED_UNICODE));
        return response($users, 200);
    }

    /**
     * Función para obtener un usuario en especifico con el id 
     */
    public function getUsersId($id){
        if (User::where('id', $id)->exists()) {
            $user = User::where('id', $id)->get()->toJson(JSON_UNESCAPED_UNICODE);
            return response($user, 200);
        } else {
            return response()->json([
                "message" => "User not found"
                ], 404);
        }
    }

    /**
     * Función para obtener los telefonos
     */
    public function getPhoneUsersId($id){
        if (Phone::where('user_id', $id)->exists()) {
            $phone = Phone::where('user_id', $id)->get()->toJson(JSON_UNESCAPED_UNICODE);
            return response($phone, 200);
        } else {
            return response()->json([
                "message" => "User not found"
                ], 404);
        }
    }

    /**
     * Función para agregar un nuevo usuario
     * Con uno o muchos números telefonicos
     */
    public function addUser(Request $request){
        $user = new User;
        $user->name = $request->name;
        $user->second_name = $request->second_name;
        $user->email = $request->email;
        $user->group = $request->group;
        $user->save();
        
        if($user->id != null){
            foreach($request->phones as $phones){
                
                $phone = new Phone; 
                $phone->user_id = $user->id;
                $phone->number = $phones['phone'];
                $phone->save();
            }            
            return response()->json([
                "message" => "usuario guardado correctamente."
            ], 201);
        }else{
            return response()->json([
                "message" => "Error al guardar al usuario"
            ], 400);
        }
    }

    /**
     * Función para editar un usuario
     */
    public function editUser(Request $request, $id){
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->second_name = $request->second_name;
            $user->email = $request->email;
            $user->group = $request->group;
            $user->save();
            
            Phone::where('user_id',$id)->delete();
            foreach($request->phones as $phones){
                $phone = new Phone; 
                $phone->user_id = $user->id;
                $phone->number = $phones['phone'];
                $phone->save();
            }            
            return response()->json([
                "message" => "usuario actualizado correctamente."
            ], 201);
        }else{
            return response()->json([
                "message" => "Error al guardar al usuario"
            ], 400);
        }
    }

    /**
     * Función para eliminar un usuario en especifico con el id 
     */
    public function deleteUser($id){
        if (User::where('id', $id)->exists()) {
            $phone = Phone::where('user_id',$id)->delete();
            //$phone->delete();
            $user = User::find($id);
            $user->delete();
            return response([
                "message" => "usuario eliminado"
              ], 200);
        } else {
            return response()->json([
                "message" => "User not found"
                ], 404);
        }
    }
}
