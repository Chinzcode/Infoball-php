<?php

namespace Infoball\util\PHP\ConsoleCommand;

use Infoball\classes\DataUpdater\DataUpdater;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'syncApiData',
    description: 'sync data from api in db',
    hidden: false,
    aliases: ['app:syncApiData']
)]
class SyncApiDataCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $url = [
            $standings = 'https://v3.football.api-sports.io/standings',
            $topscorers = 'https://v3.football.api-sports.io/players/topscorers',
            $topassists = 'https://v3.football.api-sports.io/players/topassists',
            $topyellowcards = 'https://v3.football.api-sports.io/players/topyellowcards',
            $topredcards = 'https://v3.football.api-sports.io/players/topredcards',
            $fixtures = 'https://v3.football.api-sports.io/fixtures',
        ];

        $season = [
            $year = 2023,
            $startDate = '2023-08-11',
            $endDate = '2024-05-19',
        ];

        $league = 39;

        $updateData = new DataUpdater($url.$standings);
        $updateData->updateStandingsData($league, $season.$year);

        $updateData = new DataUpdater($url.$topscorers);
        $updateData->updatePlayerstatsData($league, $season.$year, 'topscorer');

        $updateData = new DataUpdater($url.$topassists);
        $updateData->updatePlayerstatsData($league, $season.$year, 'topassists');

        $updateData = new DataUpdater($url.$topyellowcards);
        $updateData->updatePlayerstatsData($league, $season.$year, 'topyellowcards');

        $updateData = new DataUpdater($url.$topredcards);
        $updateData->updatePlayerstatsData($league, $season.$year, 'topredcards');

        $updateData = new DataUpdater($url.$fixtures);
        $updateData->updateFixturesData($league, $season.$year, 'allFixtures', $season.$startDate, $season.$endDate);

        $output->writeln([
            '',
            'Command executed!',
            '=================',
        ]);

        return Command::SUCCESS;
    }
}
