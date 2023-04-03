<?php

namespace Botble\Vip\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Vip\Http\Requests\VipRequest;
use Botble\Vip\Models\Vip;

class VipForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Vip)
            ->setValidatorClass(VipRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 255,
                ],
            ])
            ->add('image', 'mediaImage', [
                'label'      => trans('core/base::forms.image'),
                'label_attr' => ['class' => 'control-label'],
            ])
            ->add('investment', 'number', [
                'label'      => "Investment",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => "Investment",
                ],
            ])
            ->add('commission', 'text', [
                'label'      => "Commission",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => "Commission",
                ],
            ])
            ->add('order', 'number', [
                'label'      => "Oder",
                'label_attr' => ['class' => 'control-label'],
                'attr'       => [
                    'placeholder'  => "Oder",
                ],
            ])
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
