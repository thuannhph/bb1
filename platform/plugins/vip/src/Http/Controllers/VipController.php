<?php

namespace Botble\Vip\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Vip\Http\Requests\VipRequest;
use Botble\Vip\Repositories\Interfaces\VipInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Vip\Tables\VipTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Vip\Forms\VipForm;
use Botble\Base\Forms\FormBuilder;

class VipController extends BaseController
{
    /**
     * @var VipInterface
     */
    protected $vipRepository;

    /**
     * @param VipInterface $vipRepository
     */
    public function __construct(VipInterface $vipRepository)
    {
        $this->vipRepository = $vipRepository;
    }

    /**
     * @param VipTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(VipTable $table)
    {
        page_title()->setTitle(trans('plugins/vip::vip.name'));

        return $table->renderTable();
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/vip::vip.create'));

        return $formBuilder->create(VipForm::class)->renderForm();
    }

    /**
     * @param VipRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(VipRequest $request, BaseHttpResponse $response)
    {
        $vip = $this->vipRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(VIP_MODULE_SCREEN_NAME, $request, $vip));

        return $response
            ->setPreviousUrl(route('vip.index'))
            ->setNextUrl(route('vip.edit', $vip->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function edit($id, FormBuilder $formBuilder, Request $request)
    {
        $vip = $this->vipRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $vip));

        page_title()->setTitle(trans('plugins/vip::vip.edit') . ' "' . $vip->name . '"');

        return $formBuilder->create(VipForm::class, ['model' => $vip])->renderForm();
    }

    /**
     * @param int $id
     * @param VipRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, VipRequest $request, BaseHttpResponse $response)
    {
        $vip = $this->vipRepository->findOrFail($id);

        $vip->fill($request->input());

        $vip = $this->vipRepository->createOrUpdate($vip);

        event(new UpdatedContentEvent(VIP_MODULE_SCREEN_NAME, $request, $vip));

        return $response
            ->setPreviousUrl(route('vip.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    /**
     * @param int $id
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        try {
            $vip = $this->vipRepository->findOrFail($id);

            $this->vipRepository->delete($vip);

            event(new DeletedContentEvent(VIP_MODULE_SCREEN_NAME, $request, $vip));

            return $response->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $response
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     * @throws Exception
     */
    public function deletes(Request $request, BaseHttpResponse $response)
    {
        $ids = $request->input('ids');
        if (empty($ids)) {
            return $response
                ->setError()
                ->setMessage(trans('core/base::notices.no_select'));
        }

        foreach ($ids as $id) {
            $vip = $this->vipRepository->findOrFail($id);
            $this->vipRepository->delete($vip);
            event(new DeletedContentEvent(VIP_MODULE_SCREEN_NAME, $request, $vip));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
