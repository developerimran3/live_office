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

        <div class="row column1 mt-2">

            <!-- Licence Form -->
            <div class="col-md-5">
                <div class="white_shd full p-4">
                    <div class="heading1 margin_0">
                        <h2>Licence Details</h2>
                        <hr class="m-0">
                    </div>

                    <form wire:submit.prevent="bondlicence">
                        <div class="row">
                            <!-- Type Selector -->
                            <div class="col-md-4">
                                <label>Minus or In Stok</label>
                                <select class="form-control" wire:model.lazy="type">
                                    <option value="">--Select--</option>
                                    <option value="MINUS">MINUS</option>
                                    <option value="STOCK">IN STOCK</option>
                                </select>
                            </div>

                            @if ($type == 'MINUS')
                                <div class="col-md-4">
                                    <label>B/E Number</label>
                                    <select wire:model.live="be_no" class="form-control">
                                        <option value="">--select--</option>
                                        @foreach ($register as $r)
                                            <option value="{{ $r->be_no }}">{{ $r->be_no }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label>Date</label>
                                    <input type="date" wire:model="be_date" class="form-control" readonly>
                                </div>
                                <div class="col-md-5 mt-2">
                                    <label>Goods Name</label>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label>Net Weight</label>
                                </div>
                                @if ($items == 'gg_set==null')
                                    <div class="col-md-3 mt-2">
                                        <label>GG Set</label>
                                    </div>
                                @endif

                                @foreach ($items as $index => $item)
                                    <div class="col-md-5 my-2">

                                        <input type="text" wire:model="items.{{ $index }}.goods_name"
                                            class="form-control text-uppercase text-white bg-info" readonly>
                                    </div>

                                    <div class="col-md-4 my-2">
                                        <input type="number" step="0.001" class="form-control"
                                            wire:model="items.{{ $index }}.net_weight" readonly>
                                    </div>

                                    @if ($items == 'gg_set==null')
                                        <div class="col-md-3 my-2">
                                            <input type="number" step="0.001"
                                                wire:model="items.{{ $index }}.gg_set" name="gg_set"
                                                class="form-control" placeholder="GG Set">
                                        </div>
                                    @endif
                                @endforeach
                            @endif


                            @if ($type == 'STOCK')
                                <div class="col-md-4">
                                    <label>Goods Name</label>
                                    <select class="form-control" wire:model="goods_name">
                                        <option value="">--Select--</option>
                                        <option value="Leather">Leather</option>
                                        <option value="Interlining">Interlining </option>
                                        <option value="Zipper">Zipper </option>
                                        <option value="Slider">Slider </option>
                                        <option value="Buckle">Buckle </option>
                                        <option value="Rivet">Rivet,Eyelet </option>
                                        <option value="PolyTag">Poly Tag </option>
                                        <option value="MetalSticker">Metal Sticker </option>
                                    </select>
                                    @error('goods_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label>Allocation</label>
                                    <input type="text" wire:model="allocation" class="form-control">
                                    @error('allocation')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            @endif

                            <div class="col-md-12 my-3">
                                <button type="submit" class="main_bt w-100">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Tables -->
            {{-- <div class="col-md-7">
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
            </div> --}}
        </div>
    </div>
</div>
