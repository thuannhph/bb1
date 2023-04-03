<?php

namespace Botble\Member\Tables;

use BaseHelper;
use Botble\Member\Repositories\Interfaces\MemberInterface;
use Botble\Table\Abstracts\TableAbstract;
use Html;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class MemberTable extends TableAbstract
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
     * MemberTable constructor.
     * @param DataTables $table
     * @param UrlGenerator $urlGenerator
     * @param MemberInterface $memberRepository
     */
    public function __construct(DataTables $table, UrlGenerator $urlGenerator, MemberInterface $memberRepository)
    {
        parent::__construct($table, $urlGenerator);

        $this->repository = $memberRepository;

        if (!Auth::user()->hasAnyPermission(['member.edit', 'member.destroy'])) {
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
            ->editColumn('avatar_id', function ($item) {
                return Html::tag('img', '', ['src' => $item->avatar_thumb_url, 'alt' => $item->name, 'width' => 50]);
            })
            ->editColumn('username', function ($item) {
                if (!Auth::user()->hasPermission('member.edit')) {
                    return BaseHelper::clean($item->username);
                }

                return Html::link(route('member.edit', $item->id), BaseHelper::clean($item->username));
            })
            ->editColumn('checkbox', function ($item) {
                return $this->getCheckbox($item->id);
            })
            ->editColumn('created_at', function ($item) {
                return BaseHelper::formatDate($item->created_at);
            })
            ->addColumn('operations', function ($item) {
                return $this->getOperations('member.edit', 'member.destroy', $item);
            });

        return $this->toJson($data);
    }

    /**
     * {@inheritDoc}
     */
    public function query()
    {
        $query = $this->repository->getModel()->select([
            'id',
            'avatar_id',
            'username',
            'phone',
            'bank_name',
            'bank_number',
            'money',
            'level_vip',
            'number_spins',
            'created_at',
        ]);

        return $this->applyScopes($query);
    }

    /**
     * {@inheritDoc}
     */
    public function columns()
    {
        return [
            'id'         => [
                'title' => trans('core/base::tables.id'),
                'width' => '20px',
            ],
            'avatar_id'  => [
                'title' => trans('plugins/member::member.avatar'),
                'width' => '70px',
            ],
            'username' => [
                'title' => "username",
                'class' => 'text-start',
            ],
            'phone'      => [
                'title' => "phone",
                'class' => 'text-start',
            ],
            'bank_name' => [
                'title' => "bank name",
                'class' => 'text-start',
            ],
            'bank_number'      => [
                'title' => "bank number",
                'class' => 'text-start',
            ],
            'money'      => [
                'title' => "money",
                'class' => 'text-start',
            ],
            'level_vip'      => [
                'title' => "Vip",
                'class' => 'text-start',
            ],
            'number_spins'      => [
                'title' => "number spins",
                'class' => 'text-start',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'width' => '100px',
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function buttons()
    {
        return $this->addCreateButton(route('member.create'), 'member.create');
    }

    /**
     * {@inheritDoc}
     */
    public function bulkActions(): array
    {
        return $this->addDeleteAction(route('member.deletes'), 'member.destroy', parent::bulkActions());
    }

    /**
     * {@inheritDoc}
     */
    public function getBulkChanges(): array
    {
        return [
            'first_name' => [
                'title'    => trans('plugins/member::member.first_name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'last_name'  => [
                'title'    => trans('plugins/member::member.last_name'),
                'type'     => 'text',
                'validate' => 'required|max:120',
            ],
            'email'      => [
                'title'    => trans('core/base::tables.email'),
                'type'     => 'text',
                'validate' => 'required|max:120|email',
            ],
            'created_at' => [
                'title' => trans('core/base::tables.created_at'),
                'type'  => 'date',
            ],
        ];
    }
}
