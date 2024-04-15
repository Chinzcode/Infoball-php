<?php

namespace Infoball\classes\Database;

use PDO;
use Infoball\classes\Database\Database;
use Infoball\classes\Entity\League\League;
use Infoball\classes\Entity\Playerstats\Playerstats;
use Infoball\classes\Entity\Standing\Standing;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class DatabaseManager
 *
 */
class DatabaseManager
{
    public function insertPlayerstatsData(Playerstats $playerstats, int $league, int $season, string $name)
    {
        $db = Database::getDb();
        $tableName = $name . $league . "_" . $season;
        $query = "INSERT INTO $tableName (player_id, name, firstname, lastname, photo, team_name, team_logo, goals, penalty_goals, assists, yellow_card, red_card) 
                  VALUES (:player_id, :name, :firstname, :lastname, :photo, :team_name, :team_logo, :goals, :penalty_goals, :assists, :yellow_card, :red_card)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":player_id", $playerstats->getPlayerId());
        $stmt->bindValue(":name", $playerstats->getName());
        $stmt->bindValue(":firstname", $playerstats->getFirstname());
        $stmt->bindValue(":lastname", $playerstats->getLastname());
        $stmt->bindValue(":photo", $playerstats->getPhoto());
        $stmt->bindValue(":team_name", $playerstats->getTeamName());
        $stmt->bindValue(":team_logo", $playerstats->getTeamLogo());
        $stmt->bindValue(":goals", $playerstats->getGoals());
        $stmt->bindValue(":penalty_goals", $playerstats->getPenaltyGoals());
        $stmt->bindValue(":assists", $playerstats->getAssists());
        $stmt->bindValue(":yellow_card", $playerstats->getYellowcards());
        $stmt->bindValue(":red_card", $playerstats->getRedcards());
        $stmt->execute();
    }

    public function deleteDatabaseTableData(int $league, int $season, string $name)
    {
        $db = Database::getDb();
        $tableName = $name . $league . "_" . $season;
        $query = "DELETE FROM $tableName";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    public function deletePlayerstatsData(int $league, int $season, string $name)
    {
        $this->deleteDatabaseTableData($league, $season, $name);
    }

    public function getPlayerstats(int $league, int $season, string $name)
    {
        $db = Database::getDb();
        $tableName = $name . $league . "_" . $season;
        $query = "SELECT * FROM $tableName";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $stats = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $playerstats = new Playerstats(
                $row['player_id'],
                $row['name'],
                $row['firstname'],
                $row['lastname'],
                $row['photo'],
                $row['team_name'],
                $row['team_logo'],
                $row['goals'],
                $row['penalty_goals'],
                $row['assists'],
                $row['yellow_card'],
                $row['red_card']
            );

            $stats[] = $playerstats;
        }

        return $stats;
    }

    public function insertStanding(Standing $standing, int $league, int $season)
    {
        $db = Database::getDb();

        $tableName = "leagueStandings" . $league . "_" . $season;

        $query = "INSERT INTO $tableName (team_rank, team_id, name, logo, points, goals_diff, form, played, win, draw, lose, goals_for, goals_against) 
                  VALUES (:team_rank, :team_id, :name, :logo, :points, :goals_diff, :form, :played, :win, :draw, :lose, :goals_for, :goals_against)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(":team_rank", $standing->getRank());
        $stmt->bindValue(":team_id", $standing->getId());
        $stmt->bindValue(":name", $standing->getName());
        $stmt->bindValue(":logo", $standing->getLogo());
        $stmt->bindValue(":points", $standing->getPoints());
        $stmt->bindValue(":goals_diff", $standing->getGoalsDiff());
        $stmt->bindValue(":form", $standing->getForm());
        $stmt->bindValue(":played", $standing->getPlayed());
        $stmt->bindValue(":win", $standing->getWin());
        $stmt->bindValue(":draw", $standing->getDraw());
        $stmt->bindValue(":lose", $standing->getLose());
        $stmt->bindValue(":goals_for", $standing->getGoalsFor());
        $stmt->bindValue(":goals_against", $standing->getGoalsAgainst());
        $stmt->execute();
    }

    public function deleteStanding(int $league, int $season)
    {
        $db = Database::getDb();
        $tableName = "leagueStandings" . $league . "_" . $season;
        $query = "DELETE FROM $tableName";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    public function getStanding(int $league, int $season)
    {
        $db = Database::getDb();

        $tableName = "leagueStandings" . $league . "_" . $season;

        $query = "SELECT * FROM $tableName";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $standings = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $standing = new Standing(
                $row['team_rank'],
                $row['team_id'],
                $row['name'],
                $row['logo'],
                $row['points'],
                $row['goals_diff'],
                $row['form'],
                $row['played'],
                $row['win'],
                $row['draw'],
                $row['lose'],
                $row['goals_for'],
                $row['goals_against']
            );

            $standings[] = $standing;
        }

        return $standings;
    }

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
