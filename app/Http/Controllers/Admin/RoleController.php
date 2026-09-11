<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')
            ->withCount('permissions')
            ->latest()
            ->paginate(10);

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:roles,slug',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $role = Role::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        $role->permissions()->sync(
            $validated['permissions'] ?? []
        );

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        $role->load([
            'permissions',
            'users',
        ]);

        return view('admin.roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        $role->load('permissions');

        $selectedPermissions = $role->permissions
            ->pluck('id')
            ->toArray();

        return view(
            'admin.roles.edit',
            compact(
                'role',
                'permissions',
                'selectedPermissions'
            )
        );
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:roles,slug,' . $role->id,
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $role->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        $role->permissions()->sync(
            $validated['permissions'] ?? []
        );

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->slug === 'admin') {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'Admin role cannot be deleted.'
                );
        }

        if ($role->users()->exists()) {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'This role cannot be deleted because users are assigned to it.'
                );
        }

        $role->permissions()->detach();

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Role deleted successfully.'
            );
    }
}
