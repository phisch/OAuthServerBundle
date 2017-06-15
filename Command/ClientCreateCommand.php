<?php

namespace Phisch\OAuthServerBundle\Command;

use Phisch\OAuthServerBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ClientCreateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('phisch:oauth:client:create')
            ->setDescription('Creates an oauth client.')
            ->setHelp('This command creates and stores an oauth client in the database.')
            ->addOption('redirect_uris', 'r',InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, 'The redirect_uris used by some grant_types.', [])
            ->addOption('grant_types', 'g', InputOption::VALUE_IS_ARRAY | InputOption::VALUE_OPTIONAL, 'The allowed grant_types for this client.', [])
            ->addOption('client_id', 'i', InputOption::VALUE_OPTIONAL, 'The client_id, will be generated if not provided.')
            ->addOption('client_secret', 's', InputOption::VALUE_OPTIONAL, 'The client secret, will be generated if not provided.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client();

        if ($clientId = $input->getOption('client_id')) {
            $client->setClientId($clientId);
        }

        if ($secret = $input->getOption('client_secret')) {
            $client->setSecret($secret);
        }

        if ($grantTypes = $input->getOption('grant_types')) {
            $client->setGrantTypes($grantTypes);
        }

        if ($redirectUris = $input->getOption('redirect_uris')) {
            $client->setRedirectUris($redirectUris);
        }

        $entityManager = $this->getContainer()->get('doctrine.orm.default_entity_manager');
        $entityManager->persist($client);
        $entityManager->flush();

        $style = new SymfonyStyle($input, $output);

        $table = new Table($style);
        $table->setHeaders(
            [
                'id',
                'client_id',
                'client_secret',
                'grant_types',
                'redirect_uris'
            ]
        );
        $table->addRow(
            [
                $client->getId(),
                $client->getClientId(),
                $client->getSecret(),
                implode(', ', $client->getGrantTypes()),
                implode(', ', $client->getRedirectUris())
            ]
        );

        $style->success('Client successfully created:');
        $table->render();
        return null;
    }
}
