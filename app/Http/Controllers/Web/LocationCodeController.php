<?php

namespace Vanguard\Http\Controllers\Web;

use Illuminate\Http\Request;
use Vanguard\Http\Controllers\Controller;
use Vanguard\LocationCode;

use Vanguard\Repositories\LocationCode\LocationCodeRepository;
use Vanguard\Http\Requests\LocationCode\CreateLocationCodeRequest;
use Vanguard\Http\Requests\LocationCode\UpdateLocationCodeRequest;

class LocationCodeController extends Controller
{
    private $locationCodes;
    private $breadcrumbs;

    public function __construct(LocationCodeRepository $locationCodes)
    {
        $this->locationCodes = $locationCodes;

    }

    public function index(LocationCodeRepository $locationCodes)
    {
        $locationCode = $locationCodes->paginate(30, 0, ['children.children.children']);

        return view('location-code.index', [
            'parentLocationCode' => null,
            'locationCodes' => $locationCode
        ]);
    }

    public function show(LocationCode $locationCode)
    {
        return view('cpp.application-settings.location-code.index', [
            'parentLocationCode' => $locationCode,
            'locationCodes' => $this->getLocationCodeCollection($locationCode->code),
            'breadcrumbs' => $this->getBreadcrumbs($locationCode)
        ]);
    }

    public function create(Request $request)
    {
        $parentLocationCode = $this->locationCodes->findBy('code', $request->parent_code);

        $province = null;
        $district = null;
        $commune = "";
        $locationLabel = __('រាជធានី ឬ ខេត្ត');
        $locationCodeType = null;

        $this->breadcrumbs[0]['isActive'] = false;

        return view('location-code.add-edit', [
            'province' => $province,
            'district' => $district,
            'commune' => $commune,
            'locationLabel' => $locationLabel,
            'locationCodeType' => $locationCodeType,
            'breadcrumbs' => $this->getBreadcrumbs($parentLocationCode, true),
        ]);
    }

    public function store(CreateLocationCodeRequest $request)
    {
//        dd($request);
        $locationCode = $this->locationCodes->create($request->all());

        if ($locationCode->parent_code) {
            return redirect()->route('location.show', $locationCode->parent)->withSuccess(__('បង្កើតលេខកូដតំបន់បានជោគជ័យ'));
        }

        return redirect()->route('location.index')->withSuccess(__('បង្កើតលេខកូដតំបន់បានជោគជ័យ'));
    }

    public function edit($id)
    {
        $locationCode = $this->locationCodes->find($id);
        return view('location-code.add-edit', [
            'locationCode' => $locationCode
        ]);
    }

    public function update($id, UpdateLocationCodeRequest $request)
    {
        $this->locationCodes->update($id, $request->all());

//        if ($locationCode->parent_code) {
//            return redirect()->route('settings.location-codes.show', $locationCode->parent)->withSuccess(__('កែប្រែលេខកូដតំបន់បានជោគជ័យ'));
//        }

        return redirect()->route('location.index')->withSuccess(__('កែប្រែលេខកូដតំបន់បានជោគជ័យ'));
    }

    public function destroy($id)
    {
        $this->locationCodes->delete($id);
        return redirect()->back()->withSuccess(__('លុបតំបន់បានជោគជ័យ'));
    }

    public function import(Request $request)
    {
        $response = $this->locationCodes->import($request->file('files'));
        dd($response);
        return response()->json($response);
    }

    private function getLocationCodeCollection($parentCode = 0)
    {

        return $this->locationCodes->paginate(30, $parentCode, ['children.children.children']);
    }

    private function getBreadcrumbs(LocationCode $locationCode = null, $addEditPage = false)
    {
        if ($locationCode) {
            if ($locationCode->parent) {
                $this->getBreadcrumbs($locationCode->parent, $addEditPage);
            }

            $prefix = '';
            switch ($locationCode->type) {
                case LocationCode::DISTRICT :
                    $prefix = 'ខណ្ឌ ឬ ក្រុង ឬ ស្រុក';
                    break;
                case LocationCode::COMMUNE :
                    $prefix = 'សង្កាត់ ឬ ឃុំ';
                    break;
                case LocationCode::VILLAGE :
                    $prefix = 'ភូមិ';
                    break;
                default:
                    $prefix = 'រាជធានី ឬ ខេត្ត';
                    break;
            }

            $this->breadcrumbs[] = ['label' => $prefix . ' ' . $locationCode->name, 'link' => route('settings.location-codes.show', $locationCode->id), 'isActive' => true];
            $this->breadcrumbs[count($this->breadcrumbs) - ($addEditPage ? 1 : 2)]['isActive'] = false;
        }

        return $this->breadcrumbs;
    }

    public function ajaxGetChildren(Request $request)
    {
        try {
            return response()->json([
                'success' => true,
                'data' => LocationCode::where('parent_code', $request->get('parentCode', 0))->get()
            ]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()]);
        }
    }
}