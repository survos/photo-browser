<?php

namespace App\Command;

use Rezzza\Flickr\ApiFactory;
use Rezzza\Flickr\Http\GuzzleAdapter;
use Rezzza\Flickr\Metadata;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class FlickrAlbumsCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'flickr:albums';

    /** @var ApiFactory */
    private $apiFactory;

    public function __construct(?string $name = null)
    {
        parent::__construct($name);
    }


    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // can't figure out the bundle :-(

        $c = $this->getContainer();
        $metadata = new Metadata($c->getParameter('rezzza_flickr_key'), $c->getParameter('rezzza_flickr_secret'));

        $metadata->setOauthAccess($c->getParameter('flickr_token'), $c->getParameter('flickr_token_secret'));

        $io = new SymfonyStyle($input, $output);
        // $this->apiFactory = $this->getContainer()->get('rezzza.flickr.client');

         // $client = $this->getContainer()->get('rezzza.flickr.client');
#        $this->apiFactory = $this->getContainer()->get(ApiFactory::class);
#        dump($this->apiFactory->getMetadata());


        // env vars?

#        $this->apiFactory->getMetadata()->setOauthAccess('access token', 'access token secret');
        // $factory = $this->apiFactory;
        dump($metadata);
        $adaptor = new GuzzleAdapter();
        $apiFactory = $factory = new ApiFactory($metadata, $adaptor);

        $xml = $factory->call('flickr.test.login');
dump($xml);

        $xml = $apiFactory->call('flickr.photosets.getList');
        /**
         * @var int $n
         * @var \SimpleXMLElement $photoset
         */
        foreach ($xml->photosets->photoset as $n => $photoset) {
            dump($photoset);
            $id = (int)$photoset->attributes()->id;
            $photosetsTitles[$id] = (string)$photoset->title;
        }
        asort($photosetsTitles);
        dump($photosetsTitles);
        die("Stop");


$xml = $factory->call('flickr.photos.getInfo', array(
    'photo_id' => 1337,
));
        dump($xml);

        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }
}
