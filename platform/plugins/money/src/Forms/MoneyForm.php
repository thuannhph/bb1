<?php

namespace Botble\Money\Forms;

use Botble\Base\Forms\FormAbstract;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Money\Http\Requests\MoneyRequest;
use Botble\Money\Models\Money;

class MoneyForm extends FormAbstract
{

    /**
     * {@inheritDoc}
     */
    public function buildForm()
    {
        $this
            ->setupModel(new Money)
            ->setValidatorClass(MoneyRequest::class)
            ->withCustomFields()
            ->add('name', 'text', [
                'label'      => trans('core/base::forms.name'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                    'disabled' => true
                ],
            ])
            ->add('money', 'text', [
                'label'      => "Tiền",
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'placeholder'  => trans('core/base::forms.name_placeholder'),
                    'data-counter' => 120,
                    'disabled' => true
                ],
            ])
            ->add('status', 'customSelect', [
                'label'      => trans('core/base::tables.status'),
                'label_attr' => ['class' => 'control-label required'],
                'attr'       => [
                    'class' => 'form-control select-full',
                ],
                'choices'    => [
                    '1' => 'Chờ xét duyệt',
                    '2' => 'Thành công'
                ],
            ])
            ->setBreakFieldPoint('status');
    }
}
