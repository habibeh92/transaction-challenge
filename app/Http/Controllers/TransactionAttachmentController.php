<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionAttachmentDownloadRequest;
use App\Interfaces\TransactionAttachmentRepositoryInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TransactionAttachmentController extends Controller
{
    private TransactionAttachmentRepositoryInterface $transactionAttachmentRepository;



    /**
     * transactionController constructor
     *
     * @param TransactionAttachmentRepositoryInterface $transactionAttachmentRepository
     */
    public function __construct(TransactionAttachmentRepositoryInterface $transactionAttachmentRepository)
    {
        $this->transactionAttachmentRepository = $transactionAttachmentRepository;
    }



    /**
     * download the attachment
     *
     * @param TransactionAttachmentDownloadRequest $request
     * @param int                                  $id
     *
     * @return BinaryFileResponse
     */
    public function download(TransactionAttachmentDownloadRequest $request, int $id): BinaryFileResponse
    {
        $attachment = $this->transactionAttachmentRepository->find($id);
        return response()->download(storage_path("app/" . $attachment->filename));
    }

}
