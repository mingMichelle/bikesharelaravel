<?php

namespace App\Http\Controllers\Api;


use App\Criteria\HasFieldCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\PayDepositRequest;
use App\Http\Requests\PayMoneyRequest;
use App\Presenters\RiderPresenter;
use App\Presenters\UserPresenter;
use App\Repositories\RiderRepository;
use App\Repositories\UserRepository;

class UserController extends Controller {

    protected $userRepository;

    /**
     * UserController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth:api');
        $this->userRepository = $userRepository;
    }

    /**
     * 读取我的信息
     * @return mixed
     */
    public function getMyInfo(){
        $user = $this->userRepository
            ->setPresenter(app(UserPresenter::class))
            ->find(\Auth::id());
        return $user;
    }

    /**
     * 缴纳押金
     * 缴纳押金涉及到支付
     * 但是我们的项目不实现支付，所以直接使用POST请求来模拟
     * 必须采用第三方支付的回调接口的接受请求！！！
     *
     * @param PayDepositRequest $depositRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function payDeposit(PayDepositRequest $depositRequest) {
        $money = $depositRequest->get('money', 299);
        $this->userRepository->payDeposit(\Auth::id(), $money);
        return response()->json([
            'success' => 1,
            'message' => '缴纳押金成功'
        ], 200);
    }

    /**
     * 退回押金
     * 需要配合支付接口来使用
     * @return \Illuminate\Http\JsonResponse
     */
    public function backDeposit() {
        //支付的逻辑，交易完成之后才执行
        $this->userRepository->backDeposit(\Auth::id());
        return response()->json([
            'success' => 1,
            'message' => '退回押金成功'
        ], 200);
    }

    /**
     * 充值
     * @param PayMoneyRequest $moneyRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function payMoney(PayMoneyRequest $moneyRequest) {
        $money = $moneyRequest->get('money', 0);
        $this->userRepository->payMoney(\Auth::id(), $money);

        return response()->json([
            'success' => 1,
            'message' => '充值成功'
        ], 200);
    }

    /**
     * 修改密码
     * @param ChangePasswordRequest $passwordRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePasswordRequest $passwordRequest) {
        $this->userRepository->changePassword(\Auth::id(), $passwordRequest->get('password'));
        return response()->json([
            'success' => 1,
            'message' => '修改密码成功'
        ], 200);
    }

    /**
     * 返回登录用户正在骑行的记录
     * @param RiderRepository $riderRepository
     * @return mixed
     */
    public function getCurrentRider(RiderRepository $riderRepository) {
        $rider = $riderRepository
            ->setPresenter(RiderPresenter::class)
            ->pushCriteria(new HasFieldCriteria('user_id', \Auth::id()))
            ->pushCriteria(new HasFieldCriteria('is_pay', false))
            ->first();
        return $rider;
    }

    /**
     * 获取当前用户的所有骑行记录
     * @param RiderRepository $riderRepository
     * @return mixed
     */
    public function getMyRiders(RiderRepository $riderRepository) {
        $riders = $riderRepository
            ->setPresenter(app(RiderPresenter::class))
            ->pushCriteria(new HasFieldCriteria('user_id', \Auth::id()))
            ->orderBy('created_at', 'desc')
            ->paginate();
        return $riders;
    }

}