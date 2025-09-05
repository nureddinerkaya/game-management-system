<?php
class UserModel {
    public string $id;
    public string $username;
    public string $password;
    public int $totalPlayTime;
    public ?string $mostPlayedGame;

    public function __construct(string $username, string $password, int $totalPlayTime = 0, ?string $mostPlayedGame = null, ?string $id = null) {
        $this->id = $id ?? uniqid();
        $this->username = $username;
        $this->password = $password;
        $this->totalPlayTime = $totalPlayTime;
        $this->mostPlayedGame = $mostPlayedGame;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'totalPlayTime' => $this->totalPlayTime,
            'mostPlayedGame' => $this->mostPlayedGame,
        ];
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['username'] ?? '',
            $data['password'] ?? '',
            (int)($data['totalPlayTime'] ?? 0),
            $data['mostPlayedGame'] ?? null,
            $data['id'] ?? null
        );
    }
}
