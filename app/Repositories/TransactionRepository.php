<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use App\Models\TransactionAttachment;
use Illuminate\Http\UploadedFile;

class TransactionRepository implements TransactionRepositoryInterface
{

    /**
     * @var Transaction
     */
    private Transaction $model;



    /**
     * TransactionRepository constructor
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }



    /**
     * @inheritDoc
     */
    public function paginate()
    {
        return $this->model->with(["fromUser", "toUser", "attachments"])->paginate(10)
        ;

    }



    /**
     * @inheritDoc
     */
    public function create($data): Transaction
    {
        return $this->model = $this->model->create($data);
    }



    /**
     * @inheritDoc
     */
    public function changeStatus($id, $status): bool
    {
        return $this->model->where("id", $id)->update([
            "status" => $status,
        ])
        ;
    }



    /**
     * @inheritDoc
     */
    public function attachFiles(array $files): bool
    {
        /** @var UploadedFile $file */
        foreach ($files as $file) {
            /** @var TransactionAttachment $saved */
            $saved = $this->model->attachments()->create([
                "filename"      => $file->store("attachments"),
                "original_name" => $file->getClientOriginalName(),
            ]);
            if (!$saved->exists) {
                return false;
            }
        }
        return true;
    }
}
