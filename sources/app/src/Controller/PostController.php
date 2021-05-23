<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Rest\Route("/api")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
final class PostController extends AbstractController
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var SerializerInterface */
    private $serializer;

    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->serializer = $serializer;
    }


    /**
     * @Rest\Get("/posts", name="findAllPosts")
     */
    public function findAllAction(): JsonResponse
    {
        $posts = $this->em->getRepository(User::class)->findBy([], ['id' => 'DESC']);
        $data = $this->serializer->serialize($posts, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
    
    
    
}
