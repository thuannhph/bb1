<?php

namespace Botble\Products\Http\Controllers;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Products\Http\Requests\ProductsRequest;
use Botble\Products\Repositories\Interfaces\ProductsInterface;
use Botble\Member\Repositories\Interfaces\MemberInterface;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Exception;
use Botble\Products\Tables\ProductsTable;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Products\Forms\ProductsForm;
use Botble\Base\Forms\FormBuilder;
use RvMedia;

class ProductsController extends BaseController
{
    /**
     * @var ProductsInterface
     */
    protected $productsRepository;
    /**
     * @var MemberInterface
     */
    protected $memberRepository;

    /**
     * @param ProductsInterface $productsRepository
     * @param MemberInterface $memberRepository
     */
    public function __construct(ProductsInterface $productsRepository, MemberInterface $memberRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->memberRepository = $memberRepository;
    }

    /**
     * @param ProductsTable $table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ProductsTable $table)
    {
        page_title()->setTitle(trans('plugins/products::products.name'));

        return $table->renderTable();
    }
    
    /**
     * {@inheritDoc}
     */
    public function order()
    {
        $block = null;
        return view('plugins/products::order', compact('block'));
    }

    /**
     * {@inheritDoc}
     */
    public function support()
    {
        return view('plugins/products::support');
    }

    public function randomProducts()
    {
        $level_id = auth('member')->user()->level_vip;
        $id = auth('member')->user()->id;
        $member = $this->memberRepository->findOrFail($id);
        if ($member->number_spins != 0) {
            $block = $this->productsRepository->getRandomProducts($level_id, 0);
            $money = intval($block->price) * 0.1;
            $member->money = $member->money + $money;
            $member->number_spins = $member->number_spins - 1;
            $this->memberRepository->createOrUpdate($member);
        } else {
            $block = $this->productsRepository->getRandomProducts($level_id, $member->money);
        }
        $block->image = RvMedia::url($block->image);
        return json_encode($block);
    }

    public function create(FormBuilder $formBuilder)
    {
        page_title()->setTitle(trans('plugins/products::products.create'));

        return $formBuilder->create(ProductsForm::class)->renderForm();
    }

    /**
     * @param ProductsRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(ProductsRequest $request, BaseHttpResponse $response)
    {
        $products = $this->productsRepository->createOrUpdate($request->input());

        event(new CreatedContentEvent(PRODUCTS_MODULE_SCREEN_NAME, $request, $products));

        return $response
            ->setPreviousUrl(route('products.index'))
            ->setNextUrl(route('products.edit', $products->id))
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
        $products = $this->productsRepository->findOrFail($id);

        event(new BeforeEditContentEvent($request, $products));

        page_title()->setTitle(trans('plugins/products::products.edit') . ' "' . $products->name . '"');

        return $formBuilder->create(ProductsForm::class, ['model' => $products])->renderForm();
    }

    /**
     * @param int $id
     * @param ProductsRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function update($id, ProductsRequest $request, BaseHttpResponse $response)
    {
        $products = $this->productsRepository->findOrFail($id);

        $products->fill($request->input());

        $products = $this->productsRepository->createOrUpdate($products);

        event(new UpdatedContentEvent(PRODUCTS_MODULE_SCREEN_NAME, $request, $products));

        return $response
            ->setPreviousUrl(route('products.index'))
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
            $products = $this->productsRepository->findOrFail($id);

            $this->productsRepository->delete($products);

            event(new DeletedContentEvent(PRODUCTS_MODULE_SCREEN_NAME, $request, $products));

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
            $products = $this->productsRepository->findOrFail($id);
            $this->productsRepository->delete($products);
            event(new DeletedContentEvent(PRODUCTS_MODULE_SCREEN_NAME, $request, $products));
        }

        return $response->setMessage(trans('core/base::notices.delete_success_message'));
    }
}
