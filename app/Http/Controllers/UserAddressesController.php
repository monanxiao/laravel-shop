<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Http\Requests\UserAddressRequest;

class UserAddressesController extends Controller
{
    // 收货列表
    public function index(Request $request)
    {
        return view('user_addresses.index', [
            'addresses' => $request->user()->addresses,// 当前登录用户的所有收货地址
        ]);
    }

    // 添加收货地址
    public function create()
    {
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }

    // 接受添加收货地址 表单参数
    public function store(UserAddressRequest $request)
    {
        // 当前登录用户 调用关联方法 创建实例入库
        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

    // 修改收货地址
    public function edit(UserAddress $user_address)
    {

        return view('user_addresses.create_and_edit', ['address' => $user_address]);
    }

    // 接收收货地址更新数据
    public function update(UserAddress $user_address, UserAddressRequest $request)
    {
        // 隐形绑定参数实例更新数据
        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));

        return redirect()->route('user_addresses.index');
    }

}
