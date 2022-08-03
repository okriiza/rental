<!-- Modal -->
<div class="modal fade" id="addItem" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('transaction.addItemCart') }}" method="POST">
                @csrf
                @method('GET')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <select class="form-control units" name="units" id="units" required>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->id }}">{{ $item->name_unit }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rental_date">Tanggal Sewa </label>
                                <input type="date" class="form-control rental_date" name="rental_date"
                                    id="rental_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rental_time">Waktu (Hari)</label>
                                <input type="number" class="form-control rental_time" name="rental_time"
                                    id="rental_time" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
