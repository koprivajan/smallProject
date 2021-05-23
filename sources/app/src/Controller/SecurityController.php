<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use RuntimeException;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;


/**
 * @Route("/api")
 */
final class SecurityController extends AbstractController
{
    /** @var SerializerInterface */
    private $serializer;

    /** @var EntityManagerInterface */
    private $em;
    
    
    public function __construct(EntityManagerInterface $em, SerializerInterface $serializer)
    {
    
        $this->em = $em;    
        $this->serializer = $serializer;
    }

    /**
     * @Route("/security/login", name="login")
     */
    public function loginAction(): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        $userClone = clone $user;
        $userClone->setPassword('');
        $data = $this->serializer->serialize($userClone, JsonEncoder::FORMAT);

        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    /**
     * @Route("/security/register", name="register")
     */
    public function registerAction(Request $request, ValidatorInterface $validator): JsonResponse
    {
        /** @var User $user */
/*        
        $request = Request::createFromGlobals();
        $parameters = json_decode($request->getContent(), true);
        
        
        //test mails 
        
        
        
    //    throw new BadRequestHttpException('message cannot be empty');
        
        
        $userEntity = new User();
        
        $userEntity->setLogin($parameters['username']);
        
        
        
        //$userExits = $this->getDoctrine()->getManager()->findOneBy(array('login' => $parameters['username']));

        
        
        
        $userEntity->setPlainPassword($parameters['password']);
        
        $userEntity->setPassword($parameters['password']);
        $userEntity->setName($parameters['username']);

        
        
        $userEntity->setRoles(explode(',',$parameters['role']));

        
        
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userEntity);
        $entityManager->flush();
        
        
        
        $data = $this->serializer->serialize($userEntity, JsonEncoder::FORMAT);

        
        return new JsonResponse($data, Response::HTTP_OK, [], true);
*/

/*

try {
        $form = $this->createForm(UserType::class);

        $form->submit($request->request->all());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $emailParams = new ContactUsParams();
            $emailParams->setName($data['name']);
            $emailParams->setEmail($data['email']);
            $emailParams->setSubject($data['subject']);
            $emailParams->setMessage($data['message']);


            /////////////////
            // ?$request = Request::createFromGlobals();
            $parameters = json_decode($request->getContent(), true);
        
                
        
            $userEntity = new User();
        
            $userEntity->setLogin($parameters['username']);        
        
            $userEntity->setPlainPassword($parameters['password']);
        
            $userEntity->setPassword($parameters['password']);
            $userEntity->setName($parameters['username']);

        
        
            $userEntity->setRoles(explode(',',$parameters['role']));

        
        
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userEntity);
            $entityManager->flush();
        
        
        
            $data = $this->serializer->serialize($userEntity, JsonEncoder::FORMAT);

        
            return new JsonResponse($data, Response::HTTP_OK, [], true);
            
        }

        return new JsonResponse($this->getFirstFormError($form), 400);
    } catch (\Exception $e) {
        return new JsonResponse($e->getMessage(), 500);
    }
  
*/

    $request = Request::createFromGlobals();
    $parameters = json_decode($request->getContent(), true);

    $login = $parameters['login'];
    $password = $parameters['password'];
    $role = $parameters['role'];
    $email = $parameters['email'];
    
    //$posts = $this->em->getRepository(User::class)->findBy([], ['id' => 'DESC']);
    
    $userExits = $this->em->getRepository(User::class)->findOneBy(array('login' => $login));
    
    
    if($userExits){
        throw new BadRequestHttpException('Login ' .$parameters['login']. ' is exist! Please register new one');
    }
    
    
    $input = ['login' => $login,'password' => $password,'role' => $role,'email' => $email,];
    $constraints = new Assert\Collection([
    'login' => [new Assert\Length(['min' => 2]), new Assert\NotBlank],
    'password' => [new Assert\Length(['min' => 2]), new Assert\NotBlank],
    'role' => [new Assert\Length(['min' => 2]), new Assert\NotBlank],
    'email' => [new Assert\Email],
    ]);
    
    
    $violations = $validator->validate($input, $constraints);
    
    if (count($violations) > 0) {
        $accessor = PropertyAccess::createPropertyAccessor();

        $errorMessages = [];

        foreach ($violations as $violation) {

        
        $accessor->setValue($errorMessages,
        $violation->getPropertyPath(),
        $violation->getMessage());
        }
        
        throw new BadRequestHttpException(json_encode($errorMessages));
        
    }
    
    

            $userEntity = new User();
        
            $userEntity->setLogin($login);        
        
            $userEntity->setPlainPassword($password);
        
            $userEntity->setPassword($password);
            
            $email = 'aaa@ccc.cz';
            $userEntity->setEmail($email);

        
        
            $userEntity->setRoles(explode(',',$role));

        
        
        
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userEntity);
            $entityManager->flush();
        
        
        
            $data = $this->serializer->serialize($userEntity, JsonEncoder::FORMAT);

        
            return new JsonResponse($data, Response::HTTP_OK, [], true);
    
    
    
        
        
    }


    
    
    

    /**
     * @throws RuntimeException
     *
     * @Route("/security/logout", name="logout")
     */
    public function logoutAction(): void
    {
        throw new RuntimeException('This should not be reached!');
    }
}
