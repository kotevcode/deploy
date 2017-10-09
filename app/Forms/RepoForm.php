<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class RepoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add(
                'url',
                'text',
                [
                    'label' => 'Url',
                    'attr'  => ['placeholder' => 'http://example.com'],
                    'rules' => 'required',
                ]
            )->add(
                'bitbucket',
                'text',
                [
                    'label' => 'Git path',
                    'attr'  => ['placeholder' => 'shahafan/deploy'],
                    'rules' => 'required',
                ]
            )->add(
                'account',
                'text',
                [
                    'label' => 'Linux user account',
                    'attr'  => ['placeholder' => 'www-data'],
                    'rules' => 'required',
                ]
            )->add(
                'directory',
                'text',
                [
                    'label' => 'Directory',
                    'attr'  => ['placeholder' => 'var/www/html/deploy'],
                    'rules' => 'required',
                ]
            )->add(
                'remote',
                'text',
                [
                    'label' => 'Remote',
                    'attr'  => ['placeholder' => 'origin'],
                    'rules' => 'required',
                ]
            )->add(
                'branch',
                'text',
                [
                    'label' => 'Branch',
                    'attr'  => ['placeholder' => 'master'],
                    'rules' => 'required',
                ]
            )->add(
                'auto_deploy',
                'checkbox',
                [
                    'label' => 'Auto Deploy',
                    'value' => 1,
                ]
            )->add(
                'comments',
                'textarea',
                [
                    'label' => 'Comments',
                    'attr'  => ['rows' => 3, 'placeholder' => 'Anything else..'],
                ]
            )->add(
                'post_deploy',
                'textarea',
                [
                    'label' => 'Post Deploy',
                    'attr'  => ['rows' => 3, 'placeholder' => 'composer install && npm install'],
                ]
            )->add(
                'submit',
                'submit',
                [
                    'label' => 'Save',
                    'attr'  => ['class' => 'btn btn-primary btn-block',],
                ]
            );

    }
}
