<?php

namespace App\Repositories;

use App\Interfaces\TransactionAttachmentRepositoryInterface;
use App\Models\TransactionAttachment;

class TransactionAttachmentRepository implements TransactionAttachmentRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function find(int $id): TransactionAttachment
    {
        return TransactionAttachment::whereId($id)->firstOrNew();
    }
}
