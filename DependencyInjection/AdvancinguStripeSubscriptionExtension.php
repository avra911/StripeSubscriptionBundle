<?php

/*
 * This file is part of the AdvancinguStripeSubscriptionBundle package.
 *
 * (c) 2013 Markus Weiland <mw@graph-ix.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Advancingu\StripeSubscriptionBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AdvancinguStripeSubscriptionExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        
        // expose configuration parameters to global container
        $container->setParameter(
            'advancingu_stripe_subscription.keys.public',
            $config['stripe_public_key']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.keys.secret',
            $config['stripe_secret_key']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.plans',
            $config['plans']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.payee_name',
            $config['payee_name']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.subscription_check.subscribe_route',
            $config['subscription_check']['subscribe_route']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.subscription_check.subscription_required_i18nKey',
            $config['subscription_check']['subscription_required_i18nKey']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.subscription_check.subscription_required_message_domain',
            $config['subscription_check']['subscription_required_message_domain']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.trial_role',
            $config['trial_role']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.trial_duration',
            $config['trial_duration']
        );
        $container->setParameter(
            'advancingu_stripe_subscription.object_manager',
            $config['object_manager']
        );
    }
}
