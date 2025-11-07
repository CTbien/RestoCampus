<?php
require_once "config/Db.php";

class UserModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Db::getInstance()->getConnection();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function findByLoginPassword(string $login, string $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE login = :login LIMIT 1");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user) return false;


        if ($user['motDePasse'] === $password) return $user;


        if (password_verify($password, $user['motDePasse'])) return $user;

        return false;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT idUtilisateur, login, nom, prenom, role FROM utilisateur ORDER BY login ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add(array $data): int {

        $stmt = $this->pdo->prepare("
            INSERT INTO utilisateur (login, nom, prenom, motDePasse, role)
            VALUES (:login, :nom, :prenom, :motDePasse, :role)
        ");
        $stmt->execute([
            'login' => $data['login'],
            'nom' => $data['nom'],
            'prenom' => $data['prenom'],
            'motDePasse' => $data['motDePasse'],
            'role' => $data['role'],
        ]);
        
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, array $data): bool {

        if (isset($data['motDePasse']) && $data['motDePasse'] !== '') {
            $sql = "UPDATE utilisateur SET login = :login, nom = :nom, prenom = :prenom, motDePasse = :motDePasse, role = :role WHERE idUtilisateur = :id";
            $params = [
                'login' => $data['login'],
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'motDePasse' => $data['motDePasse'],
                'role' => $data['role'],
                'id' => $id
            ];
        } else {
            $sql = "UPDATE utilisateur SET login = :login, nom = :nom, prenom = :prenom, role = :role WHERE idUtilisateur = :id";
            $params = [
                'login' => $data['login'],
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'role' => $data['role'],
                'id' => $id
            ];
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return ($stmt->rowCount() > 0);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM utilisateur WHERE idUtilisateur = :id");
        $stmt->execute(['id' => $id]);
        return ($stmt->rowCount() > 0);
    }
}
