<?php

namespace App\Http\Controllers\api\setting;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\traits\ApiResponse;
use App\traits\ImagesOperations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class SettingsController extends Controller
{
    use ImagesOperations;
    use ApiResponse;

    function changeLogo(Request $request)
    {
        try {

            $validator = Validator::make($request->only(['logo']), [
                'logo' => ['required', 'image']
            ]);
            if ($validator->fails()) {
                return $this->apiResponse('', $validator->errors(), 400);
            }

            $logo = SiteSetting::query()->latest()->first();
            if (isset($logo->id)) {
                if ($logo->logo_path) {
                    $logo_path = $this->replaceFile($logo->logo_path, $request->logo, 'images/logo');
                } else {
                    $logo_path = $this->storeFile($request->logo, 'images/logo');
                }
                $logo->logo_path = $logo_path;
                $logo->save();
            } else {
                $logo_path = $this->storeFile($request->logo, 'images/logo');
                $logo = SiteSetting::create([
                    'logo_path' => $logo_path
                ]);
            }
            return $this->apiResponse($logo->logo_path, 'success', 200);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return $this->apiResponse(null, $e->getMessage(), 400);
        }

    }

    function updateInfo(Request $request)
    {
        try {



            $validator = Validator::make($request->all(), [
                'name_en' => ['required', 'string', 'min:1', 'max:100'],
                'name_ar' => ['required', 'string', 'min:1', 'max:100'],
                'name_ku' => ['required', 'string', 'min:1', 'max:100'],
                'description_en' => ['required', 'string', 'min:1', 'max:250'],
                'description_ar' => ['required', 'string', 'min:1', 'max:250'],
                'description_ku' => ['required', 'string', 'min:1', 'max:250'],
                'show_name' => ['nullable', Rule::in(['on'])],

            ]);
            if ($validator->fails()) {
                return $this->apiResponse('', $validator->errors(), 400);
            }

            $settings = SiteSetting::query()->latest()->first();
            if (isset($settings->id)) {
                $settings->name_en = $request->name_en;
                $settings->name_ar = $request->name_ar;
                $settings->name_ku = $request->name_ku;
                $settings->description_en = $request->description_en;
                $settings->description_ar = $request->description_ar;
                $settings->description_ku = $request->description_ku;
                $settings->show_name = $request->show_name?1:0;
                $settings->show_logo = $request->show_logo?1:0;
                $settings->save();
            } else {

                $settings = SiteSetting::create([
                    'name_en' => $request->name_en,
                    'name_ar' => $request->name_ar,
                    'name_ku' => $request->name_ku,
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                    'description_ku' => $request->description_ku,
                    'show_name' =>  $request->show_name?1:0,
                    'show_logo' =>  $request->show_logo?1:0
                ]);
            }
            return $this->apiResponse($settings, 'success', 200);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return $this->apiResponse(null, $e->getMessage(), 400);
        }
    }
}
