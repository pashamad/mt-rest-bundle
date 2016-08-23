<?php

namespace Mt\RestBundle\Service\ResourceFactory;

use Mt\RestBundle\Bridge\Resource\ResourceDefinitionInterface;
use Mt\RestBundle\Bridge\Resource\ResourceFactoryInterface;
use Mt\RestBundle\Bridge\Resource\ResourceInterface;
use Mt\RestBundle\ResourceType\DoctrineResource;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class DoctrineResourceFactory implements ResourceFactoryInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function createResource(ResourceDefinitionInterface $definition): ResourceInterface
    {
        $params = $definition->getParams();

        if (!isset($params['repository']) || empty($params['repository'])) {
            throw new \Exception('Parameter "repository" is missing');
        }
        if (!is_string($params['repository']) || (strpos($params['repository'], '@') !== 0)) {
            throw new \Exception('Invalid parameter "repository"');
        }

        $repositoryServiceId = substr($params['repository'], 1);
        if (!$this->container->has($repositoryServiceId)) {
            throw new \Exception(sprintf('Repository service "%s" not found', $repositoryServiceId));
        }

        $manager = $this->container->get('doctrine.orm.entity_manager');
        $repository = $this->container->get($repositoryServiceId);

        $normalizer = new ObjectNormalizer();

        // @todo token storage
        // @todo decision manager

        $resource = new DoctrineResource($manager, $repository, $normalizer);

        //$resource->setAuthorizationChecker($this->container->get('security.authorization_checker'));

        return $resource;
    }
}
