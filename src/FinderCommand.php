<?php

namespace CodeceptFinder;

use Codeception\Configuration;
use Codeception\SuiteManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * A symfony command for finding codecept test files.
 */
class FinderCommand extends Command
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->addOption(
            'config-file',
            'c',
            InputOption::VALUE_OPTIONAL,
            "The Codeception configuration file.",
            getcwd() . '/codeception.yml'
        );
        $this->addOption('bootstrap-file', 'b', InputOption::VALUE_OPTIONAL, "The tests bootstrap file.", null);
        $this->addArgument('test-suite', InputArgument::IS_ARRAY, "The test suites to scan.");
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $configFile = $input->getOption('config-file');
        $bootstrap = $input->getOption('bootstrap-file');
        if ($bootstrap) {
            include_once $bootstrap;
        }
        $testSuites = $input->getArgument('test-suite');
        $testFilenames = [];

        $dispatcher = new EventDispatcher();

        foreach ($testSuites as $testSuite) {
            $config = Configuration::config($configFile);
            $config = Configuration::suiteSettings($testSuite, $config);
            $suiteManager = new SuiteManager($dispatcher, $testSuite, $config);
            $suiteManager->initialize();
            $suiteManager->loadTests();
            $tests = $suiteManager->getSuite()->tests();

            foreach ($tests as $test) {
                $testFilenames[] = ((new \ReflectionClass($test))->getFileName());
            }
        }

        $testFilenames = array_unique($testFilenames);
        foreach ($testFilenames as $testFilename) {
            $output->writeln($testFilename);
        }
    }
}
