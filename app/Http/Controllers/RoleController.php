<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getAllRoles()
    {
        try {
            $roles = Role::all();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Roles retrieved successfully',
                    'data' => $roles
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Roles cant be retrieved',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function createRole(Request $request)
    {
        try {
            $role = new Role();

            $request->validate([
                'name' => 'required|max:50'
            ]);
            $role->name = $request->name;
            $role->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Role created successfully',
                    'data' => $role
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Role cant be created',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateRoleById($id, Request $request)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Game not found',
                        'data' => null
                    ], 404
                );
            }
            
            $request->validate([
                'name' => 'max:50',
            ]);
            
            if ($request->name) {
                $role->name = $request->name;
            }

            $role->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Role updated successfully',
                    'data' => $role
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Role cant be updated',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteRoleById($id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Role not found',
                        'data' => null
                    ], 404
                );
            }
            $role->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Role deleted successfully',
                    'data' => $role
                ], 200
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Role cant be deleted',
                'data' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
