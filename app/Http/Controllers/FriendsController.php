<?php
namespace App\Http\Controllers;

use App\{User,UserGroup,Group,UserFriend,Message,Chat};
use DB;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    
class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetchFriend()
    {
        $user = Auth::user();
        return response()->json($user->userFriends);
    }

    public function addFriend($email)
    {
        $user = Auth::user();
        $searchUser = DB::table('users')->where('email', $email)->first();
        if($searchUser) {
            foreach($user->userFriends as $userFriend) {
                if($userFriend->id == $searchUser->id) {
                    
                    return response()->json('Masz już tego przyjaciela');
                }
            }
           
            
            
                DB::table('user_friend')->insert([
                    'userID' => $user->id,
                    'friendID' => $searchUser->id
                ]);

                DB::table('user_friend')->insert([
                    'userID' => $searchUser->id,
                    'friendID' => $user->id
                ]);
                return response()->json('Dodałeś przyjaciela');
           
        } else {
            return response()->json('Niepoprawny adres email');
        }
    }

}
