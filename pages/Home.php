<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Infoball\classes\Base\Base;

/**
 * Class Home
 *
 * Represents the home page of the website.
 */
class Home extends Base
{
    /**
     * Constructs a new Home object.
     */
    public function __construct()
    {
        parent::__construct();

        // Render the home page.
        if (isset($_SESSION["userId"])) {
            echo $this->render("/classes/Home/Home.html.twig", [
                "title" => $this->getTitle(),
            ]);
        } else {
            header("Location: /pages/Login.php");
        }
    }

    /**
     * Get the title for the home page.
     *
     * @return string The title of the home page.
     */
    private function getTitle()
    {
        return "Home";
    }
}

new Home();
