<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Zenstruck\Console\Attribute\Argument;
use Zenstruck\Console\Attribute\Option;
use Zenstruck\Console\ConfigureWithAttributes;
use Zenstruck\Console\InvokableServiceCommand;
use Zenstruck\Console\IO;
use Zenstruck\Console\RunsCommands;
use Zenstruck\Console\RunsProcesses;

#[AsCommand('app:sqlite-to-doctrine', 'convert sqlite database to doctrine entities (reverse engineer)')]
final class AppSqliteToDoctrineCommand extends InvokableServiceCommand
{
    use RunsCommands;
    use RunsProcesses;

    public function __invoke(
        IO $io,
        #[Argument(description: 'filename of the sqlite database')]
        string $filename = '',

        #[Option(description: 'overwrite existing src/Entities classes')]
        bool $force = true,
    ): void {
        $this->parseSql($filename);
        $io->success('app:sqlite-to-doctrine success.');
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
