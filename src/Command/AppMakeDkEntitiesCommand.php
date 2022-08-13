<?php

namespace App\Command;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AppMakeDkEntitiesCommand extends ContainerAwareCommand
{
    private ?\Symfony\Component\Console\Style\SymfonyStyle $io = null;
    protected static $defaultName = 'app:make-dk-entities';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('sqlFile', InputArgument::OPTIONAL, 'SQL Dump', 'digikam4.db.sql')
            ->addArgument('odsFile', InputArgument::OPTIONAL, 'Spreadsheet', 'DBSCHEMA.ODS')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    private function renderTemplate($template, Array $args, $outputPath) {
        $twig = $this->getContainer()->get('twig');
        /*
         * [
            'table' => $table,
            'tableName' => $tableName
        ]
         */
        $renderedContent = $twig->render($template, $args);
        $outputFile = sprintf("%s/%s",
            $this->getContainer()->get('kernel')->getRootDir(),
            $outputPath);
        $this->io->write($renderedContent);
        if (preg_match('/php/', $outputFile)) {
            $renderedContent = '<?' . $renderedContent;
        }
        file_put_contents($outputFile, $renderedContent);
        $this->io->writeln("$outputFile written.");

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $sqlFile =  $input->getArgument('sqlFile');

        if (0) {
            $odsFile = $input->getArgument('odsFile');
            if (!file_exists($odsFile)) {
                $io->error("File $odsFile doesn't exit");
            }

            /** @var IReader $reader */
            $reader = IOFactory::createReader('Ods');
            $reader->setReadDataOnly(TRUE);

            /** @var Spreadsheet $spreadsheet */
            $spreadsheet = $reader->load($odsFile);

            foreach ($spreadsheet->getSheetNames() as $sheetName) {

                $io->writeln("Reading $odsFile: $sheetName");
                $sheet = $spreadsheet->getSheetByName($sheetName);
                $this->processSheet($sheet);
            }
        }

        $this->io = $io;
        if (!file_exists($sqlFile)) {
            $io->error("File $sqlFile doesn't exit");
        }
        $tables = $this->parseSql($sqlFile);

        foreach ($tables as $tableName => $table) {
            $io->writeln(sprintf("$tableName (%s properties", is_countable($table['props']) ? count($table['props']) : 0));
            /*
            $this->renderTemplate('entity.php.twig', ['tableName' => $tableName, 'table' => $table], "Entity/$tableName.php");
            $this->renderTemplate('repository.php.twig', $tableName, $table, "Repository/${tableName}Repository.php");
            */
        }
        $yaml = $this->renderTemplate('easy_admin.yaml.twig', [
            'tables' => array_filter($tables, function ($table) {
                foreach ($table['props'] as $id=>$prop) {
                    if ($prop['id']) {
                        return $table;
                    }
                }
                return false;
            })
        ], "../config/packages/easy_admin.yaml");

        $io->success(sprintf('%s entities created.', is_countable($tables) ? count($tables) : 0));
    }

    private function processSheet(Worksheet $worksheet)
    {
$inTable = null;
        $property = [];
        $tables = [];
        $propertyName = null;
        // Get the highest row and column numbers referenced in the worksheet
        $tableName = '';
        $highestRow = $worksheet->getHighestRow(); // e.g. 10
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

        $headers = [
            'name',
            'type',
            'description',
            'read_from',
            'write_to',
            'changed_by'
        ];

        for ($row = 1; $row <= $highestRow; ++$row) {
            $firstValue = trim((string) $worksheet->getCellByColumnAndRow(1, $row)->getValue());
            $inRowHeader = ($firstValue == 'NAME');
            if ($inRowHeader) {
                $inTable = true;
                continue;
            }

            if (preg_match('/Table « (.*?) »/', $firstValue, $m)) {
                $tableName = $m[1];
                continue;
            }

            if ($firstValue === '') {
                $inTable = false;
            }

            for ($col = 1; $col <= $highestColumnIndex; ++$col) {
                $value = trim((string) $worksheet->getCellByColumnAndRow($col, $row)->getValue());
                if ($inTable) {
                    if ($col == 1) {
                        $propertyName = $value;
                    }
                        $property[$headers[$col-1]] = $value;
                }
                if ($value === '') {
                    continue;
                }

                printf("%s %d.%d %s\n", $tableName, $row, $col, $value);
            }
            if ($inTable) {
                $tables[$tableName][$propertyName] = $property;
            }
        }

        dump($tables);
    }

    public function parseSql($filename) {
        $sql = file_get_contents($filename);
        //  \((.*)\)
        $statements = explode(";\n", $sql);
        $tables = [];
        foreach ($statements as $statement) {
            dump($statement);
            if (preg_match('/CREATE TABLE (\S*)\n\s*\((.*)\)/ms', $statement, $m)) {
                $tableName = $m[1];
                $props = explode(",\n", (string) $m[2]);
                $p = [];
                foreach ($props as $prop) {
                    $prop = trim($prop);
                    if (preg_match('/^(UNIQUE)/', $prop)) {
                        // handle unique

                    } else {
                        // properties
                        [$name, $type] = explode(' ', $prop);
                        $name = trim($name);
                        $p[] = [
                            'name' => $name,
                            'type' => $type,
                            'id' => preg_match('/PRIMARY KEY/', $prop)
                        ];
                    }
                }
                $tables[$tableName] = [
                    'name' => $tableName,
                    'sql' => $statement,
                    'props' => $p
                ];

            } else {
                // dump($statement);
            }
        }
        return $tables;

    }
}
