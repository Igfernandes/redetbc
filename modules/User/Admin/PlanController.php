<?php

namespace Modules\User\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\User\Models\Plan;
use Modules\User\Models\PlanTranslation;
use Modules\User\Models\UserPlan;

class PlanController extends AdminController
{
    protected $planClass;

    public function __construct()
    {
        $this->setActiveMenu(route('user.admin.plan.index'));
        $this->planClass = Plan::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('dashboard_access');
        $rows = $this->planClass::query();
        if (!empty($search = $request->query('s'))) {
            $rows->where('title', 'LIKE', '%' . $search . '%');
        }
        $rows->orderBy('id', 'desc');
        $data = [
            'rows'        => $rows->paginate(20),
            'row'         => new $this->planClass(),
            'translation' => new PlanTranslation(),
            'breadcrumbs' => [
                [
                    'name'  => __('Planos do Usuário'),
                    'class' => 'active'
                ],
            ],
            'page_title'  => __("Gerenciamento de Planos de Usuário")
        ];
        return view('User::admin.plan.index', $data);
    }


    public function edit(Request $request, $id)
    {
        $this->checkPermission('dashboard_access');
        $row = $this->planClass::find($id);
        if (empty($row)) {
            return redirect(route('user.admin.plan.index'));
        }
        $translation = $row->translate($request->query('lang', get_main_lang()));
        $data = [
            'translation'       => $translation,
            'enable_multi_lang' => true,
            'row'               => $row,
            'breadcrumbs'       => [
                [
                    'name'  => __('Planos do Usuário'),
                    'class' => 'active'
                ],
            ],
            'page_title'        => __("Editar plano de usuário")
        ];
        return view('User::admin.plan.detail', $data);
    }

    public function store(Request $request, $id)
    {
        if (is_demo_mode()) {
            return back()->with('error', "Demo mode: disabled");
        }
        $this->checkPermission('dashboard_access');
        $this->validate($request, [
            'title'         => 'required',
            'role_id'       => 'required',
            'duration'      => 'required',
            'duration_type' => 'required',
        ]);

        if ($id > 0) {
            $row = $this->planClass::find($id);
            if (empty($row)) {
                return redirect(route('user.admin.plan.index'));
            }
        } else {
            $row = new $this->planClass();
        }

        $row->fillByAttr([
            'title',
            'content',
            'price',
            'duration',
            'duration_type',
            'max_service',
            'status',
            'days_gratuity',
            'snippet',
            'role_id',
            'annual_price',
            'commission',
            'image_id'
        ], $request->input());

        $res = $row->saveOriginOrTranslation($request->input('lang'));

        if ($res) {
            return back()->with('success', __('Plano salvo'));
        }
    }

    public function bulkEdit(Request $request)
    {
        $ids = $request->input('ids');
        $actions = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return back()->with('danger', __('Por favor, selecione pelo menos 1 item!'));
        }

        foreach ($ids as $index => $id) {
            if (!isset($actions[$index])) continue;

            $query = UserPlan::where("id", $id);
            $row = $query->first();

            if (empty($row)) {
                return back()->with('danger', __('Item não encontrado!'));
            }

            switch ($actions[$index]) {
                case "delete":
                    foreach ($ids as $id) {
                        $query = UserPlan::where("id", $id);
                        $row = $query->first();
                        if (!empty($row)) {
                            $row->delete();
                        }
                    }
                    return back()->with('success', __('Deletado com sucesso!'));
                    break;
                case "gratuity":
                    foreach ($ids as $id) {
                        $query = UserPlan::where("id", $id);
                        $row = $query->first();
                        if (!empty($row)) {
                            $row->status = 1;
                            $row->save();
                        }
                    }
                    return back()->with('success', __('Atualizado com sucesso!'));
                    break;
            }
        }

        return back()->with('danger', __('Não há o que atualizar.'));
    }


    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if ($pre_selected && $selected) {
            $items = $this->planClass::find($selected);


            return [
                'results' => $items
            ];
        }
        $q = $request->query('q');
        $query = $this->planClass::select('id', 'title as text')->where("status", "publish");
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}
