<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class assignRole extends Controller
{
    public function asignRole(Request $request,$id){
        $user=User::findOrFail($id);
        $request->validate([
            'role_id' => 'required|array',
            'role_id.*' => 'exists:roles,id',
        ]);
        $role=Role::whereIn('id',$request->role_id)->get();
        $user->syncRoles($role);

return response()->json([
    $user
]);
    }
    public function asignPerToRole(Request $request,$id){
        $role=Role::findOrFail($id);
        $request->validate([
            'permission_id' => 'required|array',
            'permission_id.*' => 'exists:permissions,id',
        ]);
        $permission=Permission::whereIn('id',$request->permission_id)->get();
        $role->syncPermissions($permission);

return response()->json([
    $role
]);
    }

    public function removeRole(Request $request,$user_id){
    $user=User::findOrFail($user_id);
    $request->validate([
        'role_id' => 'required|array',
        'role_id.*' => 'exists:roles,id',
    ]);
    foreach ($request->role_id as $id) {
        $role=Role::findById($id);
        $user->removeRole($role);
    }
    
        return response()->json([
        $request->role_id,$role,$arr
        ]);
    }

}
