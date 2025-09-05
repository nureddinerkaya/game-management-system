<?php
require_once __DIR__ . '/UserModel.php';

class UserService {
    /** @var UserModel[] */
    private static array $users = [];

    public static function getAll(): array {
        return array_map(fn(UserModel $u) => $u->toArray(), self::$users);
    }

    public static function getById(string $id): ?array {
        return isset(self::$users[$id]) ? self::$users[$id]->toArray() : null;
    }

    public static function add(array $data): array {
        $user = UserModel::fromArray($data);
        self::$users[$user->id] = $user;
        return $user->toArray();
    }

    public static function update(array $data): ?array {
        $id = $data['id'] ?? null;
        if (!$id || !isset(self::$users[$id])) {
            return null;
        }
        $user = self::$users[$id];
        $updated = UserModel::fromArray(array_merge($user->toArray(), $data));
        self::$users[$id] = $updated;
        return $updated->toArray();
    }

    public static function delete(string $id): bool {
        if (!isset(self::$users[$id])) {
            return false;
        }
        unset(self::$users[$id]);
        return true;
    }
}
