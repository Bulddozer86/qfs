<?php

namespace FlatParserBundle\Command;

use FlatParserBundle\Resources\Classes\SourceLinks;
use FlatParserBundle\Resources\Services\Downloader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class ParserCommand extends Command
{
  const NAME = "Flat parser";

  public function __construct()
  {
    parent::__construct(self::NAME);
  }

  protected function configure()
  {
    $this->setName('parser:run');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $resources = $this->getApplication()->getKernel()->getContainer()->getParameter('parser_resource');

    if (!$resources || !is_array($resources)) {
      $output->writeln("<error>Wrong config data, please check your config.yml</error>");
      exit;
    }

    $links = [];

    foreach ($resources as $resource => $data) {

      if (isset($data['step_one']['post'])) {
        $links[$resource]['post'] = $data['step_one']['post'];
      }

      $links[$resource]['link'] = $data['step_one']['link'];
    }

    if (!$links) {
      $output->writeln("<error>Wrong config data, please check your resource link in config.yml</error>");
      exit;
    }

    $contents = Downloader::download($links);

    if (!$contents || !is_array($contents)) {
      $output->writeln("<error>Response is empty, check links to resource</error>");
      exit;
    }

    $sourceLink = [];
    $rootDir    = $this->getApplication()->getKernel()->getRootDir() . '/../';
    $lastDump   = json_decode(file_get_contents($rootDir . 'link_source/last_dump.json'), true);
    $newLinks   = json_decode(file_get_contents($rootDir . 'link_source/source_links.json'), true);

    foreach ($contents as $name => $html) {
      $element = new SourceLinks($name, $resources[$name]['step_one']);
      $new     = $element->parsing($html);
      $statistic = array_diff($new, $lastDump[$element->getName()]);

      $newLinks[$element->getName()][] = [
        'count' => count($statistic),
        'links' => $statistic,
        'data'  => date('d.m.Y H:i')
      ];

      $sourceLink[$element->getName()] = $new;
    }

    file_put_contents($rootDir . 'link_source/last_dump.json', json_encode($sourceLink));
    file_put_contents($rootDir . 'link_source/source_links.json', json_encode($newLinks));

    //TODO :: add save to file and checking new objects
  }
}