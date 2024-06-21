<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index (Role $role)
    {
        // Verificar se papel é Super Admin, não permitir visualizar as permissões
        if ($role->name == 'Super Admin')
        {
            Log::info('Permissões do super admin não pode ser acessada.', ['action_user_id' => Auth::id() ]);
            return redirect()->route('roles.index')->with('error', 'Permissão do Super Admin não pode ser acessada');
        }

        // Recuperar as permissões do Papel
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_id', $role->id)
            ->pluck('permission_id')
            ->all();

        // Recuperar as Permissões
        $permissions = Permission::get();

        Log::info('Listar Permissões do Papel', ['role_id' => $role->id, 'action_user_id' => Auth::id() ]);

        return view('rolePermission.index', [
            'menu' => 'roles',
            'rolePermissions' => $rolePermissions,
            'permissions' => $permissions,
            'role' => $role,

        ]);
    }
        
}
