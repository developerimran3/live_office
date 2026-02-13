<div class="midde_cont">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Bond Licence</h2>
                </div>
            </div>
        </div>

        <div class="row column1">

            <!-- Licence Form -->
            <div class="col-md-5">
                <div class="white_shd full p-4">
                    <div class="heading1 margin_0">
                        <h2>Licence Details</h2>
                        <hr class="m-0">
                    </div>

                    <form wire:submit.prevent="bondlicence">
                        <div class="row">

                            <div class="col-md-7">
                                <label for="goods_name">Goods Name</label>
                                <select class="form-control" wire:model="goods_name">
                                    <option value="">Select</option>
                                    <option value="ARTIFICIAL LEATHER">ARTIFICIAL LEATHER</option>
                                    <option value="BUCKLE">BUCKLE</option>
                                    <option value="RIVET/EYELT">RIVET/EYELT</option>
                                    <option value="INTERLINING">INTERLINING</option>
                                    <option value="ZIPPER">ZIPPER</option>
                                    <option value="SLIDER">SLIDER</option>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label for="availability">M.T/GG SET</label>
                                <input type="number" wire:model="availability" name="availability"
                                    class="form-control">
                            </div>

                            <div class="col-md-12 my-3">
                                <button type="submit" class="main_bt w-100">Create</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Tables -->
            <div class="col-md-7">
                <div class="white_shd full p-4">
                    <div class="heading1 m-0 p-0">

                        <div class="card p-3">

                            <!-- Filter Item -->
                            <div class="col-md-6">
                                <label>Filter Item</label>
                                <select class="form-control" wire:model="filter_item" wire:change="loadData">
                                    <option value="">All Items</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <!-- Allocation Table -->
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5>Allocation Table</h5>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Goods Name</th>
                                                <th>Allocation</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allocations as $alloc)
                                                <tr>
                                                    <td>{{ $alloc->goods_name }}</td>
                                                    <td>{{ number_format($alloc->availability, 3) }}</td>
                                                    <td>{{ $alloc->created_at->format('d/m/Y H:i') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Minus Tables -->
                            @foreach ($minus_tables as $item_name => $rows)
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <div class="card p-3" style="max-height:300px; overflow-y:auto;">
                                            <h5>{{ $item_name }} Minus Table</h5>
                                            <table class="table table-bordered table-striped mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>BE No</th>
                                                        <th>BE Date</th>
                                                        <th>Used</th>
                                                        <th>Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($rows as $row)
                                                        <tr>
                                                            <td>{{ $row->be_no }}</td>
                                                            <td>{{ $row->be_date }}</td>
                                                            <td class="text-danger">{{ number_format($row->used, 3) }}
                                                            </td>
                                                            <td>{{ number_format($row->balance, 3) }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div> <!-- card -->

                    </div>
                </div>
            </div>

        </div> <!-- row column1 -->

    </div> <!-- container-fluid -->
</div> <!-- midde_cont -->
