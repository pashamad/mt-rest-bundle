<?php

namespace Mt\RestBundle\ResourceType;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
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
     * @todo authorization pointcut
     *
     * @param ResourceQuery $query
     * @return object
     */
    public function create(ResourceQuery $query)
    {
        $data = $query->getData();

        $className = $this->repository->getClassName();

        // @todo optional factory service
        $entity = $this->denormalizer->denormalize($data, $className);

        $this->manager->persist($entity);
        $this->manager->flush($entity);

        return $entity;
    }

    /**
     * @todo authorization pointcut
     *
     * @param ResourceQuery $query
     * @return array|null|object
     */
    public function read(ResourceQuery $query)
    {
        $id = $query->getId();

        if (is_null($id)) {
            // @todo pagination
            $data = $this->repository->findAll();
        } else {
            $data = $this->repository->find($id);
        }

        return $data;
    }

    /**
     * @todo authorization pointcut
     *
     * @param ResourceQuery $query
     */
    public function update(ResourceQuery $query)
    {
        // TODO: Implement update() method.
    }

    /*
     * @todo authorization pointcut
     */
    public function delete(ResourceQuery $query)
    {
        // TODO: Implement delete() method.
    }
}
