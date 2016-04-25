<?php
namespace Curso\Repositories;


abstract class BaseRepository
{
    // Nos permite asociar un modelo a este repositorio
    /**
     * @return \Curso\Entities\Entity
     */
    abstract public function getModel();

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        return $this->getModel()->newQuery();
    }

    public function findOrFail($id)
    {
        return $this->newQuery()->findOrFail($id);
    }
}