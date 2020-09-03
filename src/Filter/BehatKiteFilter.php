<?php

namespace Navitronic\BehatKite\Filter;

use Behat\Gherkin\Filter\SimpleFilter;
use Behat\Gherkin\Node\FeatureNode;
use Behat\Gherkin\Node\ScenarioInterface;

class BehatKiteFilter extends SimpleFilter
{
    private $featureCount = 0;
    private $jobCount;
    private $job;

    public function __construct()
    {
        $this->featureCount = 0;
        $this->jobCount = (int) getenv('BUILDKITE_PARALLEL_JOB_COUNT') ?: 1;
        $this->job = (int) getenv('BUILDKITE_PARALLEL_JOB') ?: 0;
    }

    public function isFeatureMatch(FeatureNode $feature)
    {
        $isMatch = $this->featureCount % $this->jobCount === $this->job;
        $this->featureCount++;

        return $isMatch;
    }

    public function isScenarioMatch(ScenarioInterface $scenario)
    {
        return true;
    }
}