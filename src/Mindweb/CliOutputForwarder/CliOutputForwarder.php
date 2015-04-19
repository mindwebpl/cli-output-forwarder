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
        $this->output->writeln(str_repeat('--- ', 10));
        $this->printArray($data, 1);
    }

    /**
     * @param array $data
     * @param $level
     */
    private function printArray(array $data, $level)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->output->writeln(str_repeat("\t", $level) . '<info>' . $key . '</info>:');
                $this->printArray($value, $level + 1);
            } else {
                $this->output->writeln(str_repeat("\t", $level) . '<info>' . $key . '</info>: ' . $value);
            }
        }
    }
} 