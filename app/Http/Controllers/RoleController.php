<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        //Recupera a Lista de Papéis Cadastrados
        $roles = Role::orderBy('id', 'ASC')->get();

        return view('roles.index', ['menu' => 'roles', 'roles' => $roles]);
    }

    public function store(Request $request)
    {
        //validar os dados do request
        $request->validate([
            'name' => 'required|unique:roles',
        ], [
            'name.required' => 'Campo Nome do Papel é Obrigatório',
            'name.unique' => 'Já exite esse Papel'
        ]);

        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta salvar no Banco de Dados
        try {
            // Salvar as informações do form no DB
            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);
            
            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Papel Cadastrado', ['role_id' => $role->id, 'action_user_id' => Auth::id() ]);

            return redirect()->route('roles.index')
            ->with('success', 'Papel cadastrado com sucesso');

        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Papel não Cadastrado', ['action_user_id' => Auth::id(), 'error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Papel não foi cadastrado');

        }
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //validar os dados do request
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Campo Nome do Papel é Obrigatório',
        ]);

        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta editar no Banco de Dados
        try {

            // Editar no Banco de Dados
            $role->update([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);


            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Papel Editado', ['role_id' => $role->id, 'action_user_id' => Auth::id() ]);

            // Carregar a View
            return redirect()->route('roles.index')
            ->with('success', 'Papel Editado com sucesso');  
            
        } catch (Exception $e){

            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Papel não Editado', ['role_id' => $role->id, 'action_user_id' => Auth::id(), 'error' => $e->getMessage()]);

            return back()->withInput()->with('error', 'Papel não foi Editado');

        }

    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Abrir query no banco de dados
        DB::beginTransaction();

        // Tenta excluir no Banco de Dados
        try {

           
            // Excluir o registro
            $role->delete();

            // Confirma a transação
            DB::commit();

            // Registrar no Log
            Log::info('Papel Deletado', ['role_id' => $role->id, 'action_role_id' => Auth::id() ]);

            // Carregar a View
            return redirect()->route('roles.index')
            ->with('success', 'Papel excluido com Sucesso');

        } catch (Exception $e) {
            
            // Desfaz a transação
            DB::rollBack();

            // Registrar no Log
            Log::notice('Papel não Deletado', ['role_id' => $role->id,  'action_role_id' => Auth::id(), 'error' => $e->getMessage()]);
            
            $errorCod = $e->getCode();
            return redirect()->route('roles.index')
            ->with('error', "Papel: $role->name não pode ser excluido. (Erro: $errorCod)");

        }
    }
}
