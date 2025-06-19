<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
// use Illuminate\Support\Facades\Cache; // 已经通过 Setting Model 间接使用

class SettingController extends Controller
{
    /**
     * Display the site settings form.
     *
     * @return View
     */
    public function index(): View
    {
        // 从缓存或数据库获取所有设置项
        $settings = Setting::getSettingsFromCache();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the site settings in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'site_name'         => ['required', 'string', 'max:255'],
            'site_url'          => ['nullable', 'url', 'max:255'],
            'admin_email'       => ['nullable', 'email', 'max:255'],
            'enable_registration' => ['nullable', 'boolean'],
            'seo_description'   => ['nullable', 'string', 'max:255'],
            'seo_keywords'      => ['nullable', 'string', 'max:255'],
            // ... 添加其他你可能在表单中使用的设置项的规则...
        ];

        $validatedData = $request->validate($rules);

        // 处理 Checkbox 未发送的问题
        $validatedData['enable_registration'] = $request->has('enable_registration') ? 1 : 0;

        foreach ($validatedData as $key => $value) {
            $setting = Setting::firstOrCreate(['key' => $key]);
            $setting->value = $value;
            if ($key === 'enable_registration') {
                $setting->type = 'boolean';
            } else {
                $setting->type = 'string';
            }
            $setting->save();
        }

        // 刷新配置缓存：在数据库更新后，清除缓存
        Setting::forgetSettingsCache();

        return redirect()->route('admin.settings.index')->with('success', __('Settings updated successfully.'));
    }
}
