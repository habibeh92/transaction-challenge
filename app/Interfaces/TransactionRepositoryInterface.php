<?php

namespace App\Interfaces;


use App\Models\Transaction;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TransactionRepositoryInterface
{
    /**
     * get the array of transaction's list
     *
     * @return LengthAwarePaginator
     */
    public function paginate();



    /**
     * create new transaction by user
     *
     * @param array $data
     *
     * @return Transaction
     */
    public function create(array $data): Transaction;



    /**
     * attach files to model
     *
     * @param array $files
     *
     * @return bool
     */
    public function attachFiles(array $files): bool;



    /**
     * confirm the transaction by admin
     *
     * @param int    $id
     * @param string $status
     *
     * @return bool
     */
    public function changeStatus(int $id, string $status): bool;

}
