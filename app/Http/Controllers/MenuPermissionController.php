<?php

namespace App\Http\Controllers;

use App\Models\MenuPermission;
use Illuminate\Http\Request;

class MenuPermissionController extends Controller
{
    /**
     * Tampilkan semua permission
     */
    public function index()
    {
        $permissions = MenuPermission::with(['user', 'menu'])->get();
        return response()->json($permissions);
    }

    /**
     * Simpan permission baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'menu_id'     => 'required|exists:mt_menu,menu_id',
            'name'        => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'pic_input'   => 'required|string|max:25',
            'input_time'  => 'required|date',
            'pic_edit'    => 'nullable|string|max:25',
            'edit_time'   => 'nullable|date',
        ]);

        $permission = MenuPermission::create($validated);

        return response()->json($permission, 201);
    }

    /**
     * Tampilkan detail permission
     */
    public function show($id)
    {
        $permission = MenuPermission::with(['user', 'menu'])->findOrFail($id);
        return response()->json($permission);
    }

    /**
     * Update permission
     */
    public function update(Request $request, $id)
    {
        $permission = MenuPermission::findOrFail($id);

        $validated = $request->validate([
            'user_id'     => 'sometimes|required|exists:users,id',
            'menu_id'     => 'sometimes|required|exists:mt_menu,menu_id',
            'name'        => 'sometimes|required|string|max:100',
            'description' => 'nullable|string|max:255',
            'pic_edit'    => 'nullable|string|max:25',
            'edit_time'   => 'nullable|date',
        ]);

        $permission->update($validated);

        return response()->json($permission);
    }

    /**
     * Hapus permission
     */
    public function destroy($id)
    {
        $permission = MenuPermission::findOrFail($id);
        $permission->delete();

        return response()->json(['message' => 'Permission deleted successfully']);
    }

    // get menu permission and relation with mt_menu by user
    public function getMenuPermissionByUser($user_id)
    {
        $permissions = MenuPermission::with(['menu' => function($query) {
            $query->select('menu_id', 'name');
        }])->where('user_id', $user_id)->get();
        return response()->json($permissions);
    }
}
