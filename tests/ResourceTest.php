<?php
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 15/05/2016
 * Time: 20:14
 */
class ResourceTest extends TestCase
{
    use DatabaseTransactions;

    protected $title = 'Curso de Eloquent Avanzado';
    protected $link = 'http://google.es';

    public function test_create_resource()
    {
        // Having
        $user = seed('User');

        //Where
        $this->actingAs($user)
            ->visit(route('tickets.create'))
            ->type($this->title,'title')
            ->type($this->link, 'link')
            ->press('Enviar Solicitud');

        //Then
        $this->seeInDatabase('tickets', [
            'title' => $this->title,
            'link'  => $this->link,
            'status'=> 'closed'
        ]);

        $this->see($this->title)
            ->seeLink('Ver recurso', $this->link);

    }
}