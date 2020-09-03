<?php

namespace Navitronic\BehatKite\Controller;

use Behat\Gherkin\Gherkin;
use Behat\Testwork\Cli\Controller;
use Navitronic\BehatKite\Filter\BehatKiteFilter;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class BehatKiteController implements Controller
{
    private $gherkin;

    public function __construct(Gherkin $gherkin)
    {
        $this->gherkin = $gherkin;
    }

    public function configure(SymfonyCommand $command)
    {
        $command->addOption(
            'buildkite',
            null,
            InputOption::VALUE_OPTIONAL,
            'Use Buildkite environment to filter tests',
            false
        );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption('buildkite') !== false) {
            $this->gherkin->addFilter(new BehatKiteFilter());
        }
    }

}