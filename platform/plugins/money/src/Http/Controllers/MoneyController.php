<?php

namespace Botble\Money\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Money\Http\Requests\MoneyRequest;
use Botble\Money\Http\Requests\AddCardRequest;
use Botble\Money\Repositories\Interfaces\MoneyInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Money\Tables\MoneyTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Money\Forms\MoneyForm;
use Botble\Base\Forms\FormBuilder;

class MoneyController extends BaseController
{
    /**
     * @var MoneyInterface
     */
    protected $moneyRepository;

    /**
     * @param MoneyInterface $moneyRepository
     */
    public function __construct(MoneyInterface $moneyRepository)
    {
        $this->moneyRepository = $moneyRepository;
    }

    /**
     * @param MoneyTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(MoneyTable $table)
    {
        page_title()->setTitle(trans('plugins/money::money.name'));

        return $table->renderTable();
    }

    /**
     * {@inheritDoc}
     */
    public function topUp()
    {
        return view('plugins/money::top-up');
    }

    public function saveTopUp(AddCardRequest $request, BaseHttpResponse $response)
    {
        $this->moneyRepository->createOrUpdate($request->input());
        return $response
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    /**
     * @param FormBuilder $formBuilder
     * @return string
     */
    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/money::money.create'));

        return $formBuilder->create(MoneyForm::class)->renderForm();
    }

    /**
     * @param MoneyRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(MoneyRequest $request, BaseHttpResponse $response)
    {
        $money = $this->moneyRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(MONEY_MODULE_SCREEN_NAME, $request, $money));

        return $response
            ->setPreviousUrl(route('money.index'))
            ->setNextUrl(route('money.edit', $money->id))
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
        $money = $this->moneyRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $money));

        page_title()->setTitle(trans('plugins/money::money.edit') . ' "' . $money->name . '"');

        return $formBuilder->create(MoneyForm::class, ['model' => $money])->renderForm();
    }

    /**
     * @param int $id
     * @param MoneyRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, MoneyRequest $request, BaseHttpResponse $response)
    {
        $money = $this->moneyRepository->findOrFail($id);

        $money->fill($request->input());

        $money = $this->moneyRepository->createOrUpdate($money);

        event(new UpdatedContentEvent(MONEY_MODULE_SCREEN_NAME, $request, $money));

        return $response
            ->setPreviousUrl(route('money.index'))
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
            $money = $this->moneyRepository->findOrFail($id);

            $this->moneyRepository->delete($money);

            event(new DeletedContentEvent(MONEY_MODULE_SCREEN_NAME, $request, $money));

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
            $money = $this->moneyRepository->findOrFail($id);
            $this->moneyRepository->delete($money);
            event(new DeletedContentEvent(MONEY_MODULE_SCREEN_NAME, $request, $money));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
