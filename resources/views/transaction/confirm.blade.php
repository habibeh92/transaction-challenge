<form style="float: left; display: block; margin-right: 5px"
      action="{{ route("transaction-change-status",$transaction->id) }}" method="POST">
    @csrf
    <input type="hidden" name="status"
           value="{{\App\Models\Transaction::STATUS_CONFIRMED}}">
    <button type="submit" class="btn btn-primary">confirm</button>
</form>
