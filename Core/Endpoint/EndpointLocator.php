<?php

namespace Mt\RestBundle\Core\Endpoint;

use Mt\RestBundle\Bridge\Endpoint\DefinitionLoaderInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointDefinitionInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointInterface;
use Mt\RestBundle\Bridge\Endpoint\EndpointLocatorInterface;
use Mt\RestBundle\Bridge\Endpoint\NotFoundException;
use Mt\RestBundle\Bridge\Request\EndpointRequestInterface;

class EndpointLocator implements EndpointLocatorInterface
{
    /**
     * @var EndpointDefinitionCollection
     */
    private $definitionCollection;

    /**
     * @var EndpointCollection
     */
    private $endpointCollection;

    /**
     * @var EndpointFactory
     */
    private $factory;

    public function __construct(EndpointFactory $factory)
    {
        $this->definitionCollection = new EndpointDefinitionCollection();
        $this->endpointCollection = new EndpointCollection();
        $this->factory = $factory;
    }

    public function registerDefinition(EndpointDefinitionInterface $definition)
    {
        $this->definitionCollection->registerDefinition($definition);
    }

    public function loadDefinitions(DefinitionLoaderInterface $loader)
    {
        foreach ($loader->getDefinitions() as $definition) {
            $this->registerDefinition($definition);
        }
    }

    /**
     * @inheritdoc
     */
    public function findEndpoint(EndpointRequestInterface $request): EndpointInterface
    {
        $path = $request->getPath();

        try {
            $endpoint = $this->endpointCollection->findByPath($path);
        } catch (NotFoundException $e) {}

        if (!isset($endpoint)) {

            $definition = $this->definitionCollection->findByPath($path);

            if (empty($definition)) {
                throw new \Exception(sprintf('Endpoint "%s" is not registered', $path));
            }

            $endpoint = $this->factory->createEndpoint($definition);
            $this->endpointCollection->registerEndpoint($endpoint, $path);
        }

        return $endpoint;
    }
}
