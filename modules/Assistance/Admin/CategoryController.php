<?php
namespace Modules\Assistance\Admin;

use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Assistance\Hook;
use Modules\Assistance\Models\AssistanceCategory;
use Modules\Assistance\Models\AssistanceCategoryTranslation;

class CategoryController extends AdminController
{
    protected $assistanceCategoryClass;
    public function __construct()
    {
        $this->setActiveMenu(route('assistance.admin.index'));
        $this->assistanceCategoryClass = AssistanceCategory::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('assistance_manage_others');
        $listCategory = $this->assistanceCategoryClass::query();
        if (!empty($search = $request->query('s'))) {
            $listCategory->where('name', 'LIKE', '%' . $search . '%');
        }
        $listCategory->orderBy('created_at', 'desc');
        $data = [
            'rows'        => $listCategory->get()->toTree(),
            'row'         => new $this->assistanceCategoryClass(),
            'translation'    => new AssistanceCategoryTranslation(),
            'breadcrumbs' => [
                [
                    'name' => __('Serviços'),
                    'url'  => route('assistance.admin.index')
                ],
                [
                    'name'  => __('Categoria'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Assistance::admin.category.index', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('assistance_manage_others');
        $row = $this->assistanceCategoryClass::find($id);
        if (empty($row)) {
            return redirect(route('assistance.admin.category.index'));
        }
        $translation = $row->translate($request->query('lang',get_main_lang()));
        $data = [
            'translation'    => $translation,
            'enable_multi_lang'=>true,
            'row'         => $row,
            'parents'     => $this->assistanceCategoryClass::get()->toTree(),
            'breadcrumbs' => [
                [
                    'name' => __('Serviços'),
                    'url'  => route('assistance.admin.index')
                ],
                [
                    'name'  => __('Categoria'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Assistance::admin.category.detail', $data);
    }

    public function store(Request $request , $id)
    {
        $this->checkPermission('assistance_manage_others');
        $this->validate($request, [
            'name' => 'required'
        ]);
        if($id>0){
            $row = $this->assistanceCategoryClass::find($id);
            if (empty($row)) {
                return redirect(route('assistance.admin.category.index'));
            }
        }else{
            $row = new $this->assistanceCategoryClass();
            $row->status = "publish";
        }

        $row->fill($request->input());
        $res = $row->saveOriginOrTranslation($request->input('lang'),true);

        if ($res) {
            do_action(Hook::AFTER_SAVING_CATEGORY,$row,$request);
            return back()->with('success',  __('Categoria salva') );
        }
    }

    public function bulkEdit(Request $request)
    {
        $this->checkPermission('assistance_manage_others');
        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Selecione pelo menos 1 item!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Selecione uma ação!'));
        }
        if ($action == "delete") {
            foreach ($ids as $id) {
                $query = $this->assistanceCategoryClass::where("id", $id)->first();
                if(!empty($query)){
                    //Sync child category
                    $list_childs = $this->assistanceCategoryClass::where("parent_id", $id)->get();
                    if(!empty($list_childs)){
                        foreach ($list_childs as $child){
                            $child->parent_id = null;
                            $child->save();
                        }
                    }
                    //Del parent category
                    $query->delete();
                }
            }
        } else {
            foreach ($ids as $id) {
                $query = $this->assistanceCategoryClass::where("id", $id);
                $query->update(['status' => $action]);
            }
        }
        return redirect()->back()->with('success', __('Atualizado com sucesso!'));
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');

        if($pre_selected && $selected){
            $items = $this->assistanceCategoryClass::find($selected);


            return [
                'results'=>$items
            ];
        }
        $q = $request->query('q');
        $query = $this->assistanceCategoryClass::select('id', 'name as text')->where("status","publish");
        if ($q) {
            $query->where('name', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return response()->json([
            'results' => $res
        ]);
    }
}