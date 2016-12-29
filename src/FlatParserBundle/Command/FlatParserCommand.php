<?php


namespace FlatParserBundle\Command;

use FlatParserBundle\FlatParserBundle;
use FlatParserBundle\Resources\Classes\Factory\FlatFactory;
use FlatParserBundle\Resources\Classes\FlatContent;
use FlatParserBundle\Resources\Classes\SourceLinks;
use FlatParserBundle\Resources\Services\Downloader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class FlatParserCommand extends Command
{
  const NAME = "Flat parser";

  public function __construct()
  {
    parent::__construct(self::NAME);
  }

  protected function configure()
  {
    $this->setName('flat:download');
  }

  protected function execute(InputInterface $input, OutputInterface $output)
  {
    $rootDir = $this->getApplication()->getKernel()->getRootDir() . '/../';
    $sources = json_decode(file_get_contents($rootDir . 'link_source/source_links.json'), true);

    $resources = $this->getApplication()->getKernel()->getContainer()->getParameter('parser_resource');

    foreach ($sources as $name => $value) {
      if ($name == 'olx') {
        continue;
      }

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
          $element = FlatFactory::factory($name, $resources[$name]['step_one']);
          $object  = $element->parsing($content);

          if (!$object) {
            continue;
          }

          if (isset($object['images'])) {
            //$images = Downloader::images($object['images'], $rootDir . 'web/images/');

          }

          $object['phones'] = $element->getPhone($v['links'][$hash]);
          //var_dump($object);
        }

      }
    }

    //file_put_contents($rootDir . 'link_source/source_links.json', json_encode($sources));

  }
}