<?php

namespace Mt\RestBundle\ResourceType;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Mt\RestBundle\Bridge\Collection\ResourceCollection;
use Mt\RestBundle\Bridge\Resource\ResourceEntityInterface;
use Mt\RestBundle\Bridge\Resource\ResourceInterface;
use Mt\RestBundle\Core\Resource\ResourceQuery;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class DoctrineResource implements ResourceInterface
{
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var DenormalizerInterface
     */
    private $denormalizer;

    public function __construct(EntityManager $manager, EntityRepository $repository, DenormalizerInterface $denormalizer)
    {
        $this->manager = $manager;
        $this->repository = $repository;
        $this->denormalizer = $denormalizer;
    }

    /**
     * @param ResourceQuery $query
     * @return ResourceEntityInterface
     */
    public function create(ResourceQuery $query): ResourceEntityInterface
    {
        $data = $query->getData();

        $className = $this->repository->getClassName();

        /**
         * @var ResourceEntityInterface $entity
         * @todo factory
         */
        $entity = $this->denormalizer->denormalize($data, $className);
        $entity->setOwner($query->getToken()->getUser());

        $this->manager->persist($entity);
        $this->manager->flush($entity);

        return $entity;
    }

    /**
     * @param ResourceQuery $query
     * @return ResourceCollection
     */
    public function read(ResourceQuery $query): ResourceCollection
    {
        $id = $query->getId();

        if (is_null($id)) {
            $data = $this->repository->findAll();
        } else {
            $data = $this->repository->find($id);
            if (empty($data)) {
                $data = [];
            } else {
                $data = [$data];
            }
        }

        return new ResourceCollection($data);
    }

    /**
     * @param ResourceQuery $query
     * @return ResourceEntityInterface
     * @throws \Exception
     */
    public function update(ResourceQuery $query): ResourceEntityInterface
    {
        /** @var ResourceEntityInterface $entity */
        $entity = $this->repository->find($query->getId());
        $class = new \ReflectionClass(get_class($entity));
        $metadata = $this->manager->getClassMetadata($class->getName());
        $mappings = $metadata->getAssociationMappings();

        $data = $query->getData();

        foreach ($data as $name => $value) {

            if (in_array($name, ['id', 'owner'])) {
                throw new \InvalidArgumentException(sprintf('Property %s is immutable', $name));
            }

            if (!$class->hasProperty($name)) {
                throw new \Exception(sprintf('Unknown property name %s', $name));
            }

            if (isset($mappings[$name])) {
                $target = $mappings[$name]['targetEntity'];
                $value = is_scalar($value)
                    ? $this->manager->getReference($target, $value)
                    : array_map(function ($id) use ($target) {
                        return $this->manager->getReference($target, $id);
                    }, $value);
            }

            $setter = 'set' . ucfirst($name);
            $method = new \ReflectionMethod($class->getName(), $setter);
            $method->invoke($entity, $value);
        }

        $this->manager->persist($entity);
        $this->manager->flush($entity);

        return $entity;
    }

    /**
     * @param ResourceQuery $query
     * @return ResourceEntityInterface
     * @throws \Exception
     */
    public function delete(ResourceQuery $query): ResourceEntityInterface
    {
        /** @var ResourceEntityInterface $entity */
        $entity = $this->repository->find($query->getId());

        if (empty($entity)) {
            throw new \Exception('Entity not found');
        }

        $this->manager->remove($entity);
        $this->manager->flush($entity);

        return $entity;
    }
}
