<?php

namespace App\Http\Controllers\Api\V1;

use App\Utils\Helpers;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use function App\Utils\translate;

class BrandController extends Controller
{
    public function __construct(
        private Brand $brand
    )
    {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getIndex(Request $request): JsonResponse
    {

        $limit = $request['limit'] ?? 10;
        $offset = $request['offset'] ?? 1;

        $brands = $this->brand->latest()->paginate($limit, ['*'], 'page', $offset);
        $data = [
            'total' => $brands->total(),
            'limit' => $limit,
            'offset' => $offset,
            'brands' => $brands->items()
        ];

        return response()->json($data, 200);
    }

    /**
     * @param Request $request
     * @param Brand $brand
     * @return JsonResponse
     */
    public function postStore(Request $request, Brand $brand): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:brands,name',
                'image' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => Helpers::error_processor($validator)], 403);
            }

            if (!empty($request->file('image'))) {
                $imageName = Helpers::upload('brand/', 'png', $request->file('image'));
            } else {
                $imageName = 'def.png';
            }

            $brand = $this->brand;
            $brand->name = $request->name;
            $brand->image = $imageName;
            $brand->save();
            return response()->json([
                'success' => true,
                'message' => translate('Brand saved successfully'),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => translate('Brand not saved')
            ], 403);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function postUpdate(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required|unique:brands,name,'. $request->id,
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => Helpers::error_processor($validator)], 403);
            }

            $brand = $this->brand->findOrFail($request->id);
            $brand->name = $request->name;
            $brand->image = $request->has('image') ? Helpers::update('brand/', $brand->image, 'png', $request->file('image')) : $brand->image;
            $brand->save();
            return response()->json([
                'success' => true,
                'message' => translate('Brand updated successfully'),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => translate('Brand not updated')
            ], 403);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        try {
            $brand = $this->brand->findOrFail($request->id);
            Helpers::delete('brand/' . $brand['image']);
            $brand->delete();
            return response()->json(
                ['success' => true, 'message' => translate('Brand deleted successfully'),],
                200
            );
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => translate('Brand not deleted')
            ], 403);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getSearch(Request $request): JsonResponse
    {
        $limit = $request['limit'] ?? 10;
        $offset = $request['offset'] ?? 1;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $brands = $this->brand->where('name', 'LIKE', '%' . $request->name . '%')->latest()->paginate($limit, ['*'], 'page', $offset);
        $data = [
            'total' => $brands->total(),
            'limit' => $limit,
            'offset' => $offset,
            'brands' => $brands->items()
        ];
        return response()->json($data, 200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function updateStatus(Request $request): JsonResponse
    {
        $brand = $this->brand->find($request->id);
        $brand->status = !$brand['status'];
        $brand->update();
        return response()->json([
            'message' => translate('Status updated successfully'),
        ], 200);
    }

}
