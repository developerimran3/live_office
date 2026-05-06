<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>New Enty By Copy BL</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-12">
                <div class="white_shd full p-4">
                    <div>
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="heading1 margin_0">
                        <h2>{{ $formShow ? 'Update Document' : 'Add New Document' }}</h2>
                        <hr class="m-0">
                    </div>

                    <form wire:submit.prevent="{{ $formShow ? 'updateEnty' : 'createEnty' }}">
                        <div class="row">
                            @if ($step == 1)
                                <div class="col-md-3">
                                    <label for="importer_name">Importer Name</label>
                                    <input type="text" wire:model="importer_name" name="importer_name"
                                        class="form-control text-uppercase">
                                    @error('importer_name')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="total_quantity">Total Quantity</label>
                                    <input type="number" wire:model="total_quantity" name="quantity"
                                        class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label for="pkgs_code">Pkgs Code</label>
                                    <select wire:model.lazy="pkgs_code" class="form-control">
                                        <option hidden></option>
                                        <option value="ROLLS">ROLLS </option>
                                        <option value="PKGS">PKGS </option>
                                        <option value="BALES">BALES </option>
                                        <option value="CTNS">CTNS </option>
                                        <option value="BAGS">BAGS </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="vessel">Vessel</label>
                                    <input type="text" wire:model="vessel" name="vessel"
                                        class="form-control text-uppercase">
                                </div>
                                <div class="col-md-3">
                                    <label for="bl_no">BL No</label>
                                    <input type="text" wire:model="bl_no" name="bl_no"
                                        class="form-control text-uppercase">
                                    @error('bl_no')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for=" lc_number">Lc Number</label>
                                    <input type="number" wire:model="lc_number" name="lc_number" class="form-control">
                                    @error('lc_number')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="lc_date">LC Date</label>
                                    <input type="date" wire:model="lc_date" class="form-control">
                                </div>

                                <div class="col-md-3">
                                    <label for="gross_weight">Gross Weight</label>
                                    <input type="number" wire:model="gross_weight" step="0.001" name="gross_weight"
                                        class="form-control">
                                </div>

                                <div class="col-md-3 ">
                                    <label for="arivel_date">Arivel Date</label>
                                    <input type="date" wire:model="arivel_date" class="form-control">
                                </div>

                                <div class="col-md-12 my-3 text-right">
                                    <button type="button" wire:click="nextStep" class="main_bt">
                                        Next →
                                    </button>
                                </div>
                            @endif
                            <!-- ADD ITEMS AND ADD CONTAINER -->

                            @if ($step == 2)
                                <div class="col-md-1 mb-3">
                                    <button type="button" wire:click="addItem" class="btn btn-info">
                                        + Add Item
                                    </button>
                                </div>
                                <div class="col-md-1 mb-3">
                                    <button type="button" wire:click="addContainer" class="btn btn-warning">
                                        + Add Container
                                    </button>
                                </div>
                                <div class="col-md-8 mb-3">
                                </div>

                                @foreach ($items as $index => $item)
                                    <div class="col-md-4 ">
                                        <label for="goods_name ">Goods Name</label>
                                        <input type="text" wire:model="items.{{ $index }}.goods_name"
                                            name="goods_name" class="form-control text-uppercase bg-info">
                                    </div>
                                    <div class="col-md-4  d-flex align-items-end">
                                        <button type="button" wire:click="removeItem({{ $index }})"
                                            class="btn btn-info">
                                            x
                                        </button>
                                    </div>
                                    <div class="col-md-4"> </div>
                                @endforeach

                                @foreach ($containers as $index => $container)
                                    <div class="col-md-4 my-1">
                                        <label for="container_no">Container No</label>
                                        <input type="text" wire:model="containers.{{ $index }}.container_no"
                                            name="container_no"class="form-control text-uppercase bg-warning">
                                        @error('container_no')
                                            <p class="text-danger"> {{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-md-2">
                                        <label for="container_size">Container Size</label>
                                        <select wire:model="containers.{{ $index }}.container_size"
                                            class="form-control">
                                            <option hidden></option>
                                            <option value="20' FCL">20' FCL </option>
                                            <option value="40' FCL">40' FCL </option>
                                            <option value="20' LCL">20' LCL </option>
                                            <option value="40' LCL">40' LCL </option>
                                            <option value="BULK">BULK </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="button" wire:click="removeContainer({{ $index }})"
                                            class="btn btn-warning">
                                            x
                                        </button>
                                    </div>
                                @endforeach
                                <div class="col-md-12 my-3">

                                    <button type="button" wire:click="prevStep" class="btn btn-secondary">
                                        ← Back
                                    </button>

                                    <button class="main_bt float-right">
                                        {{ $formShow ? 'Update' : 'Create' }}
                                    </button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- table srart -->
        <div class="row column1 pt-lg-4">
            <div class="col-md-12">
                <div class="white_shd full p-4">
                    <div class="heading1 m-0 p-0">
                        <h2 class="">All New Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0">
                                    <table class="table table-bordered align-middle ">
                                        <thead>
                                            <tr class="new_enty_tr">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Goods Name</th>
                                                <th>Total Quantity</th>
                                                <th>Vessel</th>
                                                <th>BL No</th>
                                                <th>Container</th>
                                                <th>LC No</th>
                                                <th>LC Date</th>
                                                <th>G.W</th>
                                                <th>ETA Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-uppercase">
                                            @foreach ($enty as $e)
                                                @php
                                                    $rowspan = max($e->items->count(), 1);
                                                    $first = true;
                                                @endphp

                                                @foreach ($e->items as $item)
                                                    <tr>
                                                        {{-- INDEX --}}
                                                        @if ($first)
                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ $loop->parent->iteration }}</td>

                                                            <td rowspan="{{ $rowspan }}">{{ $e->importer_name }}
                                                            </td>
                                                        @endif
                                                        {{-- GOODS --}}
                                                        <td>{{ $item->goods_name }}</td>
                                                        {{-- COMMON FIELDS (ONLY FIRST ROW) --}}
                                                        @if ($first)
                                                            <td class="font-weight-bold"
                                                                rowspan="{{ $rowspan }}">
                                                                {{ $e->total_quantity }} {{ $e->pkgs_code }}
                                                            </td>
                                                            <td rowspan="{{ $rowspan }}">{{ $e->vessel }}
                                                            </td>
                                                            <td rowspan="{{ $rowspan }}">{{ $e->bl_no }}
                                                            </td>

                                                            {{-- CONTAINER (MULTIPLE INSIDE SAME CELL) --}}
                                                            <td rowspan="{{ $rowspan }}">
                                                                @foreach ($e->containers as $container)
                                                                    <span class="badge mb-1 d-dark"
                                                                        style="font-size: 10px;">
                                                                        {{ $container->container_no }} x
                                                                        {{ $container->container_size }}
                                                                    </span>
                                                                @endforeach
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">{{ $e->lc_number }}
                                                            </td>
                                                            <td rowspan="{{ $rowspan }}">{{ $e->lc_date }}
                                                            </td>
                                                            <td rowspan="{{ $rowspan }}">
                                                                {{ number_format($e->gross_weight ?? 0, 2) }} KGS
                                                            </td>
                                                            <td rowspan="{{ $rowspan }}">{{ $e->arivel_date }}
                                                            </td>

                                                            <td rowspan="{{ $rowspan }}">
                                                                <a class="btn btn-warning btn-sm"
                                                                    wire:click="editToEnty({{ $e->id }})">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>

                                                                <a class="btn btn-danger btn-sm"
                                                                    wire:click="deleteEnty({{ $e->id }})"
                                                                    wire:confirm="Are you sure? Document Delete?">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>

                                                                <a class="btn btn-success btn-sm"
                                                                    wire:click="moveToReceived({{ $e->id }})"
                                                                    wire:confirm="Are you Move To Received Document?">
                                                                    <i class="fa fa-arrow-circle-right"></i>
                                                                </a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    @php $first = false; @endphp
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
