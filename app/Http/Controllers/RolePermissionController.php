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


    // Editar a permissão de acesso a página para o papel
    public function update(Request $request, Role $role)
    {

        // Obter a permissão específica com base no ID fornecido em $request->permission
        $permission = Permission::find($request->permission);

        // Verificar se a permissão foi encontrada
        if(!$permission){

            // Salvar log
            Log::info('Permissão não encontrada.', ['role' => $role->id, 'permission' => $request->permission, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->route('role-permissions.index', ['role' => $role->id])->with('error', 'Permissão não encontrada!');

        }

        // Verificar se a permissão já está associada ao papel
        if($role->permissions->contains($permission)){

            // Remover a permissão do papel (bloquear)
            $role->revokePermissionTo($permission);

            // Salvar log
            Log::info('Bloquear permissão para o papel.', ['action_user_id' => Auth::id(), 'permissao' => $request->permission]);
    
            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('role-permissions.index', ['role' => $role->id])->with('success', "Permissão bloqueada com sucesso!");
        }else{

            // Adicionar a permissão ao papel (liberar)
            $role->givePermissionTo($permission);

            // Salvar log
            Log::info('Liberar permissão para o papel.', ['action_user_id' => Auth::id(), 'permissao' => $request->permission]);
    
            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('role-permissions.index', ['role' => $role->id])->with('success', "Permissão liberada com sucesso!");

        }

    }
        
}
