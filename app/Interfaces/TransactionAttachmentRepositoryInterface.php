<?php

namespace App\Interfaces;

use App\Models\TransactionAttachment;

interface TransactionAttachmentRepositoryInterface
{

    /**
     * find transaction by id
     *
     * @param int $id
     *
     * @return TransactionAttachment
     */
    public function find(int $id): TransactionAttachment;

}
