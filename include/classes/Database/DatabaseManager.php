<?php

namespace Infoball\classes\Database;

use PDO;
use Infoball\classes\Database\Database;
use Infoball\classes\Entity\League\League;
use Infoball\classes\Entity\Fixture\Fixture;
use Infoball\classes\Entity\Standing\Standing;
use Infoball\classes\Entity\Playerstats\Playerstats;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

/**
 * Class DatabaseManager
 *
 */
class DatabaseManager
{
    public function deleteDatabaseTableData(int $league, int $season, string $name)
    {
        $db = Database::getDb();
        $tableName = $name . $league . "_" . $season;
        $query = "DELETE FROM $tableName";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }

    public function insertFixturesData(Fixture $fixture, int $league, int $season, string $name)
    {
        $db = Database::getDb();
        $tableName = $name . $league . "_" . $season;
        $query = "INSERT INTO $tableName (
                    fixture_id, 
                    league_id,
                    league_name,
                    league_country,
                    league_logo,
                    league_round,
                    home_team_id,
                    home_team_name,
                    home_team_logo,
                    away_team_id,
                    away_team_name,
                    away_team_logo,
                    referee,
                    timezone,
                    fixture_date,
                    fixture_timestamp,
                    venue_id,
                    venue_name,
                    venue_city,
                    status_long,
                    status_short,
                    status_elapsed,
                    goals_home,
                    goals_away,
                    score_halftime_home,
                    score_halftime_away,
                    score_fulltime_home,
                    score_fulltime_away,
                    score_extratime_home,
                    score_extratime_away,
                    score_penalty_home,
                    score_penalty_away
                ) VALUES (
                    :fixture_id, 
                    :league_id,
                    :league_name,
                    :league_country,
                    :league_logo,
                    :league_round,
                    :home_team_id,
                    :home_team_name,
                    :home_team_logo,
                    :away_team_id,
                    :away_team_name,
                    :away_team_logo,
                    :referee,
                    :timezone,
                    :fixture_date,
                    :fixture_timestamp,
                    :venue_id,
                    :venue_name,
                    :venue_city,
                    :status_long,
                    :status_short,
                    :status_elapsed,
                    :goals_home,
                    :goals_away,
                    :score_halftime_home,
                    :score_halftime_away,
                    :score_fulltime_home,
                    :score_fulltime_away,
                    :score_extratime_home,
                    :score_extratime_away,
                    :score_penalty_home,
                    :score_penalty_away
                )";

        $stmt = $db->prepare($query);
        $stmt->bindValue(":fixture_id", $fixture->getFixtureId());
        $stmt->bindValue(":league_id", $fixture->getLeagueId());
        $stmt->bindValue(":league_name", $fixture->getLeagueName());
        $stmt->bindValue(":league_country", $fixture->getLeagueCountry());
        $stmt->bindValue(":league_logo", $fixture->getLeagueLogo());
        $stmt->bindValue(":league_round", $fixture->getLeagueRound());
        $stmt->bindValue(":home_team_id", $fixture->getHomeTeamId());
        $stmt->bindValue(":home_team_name", $fixture->getHomeTeamName());
        $stmt->bindValue(":home_team_logo", $fixture->getHomeTeamLogo());
        $stmt->bindValue(":away_team_id", $fixture->getAwayTeamId());
        $stmt->bindValue(":away_team_name", $fixture->getAwayTeamName());
        $stmt->bindValue(":away_team_logo", $fixture->getAwayTeamLogo());
        $stmt->bindValue(":referee", $fixture->getReferee());
        $stmt->bindValue(":timezone", $fixture->getTimezone());
        $stmt->bindValue(":fixture_date", $fixture->getFixtureDate());
        $stmt->bindValue(":fixture_timestamp", $fixture->getFixtureTimestamp());
        $stmt->bindValue(":venue_id", $fixture->getVenueId());
        $stmt->bindValue(":venue_name", $fixture->getVenueName());
        $stmt->bindValue(":venue_city", $fixture->getVenueCity());
        $stmt->bindValue(":status_long", $fixture->getStatusLong());
        $stmt->bindValue(":status_short", $fixture->getStatusShort());
        $stmt->bindValue(":status_elapsed", $fixture->getStatusElapsed());
        $stmt->bindValue(":goals_home", $fixture->getGoalsHome());
        $stmt->bindValue(":goals_away", $fixture->getGoalsAway());
        $stmt->bindValue(":score_halftime_home", $fixture->getScoreHalftimeHome());
        $stmt->bindValue(":score_halftime_away", $fixture->getScoreHalftimeAway());
        $stmt->bindValue(":score_fulltime_home", $fixture->getScoreFulltimeHome());
        $stmt->bindValue(":score_fulltime_away", $fixture->getScoreFulltimeAway());
        $stmt->bindValue(":score_extratime_home", $fixture->getScoreExtratimeHome());
        $stmt->bindValue(":score_extratime_away", $fixture->getScoreExtratimeAway());
        $stmt->bindValue(":score_penalty_home", $fixture->getScorePenaltyHome());
        $stmt->bindValue(":score_penalty_away", $fixture->getScorePenaltyAway());
        $stmt->execute();
    }

    public function deleteFixturesData(int $league, int $season, string $name)
    {
        $this->deleteDatabaseTableData($league, $season, $name);
    }

    public function getFixtures(int $league, int $season, string $name)
    {
        $db = Database::getDb();
        $tableName = $name . $league . "_" . $season;
        $query = "SELECT * FROM $tableName";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $fixtures = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $fixture = new Fixture(
                $row['fixture_id'],
                $row['league_id'],
                $row['league_name'],
                $row['league_country'],
                $row['league_logo'],
                $row['league_round'],
                $row['home_team_id'],
                $row['home_team_name'],
                $row['home_team_logo'],
                $row['away_team_id'],
                $row['away_team_name'],
                $row['away_team_logo'],
                $row['referee'],
                $row['timezone'],
                $row['fixture_date'],
                $row['fixture_timestamp'],
                $row['venue_id'],
                $row['venue_name'],
                $row['venue_city'],
                $row['status_long'],
                $row['status_short'],
                $row['status_elapsed'],
                $row['goals_home'],
                $row['goals_away'],
                $row['score_halftime_home'],
                $row['score_halftime_away'],
                $row['score_fulltime_home'],
                $row['score_fulltime_away'],
                $row['score_extratime_home'],
                $row['score_extratime_away'],
                $row['score_penalty_home'],
                $row['score_penalty_away']
            );

            $fixtures[] = $fixture;
        }

        return $fixtures;
    }

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
