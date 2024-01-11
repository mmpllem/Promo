<?php

namespace App\Shared\Infrastructure\Command;

use App\Shared\Infrastructure\Elasticsearch\Factory\ClientFactory;
use App\Shared\Infrastructure\Elasticsearch\Index\Indexes;
use App\Shared\Infrastructure\Elasticsearch\Mapping\Mapping;
use App\Shared\Infrastructure\Elasticsearch\Mapping\MappingCollection;
use App\Shared\Infrastructure\Elasticsearch\Mapping\MappingLoader;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'elastic:index:check',
    description: 'Проверить наличие индексов',
)]
class ElasticIndexCheckCommand extends Command
{
    private readonly Indexes $indexes;
    private MappingCollection $mappingCollection;

    public function __construct(private MappingLoader $loader, string $name = null) {
        parent::__construct($name);
        $this->mappingCollection = $this->loader->getMappings();

        $this->indexes = new Indexes(ClientFactory::create(), $this->mappingCollection);
    }

    public function configure(): void
    {
        parent::configure();

        $this->addOption('create', '-c', null, 'При отсутствии индекса - создать его');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $needCreate = $input->getOption('create');

        foreach ($this->indexes->check() as $index => $exist) {
            $exist ?  $io->info("Index \"$index\" is exist") : $io->note("Index \"$index\" not found");

            if ($needCreate && !$exist) {
                $this->indexes->create(
                    $this->mappingCollection->filter(
                        static fn(Mapping $mapping) => $mapping->getIndexName() === $index
                    )->first()
                );

                $io->info("Index \"$index\" created");
            }
        }

        return Command::SUCCESS;
    }
}
