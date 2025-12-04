<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Requests\StoreUserRequest;
use App\Modules\Users\Requests\UpdateUserRequest;
use App\Modules\Users\Services\UserService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function index(): View
    {
        $users = $this->userService->getUsersPaginated();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function show(int $id): View
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                abort(404, 'Usuario no encontrado');
            }

            return view('users.show', compact('user'));
        } catch (Exception $e) {
            abort(500, 'Error al obtener usuario');
        }
    }

    public function edit(int $id): View
    {
        try {
            $user = $this->userService->getUserById($id);

            if (!$user) {
                abort(404, 'Usuario no encontrado');
            }

            return view('users.edit', compact('user'));
        } catch (Exception $e) {
            abort(500, 'Error al obtener usuario');
        }
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $this->userService->createUser($request->validated());

            return redirect()
                ->route('users.index')
                ->with('success', 'Usuario creado exitosamente');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error al crear usuario: ' . $e->getMessage());
        }
    }

    public function update(UpdateUserRequest $request, int $id): RedirectResponse
    {
        try {
            $this->userService->updateUser($id, $request->validated());

            return redirect()
                ->route('users.index')
                ->with('success', 'Usuario actualizado exitosamente');
        } catch (Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error al actualizar usuario: ' . $e->getMessage());
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->userService->deleteUser($id);

            return redirect()
                ->route('users.index')
                ->with('success', 'Usuario eliminado exitosamente');
        } catch (Exception $e) {
            return back()
                ->with('error', 'Error al eliminar usuario: ' . $e->getMessage());
        }
    }

    public function toggleStatus(int $id): RedirectResponse
    {
        try {
            $this->userService->toggleUserStatus($id);

            return back()
                ->with('success', 'Estado del usuario actualizado');
        } catch (Exception $e) {
            return back()
                ->with('error', 'Error al cambiar estado: ' . $e->getMessage());
        }
    }
}
