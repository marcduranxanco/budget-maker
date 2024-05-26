<?php

namespace App\Entity;

use App\Repository\ProyectoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProyectoRepository::class)
 */
class Proyecto
{
    public const PROYECTO_STATE = [
        'Enproceso' => 'enproceso',
        'Aprobado' => 'aprobado',
        'Terminado' => 'terminado'
    ];


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_entrega;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $estado;

    /**
     * @ORM\OneToOne(targetEntity=Presupuesto::class, inversedBy="proyecto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $presupuesto;

    /**
     * @ORM\OneToMany(targetEntity=Tarea::class, mappedBy="proyecto", orphanRemoval=true)
     */
    private $tareas;

    public function __construct()
    {
        $this->tareas = new ArrayCollection();
        $this->estado = self::PROYECTO_STATE['Enproceso'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fecha_entrega;
    }

    public function setFechaEntrega(\DateTimeInterface $fecha_entrega): self
    {
        $this->fecha_entrega = $fecha_entrega;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        if(!in_array($estado, $this::PROYECTO_STATE)){
            throw new Exception('Tipo de presupuesto no válido: '.$estado);
        };
        $this->estado = $estado;

        return $this;
    }

    public function getPresupuesto(): ?Presupuesto
    {
        return $this->presupuesto;
    }

    public function setPresupuesto(Presupuesto $presupuesto): self
    {
        $this->presupuesto = $presupuesto;

        return $this;
    }

    /**
     * @return Collection<int, Tarea>
     */
    public function getTareas(): Collection
    {
        return $this->tareas;
    }

    public function addTarea(Tarea $tarea): self
    {
        if (!$this->tareas->contains($tarea)) {
            $this->tareas[] = $tarea;
            $tarea->setProyecto($this);
        }

        return $this;
    }

    public function removeTarea(Tarea $tarea): self
    {
        if ($this->tareas->removeElement($tarea)) {
            // set the owning side to null (unless already changed)
            if ($tarea->getProyecto() === $this) {
                $tarea->setProyecto(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return (string) ($this->getId() ?? '');
    }
}
