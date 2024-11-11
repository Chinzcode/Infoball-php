<?php

namespace Infoball\classes\Entity\Fixture;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

/**
 * Class Fixture
 *
 * Represents a Fixture entity with fixture details.
 */
class Fixture
{
    /**
     * @var int The id of the fixture.
     */
    protected int $fixtureId;

    /**
     * @var int The id of the league.
     */
    protected int $leagueId;

    /**
     * @var string The name of the league.
     */
    protected string $leagueName;

    /**
     * @var string The country of the league.
     */
    protected string $leagueCountry;

    /**
     * @var string The URL of the league's logo.
     */
    protected string $leagueLogo;

    /**
     * @var string The round of the league.
     */
    protected string $leagueRound;

    /**
     * @var int The id of the home team.
     */
    protected int $homeTeamId;

    /**
     * @var string The name of the home team.
     */
    protected string $homeTeamName;

    /**
     * @var string The URL of the home team's logo.
     */
    protected string $homeTeamLogo;

    /**
     * @var int The id of the away team.
     */
    protected int $awayTeamId;

    /**
     * @var string The name of the away team.
     */
    protected string $awayTeamName;

    /**
     * @var string The URL of the away team's logo.
     */
    protected string $awayTeamLogo;

    /**
     * @var string The referee of the fixture.
     */
    protected ?string $referee;

    /**
     * @var string The timezone of the fixture.
     */
    protected string $timezone;

    /**
     * @var string The date and time of the fixture.
     */
    protected string $fixtureDate;

    /**
     * @var int The timestamp of the fixture.
     */
    protected int $fixtureTimestamp;

    /**
     * @var int The id of the venue.
     */
    protected ?int $venueId;

    /**
     * @var string The name of the venue.
     */
    protected string $venueName;

    /**
     * @var string The city of the venue
     */
    protected string $venueCity;

    /**
     * @var string The status long of the fixture.
     */
    protected string $statusLong;

    /**
     * @var string The status short of the fixture.
     */
    protected string $statusShort;

    /**
     * @var int The elapsed time of the fixture.
     */
    protected ?int $statusElapsed;

    /**
     * @var int The number of goals scored by the home team.
     */
    protected ?int $goalsHome;

    /**
     * @var int The number of goals scored by the away team.
     */
    protected ?int $goalsAway;

    /**
     * @var int The number of goals scored by the home team at halftime.
     */
    protected ?int $scoreHalftimeHome;

    /**
     * @var int The number of goals scored by the away team at halftime.
     */
    protected ?int $scoreHalftimeAway;

    /**
     * @var int The number of goals scored by the home team at full time.
     */
    protected ?int $scoreFulltimeHome;

    /**
     * @var int The number of goals scored by the away team at full time.
     */
    protected ?int $scoreFulltimeAway;

    /**
     * @var int The number of goals scored by the home team in extra time.
     */
    protected ?int $scoreExtratimeHome;

    /**
     * @var int The number of goals scored by the away team in extra time.
     */
    protected ?int $scoreExtratimeAway;

    /**
     * @var int The number of penalty goals scored by the home team.
     */
    protected ?int $scorePenaltyHome;

    /**
     * @var int The number of penalty goals scored by the away team.
     */
    protected ?int $scorePenaltyAway;

    /**
     * Constructor.
     *
     * @param int $fixtureId The id of the fixture.
     * @param int $leagueId The id of the league.
     * @param string $leagueName The name of the league.
     * @param string $leagueCountry The country of the league.
     * @param string $leagueLogo The URL of the league's logo.
     * @param string $leagueRound The round of the league.
     * @param int $homeTeamId The id of the home team.
     * @param string $homeTeamName The name of the home team.
     * @param string $homeTeamLogo The URL of the home team's logo.
     * @param int $awayTeamId The id of the away team.
     * @param string $awayTeamName The name of the away team.
     * @param string $awayTeamLogo The URL of the away team's logo.
     * @param ?string $referee The referee of the fixture.
     * @param string $timezone The timezone of the fixture.
     * @param string $fixtureDate The date and time of the fixture.
     * @param int $fixtureTimestamp The timestamp of the fixture.
     * @param ?int $venueId The id of the venue.
     * @param string $venueName The name of the venue.
     * @param string $venueCity The city of the venue.
     * @param string $statusLong The status long of the fixture.
     * @param string $statusShort The status short of the fixture.
     * @param ?int $statusElapsed The elapsed time of the fixture.
     * @param ?int $goalsHome The number of goals scored by the home team.
     * @param ?int $goalsAway The number of goals scored by the away team.
     * @param ?int $scoreHalftimeHome The number of goals scored by the home team at halftime.
     * @param ?int $scoreHalftimeAway The number of goals scored by the away team at halftime.
     * @param ?int $scoreFulltimeHome The number of goals scored by the home team at full time.
     * @param ?int $scoreFulltimeAway The number of goals scored by the away team at full time.
     * @param ?int $scoreExtratimeHome The number of goals scored by the home team in extra time.
     * @param ?int $scoreExtratimeAway The number of goals scored by the away team in extra time.
     * @param ?int $scorePenaltyHome The number of penalty goals scored by the home team.
     * @param ?int $scorePenaltyAway The number of penalty goals scored by the away team.
     */
    public function __construct(
        int $fixtureId,
        int $leagueId,
        string $leagueName,
        string $leagueCountry,
        string $leagueLogo,
        string $leagueRound,
        int $homeTeamId,
        string $homeTeamName,
        string $homeTeamLogo,
        int $awayTeamId,
        string $awayTeamName,
        string $awayTeamLogo,
        ?string $referee,
        string $timezone,
        string $fixtureDate,
        int $fixtureTimestamp,
        ?int $venueId,
        string $venueName,
        string $venueCity,
        string $statusLong,
        string $statusShort,
        ?int $statusElapsed,
        ?int $goalsHome,
        ?int $goalsAway,
        ?int $scoreHalftimeHome,
        ?int $scoreHalftimeAway,
        ?int $scoreFulltimeHome,
        ?int $scoreFulltimeAway,
        ?int $scoreExtratimeHome,
        ?int $scoreExtratimeAway,
        ?int $scorePenaltyHome,
        ?int $scorePenaltyAway
    ) {
        $this->fixtureId = $fixtureId;
        $this->leagueId = $leagueId;
        $this->leagueName = $leagueName;
        $this->leagueCountry = $leagueCountry;
        $this->leagueLogo = $leagueLogo;
        $this->leagueRound = $leagueRound;
        $this->homeTeamId = $homeTeamId;
        $this->homeTeamName = $homeTeamName;
        $this->homeTeamLogo = $homeTeamLogo;
        $this->awayTeamId = $awayTeamId;
        $this->awayTeamName = $awayTeamName;
        $this->awayTeamLogo = $awayTeamLogo;
        $this->referee = $referee;
        $this->timezone = $timezone;
        $this->fixtureDate = $fixtureDate;
        $this->fixtureTimestamp = $fixtureTimestamp;
        $this->venueId = $venueId;
        $this->venueName = $venueName;
        $this->venueCity = $venueCity;
        $this->statusLong = $statusLong;
        $this->statusShort = $statusShort;
        $this->statusElapsed = $statusElapsed;
        $this->goalsHome = $goalsHome;
        $this->goalsAway = $goalsAway;
        $this->scoreHalftimeHome = $scoreHalftimeHome;
        $this->scoreHalftimeAway = $scoreHalftimeAway;
        $this->scoreFulltimeHome = $scoreFulltimeHome;
        $this->scoreFulltimeAway = $scoreFulltimeAway;
        $this->scoreExtratimeHome = $scoreExtratimeHome;
        $this->scoreExtratimeAway = $scoreExtratimeAway;
        $this->scorePenaltyHome = $scorePenaltyHome;
        $this->scorePenaltyAway = $scorePenaltyAway;
    }

    /**
     * Get the id of the fixture.
     *
     * @return int The id of the fixture.
     */
    public function getFixtureId(): int
    {
        return $this->fixtureId;
    }

    /**
     * Get the id of the league.
     *
     * @return int The id of the league.
     */
    public function getLeagueId(): int
    {
        return $this->leagueId;
    }

    /**
     * Get the name of the league.
     *
     * @return string The name of the league.
     */
    public function getLeagueName(): string
    {
        return $this->leagueName;
    }

    /**
     * Get the country of the league.
     *
     * @return string The country of the league.
     */
    public function getLeagueCountry(): string
    {
        return $this->leagueCountry;
    }

    /**
     * Get the URL of the league's logo.
     *
     * @return string The URL of the league's logo.
     */
    public function getLeagueLogo(): string
    {
        return $this->leagueLogo;
    }

    /**
     * Get the round of the league.
     *
     * @return string The round of the league.
     */
    public function getLeagueRound(): string
    {
        return $this->leagueRound;
    }

    /**
     * Get the id of the home team.
     *
     * @return int The id of the home team.
     */
    public function getHomeTeamId(): int
    {
        return $this->homeTeamId;
    }

    /**
     * Get the name of the home team.
     *
     * @return string The name of the home team.
     */
    public function getHomeTeamName(): string
    {
        return $this->homeTeamName;
    }

    /**
     * Get the URL of the home team's logo.
     *
     * @return string The URL of the home team's logo.
     */
    public function getHomeTeamLogo(): string
    {
        return $this->homeTeamLogo;
    }

    /**
     * Get the id of the away team.
     *
     * @return int The id of the away team.
     */
    public function getAwayTeamId(): int
    {
        return $this->awayTeamId;
    }

    /**
     * Get the name of the away team.
     *
     * @return string The name of the away team.
     */
    public function getAwayTeamName(): string
    {
        return $this->awayTeamName;
    }

    /**
     * Get the URL of the away team's logo.
     *
     * @return string The URL of the away team's logo.
     */
    public function getAwayTeamLogo(): string
    {
        return $this->awayTeamLogo;
    }

    /**
     * Get the referee of the fixture.
     *
     * @return string The referee of the fixture.
     */
    public function getReferee(): ?string
    {
        return $this->referee;
    }

    /**
     * Get the timezone of the fixture.
     *
     * @return string The timezone of the fixture.
     */
    public function getTimezone(): string
    {
        return $this->timezone;
    }

    /**
     * Get the date and time of the fixture.
     *
     * @return string The date and time of the fixture.
     */
    public function getFixtureDate(): string
    {
        return $this->fixtureDate;
    }

    /**
     * Get the timestamp of the fixture.
     *
     * @return int The timestamp of the fixture.
     */
    public function getFixtureTimestamp(): int
    {
        return $this->fixtureTimestamp;
    }

    /**
     * Get the id of the venue.
     *
     * @return int The id of the venue.
     */
    public function getVenueId(): ?int
    {
        return $this->venueId;
    }

    /**
     * Get the name of the venue.
     *
     * @return string The name of the venue.
     */
    public function getVenueName(): string
    {
        return $this->venueName;
    }

    /**
     * Get the city of the venue.
     *
     * @return string The city of the venue.
     */
    public function getVenueCity(): string
    {
        return $this->venueCity;
    }

    /**
     * Get the status long of the fixture.
     *
     * @return string The status long of the fixture.
     */
    public function getStatusLong(): string
    {
        return $this->statusLong;
    }

    /**
     * Get the status short of the fixture.
     *
     * @return string The status short of the fixture.
     */
    public function getStatusShort(): string
    {
        return $this->statusShort;
    }

    /**
     * Get the elapsed time of the fixture.
     *
     * @return int The elapsed time of the fixture.
     */
    public function getStatusElapsed(): ?int
    {
        return $this->statusElapsed;
    }

    /**
     * Get the number of goals scored by the home team.
     *
     * @return int The number of goals scored by the home team.
     */
    public function getGoalsHome(): ?int
    {
        return $this->goalsHome;
    }

    /**
     * Get the number of goals scored by the away team.
     *
     * @return int The number of goals scored by the away team.
     */
    public function getGoalsAway(): ?int
    {
        return $this->goalsAway;
    }

    /**
     * Get the number of goals scored by the home team at halftime.
     *
     * @return int The number of goals scored by the home team at halftime.
     */
    public function getScoreHalftimeHome(): ?int
    {
        return $this->scoreHalftimeHome;
    }

    /**
     * Get the number of goals scored by the away team at halftime.
     *
     * @return int The number of goals scored by the away team at halftime.
     */
    public function getScoreHalftimeAway(): ?int
    {
        return $this->scoreHalftimeAway;
    }

    /**
     * Get the number of goals scored by the home team at full time.
     *
     * @return int The number of goals scored by the home team at full time.
     */
    public function getScoreFulltimeHome(): ?int
    {
        return $this->scoreFulltimeHome;
    }

    /**
     * Get the number of goals scored by the away team at full time.
     *
     * @return int The number of goals scored by the away team at full time.
     */
    public function getScoreFulltimeAway(): ?int
    {
        return $this->scoreFulltimeAway;
    }

    /**
     * Get the number of goals scored by the home team in extra time.
     *
     * @return int The number of goals scored by the home team in extra time.
     */
    public function getScoreExtratimeHome(): ?int
    {
        return $this->scoreExtratimeHome;
    }

    /**
     * Get the number of goals scored by the away team in extra time.
     *
     * @return int The number of goals scored by the away team in extra time.
     */
    public function getScoreExtratimeAway(): ?int
    {
        return $this->scoreExtratimeAway;
    }

    /**
     * Get the number of penalty goals scored by the home team.
     *
     * @return int The number of penalty goals scored by the home team.
     */
    public function getScorePenaltyHome(): ?int
    {
        return $this->scorePenaltyHome;
    }

    /**
     * Get the number of penalty goals scored by the away team.
     *
     * @return int The number of penalty goals scored by the away team.
     */
    public function getScorePenaltyAway(): ?int
    {
        return $this->scorePenaltyAway;
    }
}
