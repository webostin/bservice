<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ImageForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('id', 'hidden')
            ->add('image_url', 'text', [
                'label' => 'Adres url zdjęcia'
            ])
            ->add('alt', 'text', [
                'label' => 'Alt'
            ])
            ->add('album_id', 'entity', [
                'class' => 'App\Album',
                'property' => 'name',
                'label' => 'Album'
            ])
            ->add('submit', 'submit', [
                'label' => 'Zapisz',
            ]);

    }
}
