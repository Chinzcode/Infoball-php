<?php

namespace Infoball\classes\Entity\League;

require_once $_SERVER['DOCUMENT_ROOT'].'/Infoball/config/setup.php';

/**
 * Class League
 *
 * Represents a League entity with League id, name, logo and country.
 */
class League
{
    /**
     * @var int The id of the league.
     */
    protected int $id;

    /**
     * @var string The name of the league.
     */
    protected string $name;

    /**
     * @var string The logo of the league.
     */
    protected string $logo;

    /**
     * @var string The country of the league.
     */
    protected string $country;

    /**
     * @var array The seasons of the league.
     */
    protected array $seasons;

    /**
     * Constructor.
     *
     * @param int $id The id of the league.
     * @param string $name The name of the league.
     * @param string $logo The logo of the league.
     * @param string $country The country of the league.
     */
    public function __construct(int $id, string $name, string $logo, string $country, array $seasons)
    {
        $this->id = $id;
        $this->name = $name;
        $this->logo = $logo;
        $this->country = $country;
        $this->seasons = $seasons;
    }

    /**
     * Get the id of the league.
     *
     * @return int The id of the league.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get the name of the league.
     *
     * @return string The name of the league.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the logo of the league.
     *
     * @return string The logo of the league.
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * Get the country of the league.
     *
     * @return string The country of the league.
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Get the seasons of the league.
     *
     * @return array The seasons of the league.
     */
    public function getSeasons(): array
    {
        return $this->seasons;
    }
}
