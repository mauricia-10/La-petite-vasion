<?php

namespace App\Model;

class LevelManager extends AbstractManager
{
    public const TABLE = 'level';

     /**
     * Update Level in database
     */
    public function update(array $level): bool
    {
        $statement = $this->pdo->prepare(
            "UPDATE " . self::TABLE .
            " SET `name` = :name," .
            " `description` = :description," .
            " `width` = :width," .
            " `height` = :height," .
            " `start_x` = :start_x," .
            " `start_y` = :start_y" .
            " WHERE id=:id"
        );
        $statement->bindValue('id', $level['id'], \PDO::PARAM_INT);
        $statement->bindValue('name', $level['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $level['description'], \PDO::PARAM_STR);
        $statement->bindValue('width', $level['width'], \PDO::PARAM_INT);
        $statement->bindValue('height', $level['height'], \PDO::PARAM_INT);
        $statement->bindValue('start_x', $level['start_x'], \PDO::PARAM_INT);
        $statement->bindValue('start_y', $level['start_y'], \PDO::PARAM_INT);
        return $statement->execute();
    }

     /**
     * Create Level in database
     */
    public function create(array $level): int
    {
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
            " (name, description, width, height, start_x, start_y)" .
            " VALUES (:name, :description, :width, :height, :start_x, :start_y)"
        );
        $statement->bindValue('name', $level['name'], \PDO::PARAM_STR);
        $statement->bindValue('description', $level['description'], \PDO::PARAM_STR);
        $statement->bindValue('width', $level['width'], \PDO::PARAM_INT);
        $statement->bindValue('height', $level['height'], \PDO::PARAM_INT);
        $statement->bindValue('start_x', $level['start_x'], \PDO::PARAM_INT);
        $statement->bindValue('start_y', $level['start_y'], \PDO::PARAM_INT);
        $statement->execute();
        return intval($this->pdo->lastInsertId());
    }

     /**
     * Delete row form an ID
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . static::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }
}
