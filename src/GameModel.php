<?php
class GameModel {
    public string $id;
    public string $name;
    public string $genre;
    public string $photo;
    public int $playTimeOfGame;
    public int $totalRating;

    public function __construct(string $name, string $genre, string $photo, int $playTimeOfGame, int $totalRating = 0, ?string $id = null) {
        $this->id = $id ?? uniqid();
        $this->name = $name;
        $this->genre = $genre;
        $this->photo = $photo;
        $this->playTimeOfGame = $playTimeOfGame;
        $this->totalRating = $totalRating;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'genre' => $this->genre,
            'photo' => $this->photo,
            'playTimeOfGame' => $this->playTimeOfGame,
            'totalRating' => $this->totalRating,
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['name'] ?? '',
            $data['genre'] ?? '',
            $data['photo'] ?? '',
            (int)($data['playTimeOfGame'] ?? 0),
            (int)($data['totalRating'] ?? 0),
            $data['id'] ?? null
        );
    }
}
