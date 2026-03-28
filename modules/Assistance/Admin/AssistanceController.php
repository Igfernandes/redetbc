<?php
namespace Modules\Assistance\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\AdminController;
use Modules\Core\Events\CreatedServicesEvent;
use Modules\Core\Events\UpdatedServiceEvent;
use Modules\Core\Models\Attributes;
use Modules\Location\Models\LocationCategory;
use Modules\Assistance\Hook;
use Modules\Assistance\Models\AssistanceTerm;
use Modules\Assistance\Models\Assistance;
use Modules\Assistance\Models\AssistanceCategory;
use Modules\Assistance\Models\AssistanceTranslation;
use Modules\Location\Models\Location;

class AssistanceController extends AdminController
{
    protected $assistanceClass;
    protected $assistanceTranslationClass;
    protected $assistanceCategoryClass;
    protected $assistanceTermClass;
    protected $attributesClass;
    protected $locationClass;
    /**
     * @var string
     */
    private $locationCategoryClass;

    public function __construct()
    {
        $this->setActiveMenu(route('assistance.admin.index'));
        $this->assistanceClass = Assistance::class;
        $this->assistanceTranslationClass = AssistanceTranslation::class;
        $this->assistanceCategoryClass = AssistanceCategory::class;
        $this->assistanceTermClass = AssistanceTerm::class;
        $this->attributesClass = Attributes::class;
        $this->locationClass = Location::class;
        $this->locationCategoryClass = LocationCategory::class;
    }

    public function index(Request $request)
    {
        $this->checkPermission('assistance_view');
        $query = $this->assistanceClass::query();
        $query->orderBy('id', 'desc');
        if (!empty($assistance_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $assistance_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($cate = $request->input('cate_id'))) {
            $query->where('category_id', $cate);
        }
        if (!empty($is_featured = $request->input('is_featured'))) {
            $query->where('is_featured', 1);
        }
        if (!empty($location_id = $request->query('location_id'))) {
            $query->where('location_id', $location_id);
        }
        if ($this->hasPermission('assistance_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('author_id', $author);
            }
        } else {
            $query->where('author_id', Auth::id());
        }
        $data = [
            'rows'               => $query->with([
                'author',
                'category_assistance'
            ])->paginate(20),
            'assistance_categories'    => $this->assistanceCategoryClass::where('status', 'publish')->get()->toTree(),
            'assistance_manage_others' => $this->hasPermission('assistance_manage_others'),
            'page_title'         => __("Gerenciamento de Serviços"),
            'breadcrumbs'        => [
                [
                    'name' => __('Serviços'),
                    'url'  => route('assistance.admin.index')
                ],
                [
                    'name'  => __('Todos'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Assistance::admin.index', $data);
    }

    public function recovery(Request $request)
    {
        $this->checkPermission('assistance_view');
        $query = $this->assistanceClass::onlyTrashed();
        $query->orderBy('id', 'desc');
        if (!empty($assistance_name = $request->input('s'))) {
            $query->where('title', 'LIKE', '%' . $assistance_name . '%');
            $query->orderBy('title', 'asc');
        }
        if (!empty($cate = $request->input('cate_id'))) {
            $query->where('category_id', $cate);
        }
        if ($this->hasPermission('assistance_manage_others')) {
            if (!empty($author = $request->input('vendor_id'))) {
                $query->where('author_id', $author);
            }
        } else {
            $query->where('author_id', Auth::id());
        }
        $data = [
            'rows'               => $query->with([
                'author',
                'category_assistance'
            ])->paginate(20),
            'assistance_categories'    => $this->assistanceCategoryClass::where('status', 'publish')->get()->toTree(),
            'assistance_manage_others' => $this->hasPermission('assistance_manage_others'),
            'page_title'         => __("Recuperação Gerenciamento de Serviços"),
            'recovery'           => 1,
            'breadcrumbs'        => [
                [
                    'name' => __('Serviços'),
                    'url'  => route('assistance.admin.index')
                ],
                [
                    'name'  => __('Recuperação'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Assistance::admin.index', $data);
    }

    public function create(Request $request)
    {
        $this->checkPermission('assistance_create');
        $row = new Assistance();
        $row->fill([
            'status' => 'publish'
        ]);
        $data = [
            'row'               => $row,
            'attributes'        => $this->attributesClass::where('service', 'assistance')->get(),
            'assistance_category'     => $this->assistanceCategoryClass::where('status', 'publish')->get()->toTree(),
            'assistance_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'translation'       => new $this->assistanceTranslationClass(),
            'breadcrumbs'       => [
                [
                    'name' => __('Serviços'),
                    'url'  => route('assistance.admin.index')
                ],
                [
                    'name'  => __('Adicionar Serviço'),
                    'class' => 'active'
                ],
            ]
        ];
        return view('Assistance::admin.detail', $data);
    }

    public function edit(Request $request, $id)
    {
        $this->checkPermission('assistance_update');
        $row = $this->assistanceClass::find($id);
        if (empty($row)) {
            return redirect(route('assistance.admin.index'));
        }
        $translation = $row->translate($request->query('lang',get_main_lang()));
        if (!$this->hasPermission('assistance_manage_others')) {
            if ($row->author_id != Auth::id()) {
                return redirect(route('assistance.admin.index'));
            }
        }
        $data = [
            'row'               => $row,
            'translation'       => $translation,
            "selected_terms"    => $row->assistance_term->pluck('term_id'),
            'attributes'        => $this->attributesClass::where('service', 'assistance')->get(),
            'assistance_category'     => $this->assistanceCategoryClass::where('status', 'publish')->get()->toTree(),
            'assistance_location'     => $this->locationClass::where('status', 'publish')->get()->toTree(),
            'location_category' => $this->locationCategoryClass::where("status", "publish")->get(),
            'enable_multi_lang' => true,
            'breadcrumbs'       => [
                [
                    'name' => __('Serviços'),
                    'url'  => route('assistance.admin.index')
                ],
                [
                    'name'  => __('Editar Serviço'),
                    'class' => 'active'
                ],
            ],
            'page_title'=>__('Editar Serviço')
        ];
        return view('Assistance::admin.detail', $data);
    }

    public function store(Request $request, $id)
    {

        if (is_demo_mode()) {
            return redirect()->back()->with('danger', __("MODO DEMO: não é possível adicionar dados"));
        }
        if ($id > 0) {
            $this->checkPermission('assistance_update');
            $row = $this->assistanceClass::find($id);
            if (empty($row)) {
                return redirect(route('assistance.admin.index'));
            }
            if ($row->author_id != Auth::id() and !$this->hasPermission('assistance_manage_others')) {
                return redirect(route('assistance.admin.index'));
            }
        } else {
            $this->checkPermission('assistance_create');
            $row = new $this->assistanceClass();
            $row->status = "publish";
        }
        if(!empty($request->input('enable_fixed_date'))){
            $rules = [
                'start_date'        =>'required|date',
                'end_date'         =>'required|date|after_or_equal:start_date',
                'last_booking_date' =>'required|date|before:start_date|after:'.now(),
            ];
            $request->validate($rules);
        }

        $row->fill($request->input());
        if ($request->input('slug')) {
            $row->slug = $request->input('slug');
        }
        $row->ical_import_url = $request->ical_import_url;
        $row->author_id = $request->input('author_id');
        $row->default_state = $request->input('default_state', 1);
        $row->enable_service_fee = $request->input('enable_service_fee');
        $row->service_fee = $request->input('service_fee');
        $res = $row->saveOriginOrTranslation($request->input('lang'), true);

        if ($res) {
            if (!$request->input('lang') or is_default_lang($request->input('lang'))) {
                $this->saveTerms($row, $request);
                $row->saveMeta($request);
            }

            do_action(Hook::AFTER_SAVING,$row,$request);

            if ($id > 0) {
                event(new UpdatedServiceEvent($row));
                return back()->with('success', __('Serviço atualizado'));
            } else {
                event(new CreatedServicesEvent($row));
                return redirect(route('assistance.admin.edit', $row->id))->with('success', __('Serviço criado'));
            }
        }
    }

    public function saveTerms($row, $request)
    {
        if (empty($request->input('terms'))) {
            $this->assistanceTermClass::where('assistance_id', $row->id)->delete();
        } else {
            $term_ids = $request->input('terms');
            foreach ($term_ids as $term_id) {
                $this->assistanceTermClass::firstOrCreate([
                    'term_id' => $term_id,
                    'assistance_id' => $row->id
                ]);
            }
            $this->assistanceTermClass::where('assistance_id', $row->id)->whereNotIn('term_id', $term_ids)->delete();
        }
    }

    public function bulkEdit(Request $request)
    {

        $ids = $request->input('ids');
        $action = $request->input('action');
        if (empty($ids) or !is_array($ids)) {
            return redirect()->back()->with('error', __('Nenhum item selecionado!'));
        }
        if (empty($action)) {
            return redirect()->back()->with('error', __('Selecione uma ação!'));
        }
        switch ($action) {
            case "delete":
                foreach ($ids as $id) {
                    $query = $this->assistanceClass::where("id", $id);
                    if (!$this->hasPermission('assistance_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('assistance_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->delete();
                        event(new UpdatedServiceEvent($row));
                    }
                }
                return redirect()->back()->with('success', __('Excluído com sucesso!'));
                break;
            case "permanently_delete":
                foreach ($ids as $id) {
                    $query = $this->assistanceClass::where("id", $id);
                    if (!$this->hasPermission('assistance_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('assistance_delete');
                    }
                    $row = $query->withTrashed()->first();
                    if ($row) {
                        $row->forceDelete();
                    }
                }
                return redirect()->back()->with('success', __('Excluir permanentemente com sucesso!'));
                break;
            case "recovery":
                foreach ($ids as $id) {
                    $query = $this->assistanceClass::withTrashed()->where("id", $id);
                    if (!$this->hasPermission('assistance_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('assistance_delete');
                    }
                    $row = $query->first();
                    if (!empty($row)) {
                        $row->restore();
                        event(new UpdatedServiceEvent($row));
                    }
                }
                return redirect()->back()->with('success', __('Recuperação bem-sucedida!'));
                break;
            case "clone":
                $this->checkPermission('assistance_create');
                foreach ($ids as $id) {
                    (new $this->assistanceClass())->saveCloneByID($id);
                }
                return redirect()->back()->with('success', __('Duplicar realizado com sucesso!'));
                break;
            default:
                // Change status
                foreach ($ids as $id) {
                    $query = $this->assistanceClass::where("id", $id);
                    if (!$this->hasPermission('assistance_manage_others')) {
                        $query->where("create_user", Auth::id());
                        $this->checkPermission('assistance_update');
                    }
                    $row = $query->first();
                    $row->status = $action;
                    $row->save();
                    event(new UpdatedServiceEvent($row));
                }
                return redirect()->back()->with('success', __('Atualização bem-sucedida!'));
                break;
        }
    }

    public function getForSelect2(Request $request)
    {
        $pre_selected = $request->query('pre_selected');
        $selected = $request->query('selected');
        if ($pre_selected && $selected) {
            if (is_array($selected)) {
                $items = $this->assistanceClass::select('id', 'title as text')->whereIn('id', $selected)->take(50)->get();

            } else {
                $items = $this->assistanceClass::find($selected);
            }

            return [
                'results'=>$items
            ];
        }
        $q = $request->query('q');
        $query = $this->assistanceClass::select('id', 'title as text')->where("status", "publish");
        if ($q) {
            $query->where('title', 'like', '%' . $q . '%');
        }
        $res = $query->orderBy('id', 'desc')->limit(20)->get();
        return $this->sendSuccess([
            'results' => $res
        ]);
    }
}
