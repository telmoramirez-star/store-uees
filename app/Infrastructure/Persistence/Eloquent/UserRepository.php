<?php
namespace App\Infrastructure\Persistence\Eloquent;
class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        UserEloquentModel::updateOrCreate(
            ['id' => $user->id()->value()],
            [
                'name' => $user->name(),
                'email' => $user->email()->value(),
            ]
        );
    }

    public function findById(UserId $id): ?User
    {
        $model = UserEloquentModel::find($id->value());

        return $model ? $this->toDomain($model) : null;
    }

    public function findByEmail(Email $email): ?User
    {
        $model = UserEloquentModel::where('email', $email->value())->first();

        return $model ? $this->toDomain($model) : null;
    }

    public function delete(UserId $id): void
    {
        UserEloquentModel::destroy($id->value());
    }

    public function all(): array
    {
        return UserEloquentModel::all()
            ->map(fn($model) => $this->toDomain($model))
            ->toArray();
    }

    private function toDomain(UserEloquentModel $model): User
    {
        return new User(
            new UserId($model->id),
            $model->name,
            new Email($model->email),
            new \DateTimeImmutable($model->created_at)
        );
    }
}
