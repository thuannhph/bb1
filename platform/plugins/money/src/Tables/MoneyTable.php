<?php

namespace Botble\Money\Tables;

use Illuminate\Support\Facades\Auth;
use BaseHelper;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Money\Repositories\Interfaces\MoneyInterface;
use Botble\Table\Abstracts\TableAbstract;
use Illuminate\Contracts\Routing\UrlGenerator;
use Yajra\DataTables\DataTables;
use Html;

class MoneyTable extends TableAbstract
{

    /**
     * @var bool
     */
    protected $hasActions = true;

    /**
     * @var bool
     */
    protected $hasFilter = true;

    /**
     * MoneyTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param MoneyInterface $moneyRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, MoneyInterface $moneyRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $moneyRepository;

        if (!Auth::user()->hasAnyPermission(['money.edit', 'money.destroy'])) {
            $this->hasOperations = false;
            $this->hasActions = false;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function ajax()
    {
        $data = $this->table
            ->eloquent($this->query())
            ->editColumn('name', function ($item) {
                return $item->name;
            })
            ->editColumn('type', function ($item) {
                return $item->type == 1 ? "Rút" : "Nạp";
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->editColumn('status', function ($item) {
                if($item->status == '1') {
                    $text = "Chờ xét duyệt";
                } else if($item->status == '2') {
                    $text = "Thành công";
                } else {
                    $text = "Đóng băng";
                }
                return $text;
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('money.edit', 'money.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()
            ->select([
                'id',
                'name',
                'user_id',
                'money',
                'note',
                'type',
                'created_at',
                'status',
           ]);

        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'id' => [
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'name' => [
                'title' => "Tên chủ tài khoản",
                'class' => 'text-start',
            ],
            'money' => [
                'title' => "Tiền",
                'class' => 'text-start',
            ],
            'type' => [
                'title' => "Loại",
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
            'status' => [
                'title' => trans('core/base::tables.status'),
                'width' => '100px',
            ],
        ];
    }

    // /**
    //  * {@inheritDoc}
    //  */
    // public function buttons()
    // {
    //     return $this->addCreateButton(route('money.create'), 'money.create');
    // }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('money.deletes'), 'money.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'name' => [
                'title'    => trans('core/base::tables.name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return $this->getBulkChanges();
    }
}
