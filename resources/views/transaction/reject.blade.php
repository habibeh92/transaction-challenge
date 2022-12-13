<form action="{{ route("transaction-change-status",$transaction->id) }}" method="POST">
    @csrf
    <input type="hidden" name="status"
           value="{{\App\Models\Transaction::STATUS_REJECTED}}">
    <button type="submit" class="btn btn-danger">reject</button>
</form>
