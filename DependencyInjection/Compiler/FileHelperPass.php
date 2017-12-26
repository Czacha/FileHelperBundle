<?php


namespace OW\FileHelperBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;


class FileHelperPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function process(ContainerBuilder $container)
    {
        $channels = $container->getParameter('config.file_helper')['channels'];

        // create channels
        foreach ($channels as $channel) {
            $taggedHelper = $container->findTaggedServiceIds('file_helper.'.$channel['name']);

            if (empty($taggedHelper)) {
                continue;
            } else if (count($taggedHelper) > 1) {
                throw new \Exception('Helper registered with tag: ' . 'file_helper.' . $channel['name'] . ' already exist.');
            }

            foreach ($taggedHelper as $helperClassName => $options) {
                $channelId = sprintf('ow.file_helper.%s', $channel['name']);
                $this->createService($helperClassName, $channel, $channelId, $container);
            }
        }
    }

    protected function createService(string $helperClassName, array $channelConf, string $channelId, ContainerBuilder $container)
    {
        $service = new Definition($helperClassName);
        $service->addArgument($container->getParameter('kernel.project_dir'));
        $service->addArgument($container->getParameter('config.file_helper')['upload_root_dir']);
        $service->addArgument($channelConf['target_dir']);
        $service->addArgument($channelConf['save_original_filename']);

        $container->setDefinition($channelId, $service);
    }

    private function getChannelConf(array $channels, string $channelName)
    {
        foreach ($channels as $channel) {
            if ($channel['name'] === $channelName) {
                return $channel;
            }
        }
    }
}
