<?php

declare(strict_types=1);

namespace App\Note\Entity;

use App\User\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Note\Repository\NoteRepository")
 * @ORM\Table(name="notes")
 */
class Note implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\Column(length=100)
     */
    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    private string $name;

    /**
     * @ORM\Column(length=1023)
     */
    #[Assert\NotBlank]
    #[Assert\Length(max: 1023)]
    private string $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\User\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $user;

    public function __construct(string $name, string $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return $this
     */
    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return $this
     */
    public function update(Note $newNote): static
    {
        $this->name = $newNote->name;
        $this->content = $newNote->content;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'content' => $this->content,
        ];
    }
}
