<?php

namespace Pterodactyl\Http\Controllers\Admin\Unix;

use Illuminate\Support\Facades\Http;
use Pterodactyl\Contracts\Repository\LocationRepositoryInterface;
use Pterodactyl\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Pterodactyl\Models\UnixSetting;

class UnixSettingController extends Controller
{
    /**
     * @var \Pterodactyl\Contracts\Repository\LocationRepositoryInterface
     */
    protected $repository;

    /**
     * LocationController constructor.
     *
     * @param \Pterodactyl\Contracts\Repository\LocationRepositoryInterface $repository
     */
    public function __construct(
        LocationRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Return the unix overview page.
     *
     * @return \Illuminate\View\View
     */
    public function settingSubmit(Request $req)
    {
        foreach ($req->input() as $key => $value) {
            if ($key == '_token') {
                continue;
            }
            if (count($setting = UnixSetting::where('name', $key)->get('id'))) {
                $setting = UnixSetting::find($setting[0]['id']);
                $setting->name = $key;
                $setting->value = $req->input($key);
            } else {
                $setting = new UnixSetting();
                $setting->name = $key;
                $setting->value = $req->input($key);
            }
            $setting->save();
        }
        return redirect()->back();
    }
}