<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Panther\Client;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'seo:check-links',
    description: 'Vérifiez les liens morts ou les redirections du site'
)]
class CheckLinksCommand extends Command
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        parent::__construct();
        $this->httpClient = $httpClient;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Créez une instance du client Chrome
        $client = Client::createChromeClient();

        $toVisit = ['http://127.0.0.1:8000/'];
        $visited = [];
        $deadLinks = [];

        $baseDomain = parse_url('http://127.0.0.1:8000/', PHP_URL_HOST); // Ajouté pour obtenir le domaine de base
        if ($baseDomain === false) {
            // Handle error
            return Command::FAILURE;
        }

        $totalLinksDetected = 1;
        $totalLinksScanned = 0;

        $progressBar = new ProgressBar($output, $totalLinksDetected);
        $progressBar->setFormat('%current%/%max% [%bar%] %percent:3s%%');

        while (!empty($toVisit)) {
            $url = array_shift($toVisit);

            if (in_array($url, $visited)) {
                continue;
            }

            $visited[] = $url;

            try {
                $crawler = $client->request('GET', $url);
                $linksOnPage = $crawler->filter('a')->links();

                foreach ($linksOnPage as $link) {
                    $linkUrl = $link->getUri();
                    $parsedUrl = parse_url($linkUrl);
                    if ($parsedUrl === false || !isset($parsedUrl['scheme'], $parsedUrl['host'], $parsedUrl['path'])) {
                        // Handle error
                        continue;
                    }
                    $cleanUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $parsedUrl['path'];
                    // Ignorer les URLs externes
                    if ($parsedUrl['host'] !== $baseDomain) {
                        continue;
                    }

                    // Évitez les liens JavaScript et les liens incorrects
                    if (strpos($cleanUrl, 'javascript:') === 0 || strpos($cleanUrl, 'www.www.') !== false) {
                        $io->warning("Lien incorrect détecté : $cleanUrl (Trouvé sur : $url)");
                        continue;
                    }

                    if (!in_array($cleanUrl, $visited) && !in_array($cleanUrl, $toVisit)) {
                        $toVisit[] = $cleanUrl;
                        $totalLinksDetected++; // Un nouveau lien détecté
                    }
                }

                $response = $this->httpClient->request('GET', $url);
                $statusCode = $response->getStatusCode();

                if ($statusCode >= 300 && $statusCode < 400) {
                    $io->warning("Redirection détectée pour le lien: $url (Trouvé sur : $url)");
                } elseif ($statusCode >= 400) {
                    $io->error("Lien mort détecté $url (Trouvé sur : $url)");
                    $deadLinks[] = $url;
                }
            } catch (\Exception $e) {
                $io->error('Erreur pour le lien ' . $url . ' : ' . $e->getMessage() . ' (Trouvé sur : ' . $url . ')');
                $deadLinks[] = $url;
            }

            $totalLinksScanned++;
            $progressBar->setMaxSteps($totalLinksDetected);
            $progressBar->setProgress($totalLinksScanned);
        }

        $io->newLine(2);

        $analyzedCount = count($visited);
        $io->success("Vérification des liens terminée. $analyzedCount liens ont été analysés.");

        if (!empty($deadLinks)) {
            $io->section("Liste des liens morts détectés:");
            foreach ($deadLinks as $deadLink) {
                $io->listing([$deadLink]);
            }
        }

        return Command::SUCCESS;
    }
}
