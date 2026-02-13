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
                        <h2>Documents Details</h2>
                        <hr class="m-0">
                        <button type="button" wire:click="addItem" class="btn btn-info mt-2">
                            + Add Item
                        </button>

                        <button type="button" wire:click="addContainer" class="btn btn-warning mt-2">
                            + Add Container
                        </button>

                    </div>

                    <form wire:submit.prevent="{{ $formShow ? 'updateEnty' : 'createEnty' }}">
                        <div class="row">

                            <div class="col-md-2">
                                <label for="importer_name">Importer Name</label>
                                <input type="text" wire:model="importer_name" name="importer_name"
                                    class="form-control text-uppercase">
                                @error('importer_name')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <!-- GOODS ITEMS -->
                            @foreach ($items as $index => $item)
                                <div class="col-md-2 ">
                                    <label for="goods_name">Goods Name</label>
                                    <input type="text" wire:model="items.{{ $index }}.goods_name"
                                        name="goods_name" class="form-control text-uppercase bg-info text-white">
                                    @error('goods_name')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" wire:model="items.{{ $index }}.quantity"
                                        name="quantity" class="form-control bg-info text-white">
                                    @error('quantity')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2 d-flex align-items-end">

                                    <button type="button" wire:click="removeItem({{ $index }})"
                                        class="btn btn-danger">
                                        x
                                    </button>
                                </div>
                            @endforeach
                            <div class="col-md-2">
                                <label for="pkgs_code">Pkgs Code</label>
                                <select wire:model="pkgs_code" class="form-control">
                                    <option hidden></option>
                                    <option value="ROLLS">ROLLS </option>
                                    <option value="PKGS">PKGS </option>
                                    <option value="BALES">BALES </option>
                                    <option value="CTNS">CTNS </option>
                                    <option value="BAGS">BAGS </option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="vessel">Vessel</label>
                                <input type="text" wire:model="vessel" name="vessel"
                                    class="form-control text-uppercase">
                            </div>
                            <div class="col-md-2">
                                <label for="bl_no">BL No</label>
                                <input type="text" wire:model="bl_no" name="bl_no"
                                    class="form-control text-uppercase">
                                @error('bl_no')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Container --}}
                            @foreach ($containers as $index => $container)
                                <div class="col-md-2">
                                    <label for="container_no">Container No</label>
                                    <input type="text" <input type="text"
                                        wire:model="containers.{{ $index }}.container_no"
                                        name="container_no"class="form-control text-uppercase bg-warning text-white">
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

                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" wire:click="removeContainer({{ $index }})"
                                        class="btn btn-danger">
                                        x
                                    </button>
                                </div>
                            @endforeach

                            <div class="col-md-2">
                                <label for=" lc_number">Lc Number</label>
                                <input type="number" wire:model="lc_number" name="lc_number" class="form-control">
                                @error('lc_number')
                                    <p class="text-danger"> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="lc_date">LC Date</label>
                                <input type="date" wire:model="lc_date" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <label for="gross_weight">Gross Weight</label>
                                <input type="number" wire:model="gross_weight" step="0.001" name="gross_weight"
                                    class="form-control">
                            </div>

                            <div class="col-md-2 ">
                                <label for="arivel_date">Arivel Date</label>
                                <input type="date" wire:model="arivel_date" class="form-control">
                            </div>

                            <div class="col-md-12 my-3">
                                <button class="main_bt"">
                                    {{ $formShow ? 'Update' : 'Create' }}
                                </button>
                            </div>

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
                                    <table class="table table-bordered table-striped" id="dataTable">
                                        <thead>
                                            <tr class="new_enty_tr">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
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
                                        <tbody>
                                            @foreach ($enty as $e)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $e->importer_name }}</td>
                                                    <td>
                                                        @foreach ($e->items as $item)
                                                            {{ $item->goods_name }} <br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($e->items as $item)
                                                            {{ $item->quantity }} {{ $e->pkgs_code }} <br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $e->vessel }}</td>
                                                    <td>{{ $e->bl_no }}</td>

                                                    <td>
                                                        @foreach ($e->containers as $container)
                                                            {{ $container->container_no }} x
                                                            {{ $container->container_size }}
                                                            <br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $e->lc_number }}</td>
                                                    <td>{{ $e->lc_date }}</td>
                                                    <td>{{ number_format($e->gross_weight ?? 0, 2) }} KGS</td>
                                                    <td>{{ $e->arivel_date }}</td>
                                                    <td>
                                                        <a class="btn btn-warning btn-sm"
                                                            wire:click="editToEnty({{ $e->id }})"> <i
                                                                class="fa fa-edit"></i></a>
                                                        <a class="btn btn-danger btn-sm"
                                                            wire:click="deleteEnty({{ $e->id }})"
                                                            wire:confirm="Are you sure? Document Delete?"> <i
                                                                class="fa fa-trash"></i></a>
                                                        <a class="btn btn-success btn-sm"
                                                            wire:click="moveToReceived({{ $e->id }})"
                                                            wire:confirm="Are you Move To Received Document?"> <i
                                                                class="fa fa-arrow-circle-right "></i></a>
                                                    </td>
                                                </tr>
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
