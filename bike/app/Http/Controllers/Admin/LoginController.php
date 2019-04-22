<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use function PHPSTORM_META\elementType;

class LoginController extends Controller {
    /**
     * 渲染管理員登錄界面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLogin() {
        return view('admin.login');
    }

    /**
     * 登錄操作
     * @param AdminLoginRequest $loginRequest
     * @return mixed
     */
    public function postLogin(AdminLoginRequest $loginRequest) {
        $data = $loginRequest->only('name', 'password');
        // 认证  remember 记住
        $result = \Auth::guard('admin')->attempt($data, true);

        if ($result) {
            return redirect(route('admin.home'));
        } else {
            return redirect()->back()
                ->with('name', $loginRequest->get('name'))
                ->withErrors(['name'=>'用户名或者密码错误']);
        }
    }

    /**
     * 登出
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postLogout() {

        \Auth::guard('admin')->logout();
        return redirect(route('admin.login.show'));
    }
}