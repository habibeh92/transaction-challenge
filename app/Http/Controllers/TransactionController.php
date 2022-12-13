<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionCreateRequest;
use App\Http\Requests\TransactionStatusChangeRequest;
use App\Http\Requests\TransactionListRequest;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * @var TransactionRepositoryInterface
     */
    private TransactionRepositoryInterface $transactionRepository;

    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;



    /**
     * transactionController constructor
     *
     * @param TransactionRepositoryInterface $transactionRepository
     * @param UserRepositoryInterface        $userRepository
     */
    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository        = $userRepository;
    }



    /**
     * get the transaction 'list
     *
     * @param TransactionListRequest $request
     *
     * @return View
     */
    public function transactionsList(TransactionListRequest $request): View
    {
        return view("transaction/list", ["transactions" => $this->transactionRepository->paginate()]);
    }



    /**
     * transaction form
     *
     * @return View
     */
    public function getForm(): View
    {
        return view("transaction/transactionForm",
            ["users" => $this->userRepository->listExcept(auth()->user(), ["id", "name"])]);
    }



    /**
     * create the transaction
     *
     * @param TransactionCreateRequest $request
     *
     * @return RedirectResponse
     */
    public function create(TransactionCreateRequest $request): RedirectResponse
    {
        DB::transaction(function () use ($request) {
            $this->transactionRepository->create(array_merge($request->except("files"), [
                "from_user_id" => auth()->user()->id,
            ]));
            $this->transactionRepository->attachFiles($request->file("files") ?? []);
        });

        return redirect()->back()->with('message', 'Transaction created successfully')
        ;
    }



    /**
     * confirm transaction by admin
     *
     * @param TransactionStatusChangeRequest $request
     * @param int                            $id
     *
     * @return RedirectResponse
     */
    public function changeStatus(TransactionStatusChangeRequest $request, int $id): RedirectResponse
    {
        $this->transactionRepository->changeStatus($id, $request->status);

        return redirect()->back();
    }
}
