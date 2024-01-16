<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class RebootDB extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Developer';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'rebootdb';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Drop all data in tables or drop all tables';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'rebootdb';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $howToRemove = CLI::prompt('drop Tables or remove Data?', ['t', 'D']);
        CLI::newLine();

        $db = \Config\Database::connect();
        $forge = \Config\Database::forge();
        CLI::write(CLI::color("Connecting to DB...", 'green'));

        $tables = $db->listTables();

        foreach ($tables as $table) {
            if ($howToRemove == 't') {
                $forge->dropTable($table);
                CLI::write('Drop table: ' . CLI::color($table, 'green'));
            } elseif ($howToRemove == 'D') {
                $db->table($table)->emptyTable();
                CLI::write('Empty table: ' . CLI::color($table, 'green'));
            }
        }

        if ($howToRemove == 't') {

            CLI::newLine();
            $migrate = CLI::prompt('Would you like to migrate DB?', ['y', 'n']);

            if ($migrate == 'y') {
                echo command('migrate');
            }
        }

        if (class_exists('App\Database\Seeds\Install')){
            CLI::newLine();
            $fillData = CLI::prompt('Would you like to populate data. Execute seeder install?', ['y', 'n']);
           
            if ($migrate == 'y')
            echo command('db:seed install');
        } else {
            CLI::newLine();
            CLI::write(CLI::color('Install seeder not exists.', 'yellow'));
           
            CLI::newLine();
            $executeSeeders = CLI::prompt('Would you like to execute seeders?', ['y', 'n']);
            if ($executeSeeders == 'y')
                $this->executeSeeders();
        }
    }

    public function executeSeeders()
    {
       
        $files = new \CodeIgniter\Files\FileCollection();

        $files->addDirectory(APPPATH . 'Database/Seeds');
        $files->removePattern('#^\.#');


        foreach ($files as $file) {
            $seeder=$file->getBasename('.' . $file->getExtension());
            if ($seeder!="Install")
                echo command('db:seed ' . $seeder );
        }
    }

}