<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),

            //FOS Bundles
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new FOS\UserBundle\FOSUserBundle(),

            //JMS Bundles
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            new JMS\TranslationBundle\JMSTranslationBundle(),

            //Sylius Bundles
            new Sylius\Bundle\ResourceBundle\SyliusResourceBundle(),
            new Sylius\Bundle\FixturesBundle\SyliusFixturesBundle(),
            new Sylius\Bundle\GridBundle\SyliusGridBundle(),
            new Sylius\Bundle\UiBundle\SyliusUiBundle(),
            new winzou\Bundle\StateMachineBundle\winzouStateMachineBundle(),

            //Google Map bundles
            new Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
            new Ivory\SerializerBundle\IvorySerializerBundle(),
            new Http\HttplugBundle\HttplugBundle(),

            new DavidBadura\FakerBundle\DavidBaduraFakerBundle(),

            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),

            new Sonata\BlockBundle\SonataBlockBundle(),

            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),

            //User Bundles
            new PUGX\MultiUserBundle\PUGXMultiUserBundle(),
            new RC\WebBundle\RCWebBundle(),
            new RC\UserBundle\RCUserBundle(),
            new RC\CustomerBundle\RCCustomerBundle(),
            new RC\CoreBundle\RCCoreBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
