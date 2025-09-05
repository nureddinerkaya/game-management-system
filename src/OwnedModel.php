<?php
class OwnedModel {
    public string $id;
    public string $userId;
    public string $gameId;
    public int $playTime;
    public int $rating;
    /** @var array<int, array<string, string>> */
    public array $comment;

    public function __construct(string $userId, string $gameId, int $playTime = 0, int $rating = 0, array $comment = [], ?string $id = null) {
        $this->id = $id ?? uniqid();
        $this->userId = $userId;
        $this->gameId = $gameId;
        $this->playTime = $playTime;
        $this->rating = $rating;
        $this->comment = $comment;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'gameId' => $this->gameId,
            'playTime' => $this->playTime,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['userId'] ?? '',
            $data['gameId'] ?? '',
            (int)($data['playTime'] ?? 0),
            (int)($data['rating'] ?? 0),
            $data['comment'] ?? [],
            $data['id'] ?? null
        );
    }
}
