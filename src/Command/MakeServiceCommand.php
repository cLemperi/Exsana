<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;

// Attributs pour définir la commande avec son nom et sa description.
#[AsCommand(
    name: 'app:make:service',
    description: 'Cette commande permet de créer un service'
)]
class MakeServiceCommand extends Command
{
    // Propriétés pour stocker l'environnement et le service de manipulation des fichiers.
    private $environment;
    private $filesystem;

    // Constructeur avec les dépendances injectées.
    public function __construct(string $environment, Filesystem $filesystem)
    {
        parent::__construct();

        $this->environment = $environment;
        $this->filesystem = $filesystem;
    }

    // Configuration des arguments de la commande.
    protected function configure(): void
    {
        // Note: Nous supprimons les arguments ici car ils seront demandés interactivement.
    }

    // Exécution de la commande.
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Vérification de l'environnement.
        if ($this->environment !== 'dev') {
            $output->writeln('Cette commande ne peut être exécutée que dans l\'environnement de développement.');
            return Command::FAILURE;
        }

        // Initialisation pour l'affichage des messages.
        $io = new SymfonyStyle($input, $output);

        // Demander le nom du service interactivement.
        $serviceName = $io->ask('Quel est le nom de votre service? ex: NameYourService', null, function ($name) {
            if (empty($name)) {
                throw new \RuntimeException('Le nom du service ne peut pas être vide.');
            }
            return ucfirst($name);
        });

        // Chemin complet vers le fichier service.
        $servicePath = sprintf('%s/src/Service/%s.php', $this->getProjectDir(), $serviceName);

        // Vérification si le service existe déjà.
        if ($this->filesystem->exists($servicePath)) {
            $io->error(sprintf('Le service "%s" existe déjà.', $serviceName));
            return Command::FAILURE;
        }

        // Demander les dépendances du service interactivement
        $dependenciesString = $io->ask('Listez les dépendances du service (séparez les noms par un espace). Si aucune dépendance, appuyez simplement sur Entrée.', '');
        $dependencies = $dependenciesString ? explode(' ', $dependenciesString) : [];

        // Génération du contenu du fichier service en fonction des dépendances.
        $constructorContent = '';
        $useStatements = '';
        foreach ($dependencies as $dependency) {
            $useStatements .= sprintf("use %s;\n", $dependency);
            $dependencyClass = substr($dependency, strrpos($dependency, '\\') + 1);
            $constructorContent .= sprintf("private $%s;\n\n", lcfirst($dependencyClass));
            $constructorContent .= sprintf("public function __construct(%s $%s)\n", $dependencyClass, lcfirst($dependencyClass));
            $constructorContent .= sprintf("{\n    $this->%s = $%s;\n}\n", lcfirst($dependencyClass), lcfirst($dependencyClass));
        }

        $serviceTemplate = <<<EOD
<?php

namespace App\Service;

$useStatements

class $serviceName
{
$constructorContent
}
EOD;

        $this->filesystem->dumpFile($servicePath, $serviceTemplate);
        $io->success(sprintf('Le service "%s" a été créé avec succès.', $serviceName));

        return Command::SUCCESS;
    }

    private function getProjectDir(): string
    {
        return __DIR__ . '/../../';
    }
}
