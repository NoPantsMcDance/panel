<?php

namespace Pterodactyl\Http\Controllers\Admin\Unix;

use Pterodactyl\Contracts\Repository\LocationRepositoryInterface;
use Pterodactyl\Http\Controllers\Controller;
use Pterodactyl\Models\UnixSetting;
use Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class UnixController extends Controller
{
    /**
     * @var \Pterodactyl\Contracts\Repository\LocationRepositoryInterface
     */
    protected $repository;

    /**
     * Unix Core Controller constructor.
     *
     * @param \Pterodactyl\Contracts\Repository\LocationRepositoryInterface $repository
     */
    public function __construct(
        LocationRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Switch between dark and light mode
     *
     * @return \Illuminate\View\View
     */

    public function SwitchMode()
    {
        $mode = auth()->user()->id . "_mode";

        if (Cache::has($mode)) {
            if (Cache::get($mode) == "light") {
                Cache::forget($mode);
                Cache::forever($mode, 'dark');
            } elseif (Cache::get($mode) == "dark") {
                Cache::forget($mode);
                Cache::forever($mode, 'light');
            } else {
                Cache::forget($mode);
            }
        } else {
            Cache::forever($mode, 'light');
        }

        return redirect()->back();
    }

    /**
     * Return the unix overview page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.index', [
            'locations' => $this->repository->getAllWithDetails(),
            'setting_data' => $data,
        ]);
    }

    public function background()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.background', [
            'locations' => $this->repository->getAllWithDetails(),
            'setting_data' => $data,
        ]);
    }

    public function alerts()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.alerts', [
            'locations' => $this->repository->getAllWithDetails(),
            'setting_data' => $data,
        ]);
    }

    public function login_page()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.login', [
            'locations' => $this->repository->getAllWithDetails(),
            'setting_data' => $data,
        ]);
    }

    public function connectivity()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.connect', [
            'locations' => $this->repository->getAllWithDetails(),
            'setting_data' => $data,
        ]);
    }

    public function meta()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.meta', [
            'locations' => $this->repository->getAllWithDetails(),
            'setting_data' => $data,
        ]);
    }

    /**
     * Return the admin Email index view.
     */
    public function email()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.mail');
    }

    public function send()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        if (isset($_POST['receiver'])) {
            $this->EmailUser($_POST['receiver'], $_POST['name'], $_POST['intro'], $_POST['outro'], $_POST['button_name'], $_POST['button_url']);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function EmailUser($receiver, $name, $intro, $outro, $button_name, $button_url)
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        $this->receiver = $receiver;
        $this->name = $name;
        $this->sender = config('mail.from.address');
        $this->sender_name = config('mail.from.name');

        $data = array(
            'name' => $name,
            'intro' => $intro,
            'outro' => $outro,
            'button_name' => $button_name,
            'button_url' => $button_url,
        );

        Mail::send('partials.emails.mail', $data, function ($message) {
            $message->to($this->receiver, $this->name)->subject
            (config('mail.from.name'));

            $message->from($this->sender, $this->sender_name);
        });
    }

    public function advanced()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.advanced', [
            'locations' => $this->repository->getAllWithDetails(),
            'setting_data' => $data,
        ]);
    }

    public function support()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) || !$upd->resp) {
            return redirect(route('admin.unix.update'));
        }

        return view('admin.unix.support', [
            'locations' => $this->repository->getAllWithDetails(),
        ]);
    }

    public function updates()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        return view('admin.unix.update', [
            'locations' => $this->repository->getAllWithDetails(),
            'setting_data' => $data,
            'check' => $this->license(),
        ]);
    }

    public function license()
    {
        $setting = new UnixSetting();
        $data = [];
        foreach ($setting->all() as $key => $value) {
            $data[$value->name] = $value->value;
        }

        $key = (isset($data['l_key']) ? $data['l_key'] : 'U_123');
        $serverip = $_SERVER['SERVER_ADDR'];
        $serverurl = parse_url(config('app.url'))['host'];
        $lmc = 'lic' . 'ense';

        $upd = Http::get('https://vertisanpro.com/api/unix/' . $lmc . '/' . $key . '/' . $serverip . '/' . $serverurl)->object();

        if (!isset($upd->resp) or !$upd->resp) {
            return 'Inactive';
        } else {
            return 'Active';
        }
    }
}