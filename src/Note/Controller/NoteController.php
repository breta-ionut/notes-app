<?php

declare(strict_types=1);

namespace App\Note\Controller;

use App\Api\Exception\ValidationException;
use App\Note\Entity\Note;
use App\Note\Repository\NoteRepository;
use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class NoteController extends AbstractFOSRestController
{
    /**
     * @throws ValidationException
     */
    #[Route(path: '', name: 'create', methods: ['POST'])]
    #[ParamConverter('note', converter: 'fos_rest.request_body')]
    public function create(
        Note $note,
        ConstraintViolationListInterface $validationErrors,
        UserInterface $user,
        EntityManagerInterface $entityManager,
    ): View {
        if (0 !== \count($validationErrors)) {
            throw new ValidationException($validationErrors);
        }

        /** @var User $user */
        $note->setUser($user);

        $entityManager->persist($note);
        $entityManager->flush();

        return $this->view($note, Response::HTTP_CREATED);
    }

    /**
     * @throws ValidationException
     */
    #[Route(path: '/{id<\d+>}', name: 'update', methods: ['PUT'])]
    #[ParamConverter('newNote', converter: 'fos_rest.request_body')]
    #[IsGranted('NOTE_ACCESS', subject: 'note')]
    public function update(
        Note $note,
        Note $newNote,
        ConstraintViolationListInterface $validationErrors,
        EntityManagerInterface $entityManager,
    ): View {
        if (0 !== \count($validationErrors)) {
            throw new ValidationException($validationErrors);
        }

        $note->update($newNote);

        $entityManager->flush();

        return $this->view($note);
    }

    #[Route(path: '/{id<\d+>}', name: 'delete', methods: ['DELETE'])]
    #[IsGranted('NOTE_ACCESS', subject: 'note')]
    public function delete(Note $note, EntityManagerInterface $entityManager): View
    {
        $entityManager->remove($note);
        $entityManager->flush();

        return $this->view(null, Response::HTTP_NO_CONTENT);
    }

    #[Route(path: '', name: 'list', methods: ['GET'])]
    public function list(UserInterface $user, NoteRepository $noteRepository): View
    {
        $notes = $noteRepository->findBy(['user' => $user]);

        return $this->view($notes);
    }
}
