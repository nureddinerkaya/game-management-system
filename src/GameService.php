<?php
require_once __DIR__ . '/GameModel.php';

class GameService {
    /** @var GameModel[] */
    private static array $games = [];

    public static function getAll(): array {
        return array_map(fn(GameModel $g) => $g->toArray(), self::$games);
    }

    public static function getById(string $id): ?array {
        return isset(self::$games[$id]) ? self::$games[$id]->toArray() : null;
    }

    public static function add(array $data): array {
        $game = GameModel::fromArray($data);
        self::$games[$game->id] = $game;
        return $game->toArray();
    }

    public static function update(array $data): ?array {
        $id = $data['id'] ?? null;
        if (!$id || !isset(self::$games[$id])) {
            return null;
        }
        $game = self::$games[$id];
        $updated = GameModel::fromArray(array_merge($game->toArray(), $data));
        self::$games[$id] = $updated;
        return $updated->toArray();
    }

    public static function delete(string $id): bool {
        if (!isset(self::$games[$id])) {
            return false;
        }
        unset(self::$games[$id]);
        return true;
    }
}
