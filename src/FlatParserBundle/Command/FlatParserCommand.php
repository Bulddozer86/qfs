<?php


namespace FlatParserBundle\Command;

use FlatParserBundle\FlatParserBundle;
use FlatParserBundle\Resources\Classes\Factory\FlatFactory;
use FlatParserBundle\Resources\Classes\FlatContent;
use FlatParserBundle\Resources\Classes\SourceLinks;
use FlatParserBundle\Resources\Services\Downloader;
use QFS\DBLogicBundle\Document\Flat;
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
    $repository = $this->getApplication()
                       ->getKernel()
                       ->getContainer()->get('doctrine_mongodb')
                       ->getManager()
                       ->getRepository('DBLogicBundle:Flat');

    $rootDir = $this->getApplication()->getKernel()->getRootDir() . '/../';
    $sources = json_decode(file_get_contents($rootDir . 'link_source/source_links.json'), true);

    $resources = $this->getApplication()->getKernel()->getContainer()->getParameter('parser_resource');

    foreach ($sources as $name => $value) {
//      if ($name == 'real_state') {
//        continue;
//      }
//      if ($name == 'olx') {
//        continue;
//      }
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
          $isSaved = $repository->findBy(['hash' => $hash]);

          if ($isSaved) {
            continue;
          }

          $element = FlatFactory::factory($name, $resources[$name]['step_one']);
          $object  = $element->parsing($content);

          if (!$object) {
            continue;
          }

          //Downloading images
          $images = [];

          if (isset($object['images'])) {
            $folder = $rootDir . 'web/images/' . $hash;

            if (!file_exists($folder)) {
              mkdir($folder, 0777, true);
            }

            $images[$hash] = Downloader::images($object['images'], $folder);
          }

          $object['phones'] = $element->getPhone($v['links'][$hash]);

          $flat = new Flat();
          $flat->setPrice($object['price']);
          $flat->setRooms($object['rooms']);
          $flat->setDate($object['date']);
          $flat->setHeadline($object['headline']);
          $flat->setDistrict($object['district']);
          $flat->setResource($object['resource']);
          $flat->setMainData(htmlentities($object['main_data']));
          $flat->setPhones(json_encode($object['phones']));
          $flat->setHash($hash);

          if (isset($images[$hash])) {
            $flat->setImages(json_encode($images[$hash]));
          }

          $dm = $this->getApplication()->getKernel()->getContainer()->get('doctrine_mongodb')->getManager();
          $dm->persist($flat);
          $dm->flush();

          if ($flat->getId()) {
            unset($sources[$name][$k]['links'][$hash]);
          }
        }

        $sources[$name][$k]['count'] = count($sources[$name][$k]['links']);
      }
    }

    file_put_contents($rootDir . 'link_source/source_links.json', json_encode($sources));

  }
}