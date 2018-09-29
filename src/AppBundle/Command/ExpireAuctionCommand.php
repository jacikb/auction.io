<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jacik2
 * Date: 29.09.18
 * Time: 12:22
 * To change this template use File | Settings | File Templates.
 */

namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExpireAuctionCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName("app:expire_auction")
            ->setDescription("Komenda do wygaszania aukcji")
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $entityManager = $this->getContainer()->get("doctrine.orm.entity_manager");

    }
}