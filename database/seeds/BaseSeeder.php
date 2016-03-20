<?php

use Faker\Factory as Faker;
use Faker\Generator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 20/03/2016
 * Time: 17:43
 * @property  pool
 */
abstract class BaseSeeder extends Seeder
{

    protected static $pool = array();

    abstract public function getModel();
    abstract public function getDummyData(Generator $faker, array $customValues = array());

    protected function createMultiple($total, array $customValues = array())
    {
        for ($i = 0; $i <= $total; $i++) {
            $this->create($customValues);
        }
    }

    protected function create(array $customValues = array())
    {
        $values = $this->getDummyData(Faker::create(), $customValues);
        $values = array_merge($values, $customValues);
        return $this->addToPool($this->getModel()->create($values));
    }

    protected function getRandom($model)
    {
        if(! $this->colectionExists($model))
        {
            throw new Exception("La colección de $model no existe");
        }
        return static::$pool[$model]->random();
    }

    private function addToPool($entity)
    {
        $reflection = new ReflectionClass($entity);
        $class = $reflection->getShortName();

        if(! $this->colectionExists($class))
        {
            static::$pool[$class] = new Collection();
        }

        static::$pool[$class]->add($entity);

        return $entity;
    }

    /**
     * @param $class
     * @return bool
     */
    private function colectionExists($class)
    {
        return isset(static::$pool[$class]);
    }


}