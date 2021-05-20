<?php

declare(strict_types=1);

namespace App\User\Command;

use App\User\Entity\User;
use App\User\User\UserManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateUserCommand extends Command
{
    /**
     * {@inheritDoc}
     */
    protected static $defaultName = 'app:user:register';

    public function __construct(private ValidatorInterface $validator, private UserManager $userManager)
    {
        parent::__construct();
    }

    /**
     * {@inheritDoc}
     */
    protected function configure(): void
    {
        $this->setDescription('Registers a user with the given details.')
            ->addArgument('username', InputArgument::REQUIRED);
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $username = $input->getArgument('username');
        $password = $io->askHidden('Please provide a password for the user');

        $user = new User($username, $password);

        $violations = $this->validator->validate($user);
        if (0 !== \count($violations)) {
            $io->error((string) $violations);

            return self::FAILURE;
        }

        $this->userManager->create($user);

        $io->success(\sprintf('Successfully created user "%s".', $username));

        return self::SUCCESS;
    }
}
