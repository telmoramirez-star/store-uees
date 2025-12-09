<?php
namespace App\Modules\Users\Services;

use App\Models\User;
use App\Modules\Users\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
     public function __construct(
        private UserRepository $userRepository
    ) {}

    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    public function getUsersPaginated(int $perPage = 15)
    {
        return $this->userRepository->paginate($perPage);
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data): User
    {
        DB::beginTransaction();

        try {
            $data['password'] = Hash::make($data['password']);
            $data['status'] = 'Activo';

            $user = $this->userRepository->create($data);

            DB::commit();

            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateUser(int $id, array $data): User
    {
        DB::beginTransaction();

        try {
            $user = $this->userRepository->findById($id);

            if (!$user) {
                throw new Exception('Usuario no encontrado');
            }

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $this->userRepository->update($user, $data);

            DB::commit();

            return $user->fresh();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new Exception('Usuario no encontrado');
        }

        return $this->userRepository->delete($user);
    }

    public function toggleUserStatus(int $id): User
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new Exception('Usuario no encontrado');
        }

        $this->userRepository->update($user, [
            'is_active' => !$user->is_active
        ]);

        return $user->fresh();
    }
}
