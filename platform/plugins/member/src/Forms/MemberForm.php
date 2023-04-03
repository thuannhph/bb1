<?php

namespace Botble\Member\Forms;

use Assets;
use BaseHelper;
use Botble\Base\Forms\FormAbstract;
use Botble\Member\Http\Requests\MemberCreateRequest;
use Botble\Member\Models\Member;

class MemberForm extends FormAbstract
{
    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        Assets::addScriptsDirectly(['/vendor/core/plugins/member/js/member-admin.js']);

        $this
            ->setupModel(new Member())
            ->setValidatorClass(MemberCreateRequest::class)
            ->withCustomFields()
            ->add('username', 'text', [
                'label'      => "username",
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                ],
            ])
            ->add('phone', 'text', [
                'label'      => trans('plugins/member::member.phone'),
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => trans('plugins/member::member.phone_placeholder'),
                    'data-counter' => 20,
                ],
            ])
            ->add('number_spins', 'number', [
                'label'      => "number spins",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => trans('plugins/member::member.phone_placeholder'),
                    'data-counter' => 20,
                ],
            ])
            ->add('is_change_password', 'checkbox', [
                'label'      => trans('plugins/member::member.form.change_password'),
                'label_attr' => ['class' => 'control-label'],
                'value'      => 1,
            ])
            ->add('password', 'password', [
                'label'      => trans('plugins/member::member.form.password'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ($this->getModel()->id ? ' hidden' : null),
                ],
            ])
            ->add('password_confirmation', 'password', [
                'label'      => trans('plugins/member::member.form.password_confirmation'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'data-counter' => 60,
                ],
                'wrapper'    => [
                    'class' => $this->formHelper->getConfig('defaults.wrapper_class') . ($this->getModel()->id ? ' hidden' : null),
                ],
            ])
            ->add('avatar_image', 'mediaImage', [
                'label'      => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
                'value'      => $this->getModel()->avatar->url,
            ])
            ->setBreakFieldPoint('avatar_image');
    }
}
