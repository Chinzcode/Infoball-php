<?php

namespace Infoball\util\PHP\Standing;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

/**
 * Class Standing
 */
class Standing
{
    protected int $rank;
    protected int $teamId;
    protected string $name;
    protected string $logo;
    protected int $points;
    protected int $goalsDiff;
    protected string $form;
    protected int $played;
    protected int $win;
    protected int $draw;
    protected int $lose;
    protected int $goalsFor;
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
