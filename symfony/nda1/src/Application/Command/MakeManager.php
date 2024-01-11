<?php

namespace App\Application\Command;

use App\Domain\Service\RoleService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:makeManager', description: 'Создать пользователя с правами менеджера')]
class MakeManager extends Command
{
    public function __construct(
        private readonly RoleService $service
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('user-id', InputArgument::REQUIRED, 'User id');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userId = (int) $input->getArgument('user-id');
        $this->service->grantManager($userId);

        return Command::SUCCESS;
    }
}
