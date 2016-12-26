<?php

namespace FlatParserBundle\Command;

use FlatParserBundle\Resources\Classes\PageNotFound;
use FlatParserBundle\Resources\Classes\SourceLinks;
use FlatParserBundle\Resources\Services\Downloader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class CleanerCommand extends Command
{
  const NAME = "Remove not available flats";

  public function __construct()
  {
    parent::__construct(self::NAME);
  }

  protected function configure()
  {
    $this->setName('cleaner:run');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $rootDir = $this->getApplication()->getKernel()->getRootDir() . '/../';
    $sources = json_decode(file_get_contents($rootDir . 'link_source/source_links.json'), true);

    $resources = $this->getApplication()->getKernel()->getContainer()->getParameter('parser_resource');

    foreach ($sources as $name => $value) {
      foreach ($value as $k => $v) {
        $links = $v['links'];

        if (!$links) {
          continue;
        }

        $contents = Downloader::download($v['links']);

        if (!$contents || !is_array($contents)) {
          $output->writeln("<error>Response is empty, check links to resource</error>");
          exit;
        }

        foreach ($contents as $hash => $content) {
          $element = new PageNotFound($name, $resources[$name]['not_found']);

          if ($element->parsing($content)) {
            unset($sources[$name][$k]['links'][$hash]);
          }
        }
      }
    }

    file_put_contents($rootDir . 'link_source/source_links.json', json_encode($sources));
  }
}