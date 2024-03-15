<?php

namespace Infoball\classes\Database;

use PDO;
use Infoball\util\PHP\League\League;
use Infoball\classes\Database\Database;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class DatabaseManager
 *
 */
class DatabaseManager
{
    public function insertLeague(League $league)
    {
        $db = Database::getDb();
        $query = "INSERT INTO leagues (id, name, logo, country, seasons) VALUES (:id, :name, :logo, :country, :seasons);";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":id", $league->getId());
        $stmt->bindValue(":name", $league->getName());
        $stmt->bindValue(":logo", $league->getLogo());
        $stmt->bindValue(":country", $league->getCountry());
        $seasons = serialize($league->getSeasons());
        $stmt->bindValue(":seasons", $seasons);
        $stmt->execute();
    }

    public function getLeague(string $name, string $country)
    {
        $db = Database::getDb();
        $query = "SELECT * FROM leagues WHERE name = :name AND country = :country;";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":name", $name);
        $stmt->bindValue(":country", $country);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $result['seasons'] = unserialize($result['seasons']);
        return $result;
    }
}
