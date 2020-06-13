<?php
namespace App\Http\Controllers;

use App\{User,UserGroup,Group,UserFriend,Message,Chat};
use DB;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    
class GroupsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function fetchGroup()
    {
        $user = Auth::user();
        return response()->json($user->userGroup);
    }

    public function checkGroup($id)
    {
        $user = Auth::user();
        
        $myGroups = DB::table('user_group')->where('userID', $user->id)->get();
        $friendGroups = DB::table('user_group')->where('userID', $id)->get();
        foreach($myGroups as $myGroup) {
            foreach($friendGroups as $friendGroup) {
                if($friendGroup->groupID == $myGroup->groupID) {
                    $group = DB::table('user_group')->where('groupID', $friendGroup->groupID)->get();
                    if(count($group) == 2) {
                        return $friendGroup->groupID;
                    }
                }
            }
        }
        DB::table('group')->insert([
            'name' => "Konwersacja"
        ]);
        $newGroup = DB::table('group')->orderBy('id', 'desc')->first();
        DB::table('user_group')->insert([
            'groupID' => $newGroup->id,
            'userID' => $user->id
        ]);
        DB::table('user_group')->insert([
            'groupID' => $newGroup->id,
            'userID' => $id
        ]);
        return $newGroup->id;
    }

}
