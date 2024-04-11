<?php

namespace Infoball\classes\Entity\Standing;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class Standing
 */
class Standing
{
    /**
     * @var int The rank or standing of the team.
     */
    protected int $rank;

    /**
     * @var int The id of the team.
     */
    protected int $teamId;

    /**
     * @var string The name of the team.
     */
    protected string $name;

    /**
     * @var string The URL or path to the team's logo.
     */
    protected string $logo;

    /**
     * @var int The total points earned by the team.
     */
    protected int $points;

    /**
     * @var int The goal difference (goals scored minus goals conceded) of the team.
     */
    protected int $goalsDiff;

    /**
     * @var string The recent form of the team (e.g., WWDDL).
     */
    protected string $form;

    /**
     * @var int The total number of matches played by the team.
     */
    protected int $played;

    /**
     * @var int The total number of matches won by the team.
     */
    protected int $win;

    /**
     * @var int The total number of matches drawn by the team.
     */
    protected int $draw;

    /**
     * @var int The total number of matches lost by the team.
     */
    protected int $lose;

    /**
     * @var int The total number of goals scored by the team.
     */
    protected int $goalsFor;

    /**
     * @var int The total number of goals conceded by the team.
     */
    protected int $goalsAgainst;

    /**
      * Constructor.
      *
      * @param int $rank The rank of the Standing.
      * @param int $teamId The teamId of the Standing.
      * @param string $name The name of the Standing.
      * @param string $logo The logo of the Standing.
      * @param int $points The points of the Standing.
      * @param int $goalsDiff The goals difference of the Standing.
      * @param string $form The form of the Standing.
      * @param int $played The number of games played by the Standing.
      * @param int $win The number of games won by the Standing.
      * @param int $draw The number of games drawn by the Standing.
      * @param int $lose The number of games lost by the Standing.
      * @param int $goalsFor The number of goals scored by the Standing.
      * @param int $goalsAgainst The number of goals conceded by the Standing.
      */
    public function __construct(
        int $rank,
        int $teamId,
        string $name,
        string $logo,
        int $points,
        int $goalsDiff,
        string $form,
        int $played,
        int $win,
        int $draw,
        int $lose,
        int $goalsFor,
        int $goalsAgainst
    ) {
        $this->rank = $rank;
        $this->teamId = $teamId;
        $this->name = $name;
        $this->logo = $logo;
        $this->points = $points;
        $this->goalsDiff = $goalsDiff;
        $this->form = $form;
        $this->played = $played;
        $this->win = $win;
        $this->draw = $draw;
        $this->lose = $lose;
        $this->goalsFor = $goalsFor;
        $this->goalsAgainst = $goalsAgainst;
    }

    /**
     * Get the rank of the Standing.
     *
     * @return int The rank of the Standing.
     */
    public function getRank(): int
    {
        return $this->rank;
    }

    /**
     * Get the teamId of the Standing.
     *
     * @return int The teamId of the Standing.
     */
    public function getId(): int
    {
        return $this->teamId;
    }

    /**
     * Get the name of the Standing.
     *
     * @return string The name of the Standing.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the logo of the Standing.
     *
     * @return string The logo of the Standing.
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * Get the points of the Standing.
     *
     * @return int The points of the Standing.
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * Get the goals difference of the Standing.
     *
     * @return int The goals difference of the Standing.
     */
    public function getGoalsDiff(): int
    {
        return $this->goalsDiff;
    }

    /**
     * Get the form of the Standing.
     *
     * @return string The form of the Standing.
     */
    public function getForm(): string
    {
        return $this->form;
    }

    /**
     * Get the number of games played by the Standing.
     *
     * @return int The number of games played by the Standing.
     */
    public function getPlayed(): int
    {
        return $this->played;
    }

    /**
     * Get the number of games won by the Standing.
     *
     * @return int The number of games won by the Standing.
     */
    public function getWin(): int
    {
        return $this->win;
    }

    /**
     * Get the number of games drawn by the Standing.
     *
     * @return int The number of games drawn by the Standing.
     */
    public function getDraw(): int
    {
        return $this->draw;
    }

    /**
     * Get the number of games lost by the Standing.
     *
     * @return int The number of games lost by the Standing.
     */
    public function getLose(): int
    {
        return $this->lose;
    }

    /**
     * Get the number of goals scored by the Standing.
     *
     * @return int The number of goals scored by the Standing.
     */
    public function getGoalsFor(): int
    {
        return $this->goalsFor;
    }

    /**
     * Get the number of goals conceded by the Standing.
     *
     * @return int The number of goals conceded by the Standing.
     */
    public function getGoalsAgainst(): int
    {
        return $this->goalsAgainst;
    }
}
