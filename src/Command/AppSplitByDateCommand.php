<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

#[\Symfony\Component\Console\Attribute\AsCommand('app:split-by-date')]
class AppSplitByDateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Move photos to date-based directories')
            ->addArgument('source', InputArgument::OPTIONAL, 'Source file', '.')
            ->addOption('recursive', 'r', InputOption::VALUE_NONE, 'Recurse through subdirectories')
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $source = $input->getArgument('source');

        $finder = new Finder();
        /** @var \SplFileInfo $file */
        foreach ($finder->in($source) as $file) {
            if ($file->isDir()) {
            } else {
                // get the exif date
                $io->write($file->getRealPath(), false);
                $ext = strtolower($file->getExtension());
                try {
                    if (in_array($ext, ['jpg', 'jpeg']) ) {

                        $exif = exif_read_data($file->getRealPath());
                        $dateTaken = new \DateTime($exif[\DateTime::class]);
                    } elseif (in_array($ext, ['raw', 'cr2','raf'])) {
                        try {
                            $im = new \Imagick($file->getRealPath());


                            $imInfo = $im->identifyImage(false);
                            dump($imInfo); die('stopped');
                        } catch (\Exception $e) {
                            $io->warning("ImageMagick didn't work, trying exif again");

                            $exif = exif_read_data($file->getRealPath());
                            $dateTaken = new \DateTime($exif[\DateTime::class]);

                        }
                    } else {
                        $io->warning('Skipping...');
                        continue;
                    }
                    $dir = $dateTaken->format('Y/m/d');
                    $io->write("Moving to $dir");


                } catch (\Exception $e) {
                    $io->error($file->getRealPath() . ' error: ' . $e->getMessage());
                }
                $io->write('.', true);
            }
        }



        $io->success('Finished.');
    }
}
