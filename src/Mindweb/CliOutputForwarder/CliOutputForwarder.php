<?php
namespace Mindweb\CliOutputForwarder;

use Mindweb\Forwarder;
use Symfony\Component\Console\Output\ConsoleOutput;

class CliOutputForwarder implements Forwarder\Forwarder
{
    /**
     * @var ConsoleOutput
     */
    private $output;

    /**
     * @param array $configuration
     */
    public function __construct(array $configuration = array())
    {
        $this->output = new ConsoleOutput(
            !empty($configuration['verbosity']) ? $configuration['verbosity'] : ConsoleOutput::VERBOSITY_NORMAL,
            !empty($configuration['decorated']) ? $configuration['decorated'] : null
        );
    }

    /**
     * @param array $data
     * @return array
     */
    public function forward(array $data)
    {
        $this->output->writeln($data);
    }
} 