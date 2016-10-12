<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AlbumForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden')
            ->add('name', 'text', [
                'label' => 'Nazwa albumu'
            ])
            ->add('submit', 'submit', [
                'label' => 'Zapisz',
            ]);
    }
}
