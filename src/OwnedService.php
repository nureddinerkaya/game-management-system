<?php
require_once __DIR__ . '/OwnedModel.php';

class OwnedService {
    /** @var OwnedModel[] */
    private static array $owneds = [];

    public static function getAll(): array {
        return array_map(fn(OwnedModel $o) => $o->toArray(), self::$owneds);
    }

    public static function getById(string $id): ?array {
        return isset(self::$owneds[$id]) ? self::$owneds[$id]->toArray() : null;
    }

    public static function getByUser(string $userId): array {
        return array_values(array_map(
            fn(OwnedModel $o) => $o->toArray(),
            array_filter(self::$owneds, fn(OwnedModel $o) => $o->userId === $userId)
        ));
    }

    public static function add(array $data): ?array {
        $userId = $data['userId'] ?? '';
        $gameId = $data['gameId'] ?? '';
        foreach (self::$owneds as $owned) {
            if ($owned->userId === $userId && $owned->gameId === $gameId) {
                return null;
            }
        }
        $owned = OwnedModel::fromArray($data);
        self::$owneds[$owned->id] = $owned;
        return $owned->toArray();
    }

    public static function update(array $data): ?array {
        $id = $data['id'] ?? null;
        if (!$id || !isset(self::$owneds[$id])) {
            return null;
        }
        $owned = self::$owneds[$id];
        $updated = OwnedModel::fromArray(array_merge($owned->toArray(), $data));
        self::$owneds[$id] = $updated;
        return $updated->toArray();
    }

    public static function delete(string $id): bool {
        if (!isset(self::$owneds[$id])) {
            return false;
        }
        unset(self::$owneds[$id]);
        return true;
    }

    public static function play1hour(string $id): ?array {
        if (!isset(self::$owneds[$id])) {
            return null;
        }
        self::$owneds[$id]->playTime += 1;
        return self::$owneds[$id]->toArray();
    }
}
