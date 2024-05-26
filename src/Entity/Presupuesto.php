<?php

namespace App\Entity;

use App\Repository\PresupuestoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PresupuestoRepository::class)
 */
class Presupuesto
{
    public const PRESUPUESTO_TYPES = [
        'Web' => 'web',
        'Mobile' => 'mobile',
        'Desktop' => 'desktop'
    ];

    public const PRESUPUESTO_STATES = [
        'Pendiente' => 'pendiente',
        'Aprobado' => 'aprobado',
        'Rechazado' => 'rechazado'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $estado;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $precio_final;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="presupuestos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Proyecto::class, mappedBy="presupuesto", cascade={"persist", "remove"})
     */
    private $proyecto;

    public function __construct()
    {
        $this->estado = self::PRESUPUESTO_STATES['Pendiente'];
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        if(!in_array($tipo, $this::PRESUPUESTO_TYPES)){
            throw new Exception('Tipo de presupuesto no válido: '.$tipo);
        };

        $this->tipo = $tipo;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        if(!in_array($estado, $this::PRESUPUESTO_STATES)){
            throw new Exception('Estado del presupuesto de presupuesto no válido: '.$estado);
        };

        $this->estado = $estado;

        return $this;
    }

    public function getPrecioFinal(): ?float
    {
        return $this->precio_final;
    }

    public function setPrecioFinal(?float $precio_final): self
    {
        $this->precio_final = $precio_final;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProyecto(): ?Proyecto
    {
        return $this->proyecto;
    }

    public function setProyecto(Proyecto $proyecto): self
    {
        // set the owning side of the relation if necessary
        if ($proyecto->getPresupuesto() !== $this) {
            $proyecto->setPresupuesto($this);
        }

        $this->proyecto = $proyecto;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getId() ??'';
    }
}
