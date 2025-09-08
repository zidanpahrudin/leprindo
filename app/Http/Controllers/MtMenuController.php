<?php

namespace App\Http\Controllers;

use App\Models\MtMenu;
use Illuminate\Http\Request;

class MtMenuController extends Controller
{
    /**
     * Tampilkan semua menu
     */
    public function index()
    {
        $menus = MtMenu::with('children')->get();
        return response()->json($menus);
    }

    /**
     * Simpan menu baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id'   => 'nullable|exists:mt_menu,menu_id',
            'name'        => 'required|string|max:100',
            'url'         => 'required|string|max:255',
            'icon'        => 'nullable|string|max:50',
            'order'       => 'integer',
            'is_active'   => 'boolean',
            'pic_input'   => 'required|string|max:25',
            'input_time'  => 'required|date',
            'pic_edit'    => 'nullable|string|max:25',
            'edit_time'   => 'nullable|date',
        ]);

        $menu = MtMenu::create($validated);

        return response()->json($menu, 201);
    }

    /**
     * Tampilkan detail menu
     */
    public function show($id)
    {
        $menu = MtMenu::with('children')->findOrFail($id);
        return response()->json($menu);
    }

    /**
     * Update menu
     */
    public function update(Request $request, $id)
    {
        $menu = MtMenu::findOrFail($id);

        $validated = $request->validate([
            'parent_id'   => 'nullable|exists:mt_menu,menu_id',
            'name'        => 'sometimes|required|string|max:100',
            'url'         => 'sometimes|required|string|max:255',
            'icon'        => 'nullable|string|max:50',
            'order'       => 'integer',
            'is_active'   => 'boolean',
            'pic_edit'    => 'nullable|string|max:25',
            'edit_time'   => 'nullable|date',
        ]);

        $menu->update($validated);

        return response()->json($menu);
    }

    /**
     * Hapus menu
     */
    public function destroy($id)
    {
        $menu = MtMenu::findOrFail($id);
        $menu->delete();

        return response()->json(['message' => 'Menu deleted successfully']);
    }
}
