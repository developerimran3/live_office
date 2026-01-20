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
                    </div>
                    @if (!$formShow)
                        <form wire:submit.prevent="createEnty" id="new_enty_form">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <label for="importer_name">Importer Name</label>
                                    <input type="text" wire:model="importer_name" name="importer_name"
                                        class="form-control text-uppercase">
                                    @error('importer_name')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="goods_name">Goods Name</label>
                                    <input type="text" wire:model="goods_name" name="goods_name"
                                        class="form-control text-uppercase">
                                    @error('goods_name')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" wire:model="quantity" name="quantity" class="form-control">
                                    @error('quantity')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
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
                                    <label for="container_no">Container No</label>
                                    <input type="text" wire:model="container_no"
                                        name="container_no"class="form-control text-uppercase">
                                    @error('container_no')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="container_size">Container Size</label>
                                    <select wire:model="container_size" class="form-control">
                                        <option hidden></option>
                                        <option value="20' FCL">20' FCL </option>
                                        <option value="40' FCL">40' FCL </option>
                                        <option value="20' LCL">20' LCL </option>
                                        <option value="40' LCL">40' LCL </option>
                                        <option value="BULK">BULK </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for=" lc_number">Lc Number</label>
                                    <input type="text" wire:model="lc_number" name="lc_number" class="form-control">
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
                                    <input type="text" wire:model="gross_weight" name="gross_weight"
                                        class="form-control">
                                </div>

                                <div class="col-md-3 ">
                                    <label for="arivel_date">Arivel Date</label>
                                    <input type="date" wire:model="arivel_date" class="form-control">
                                </div>

                                <div class="col-md-6 my-3">
                                    <button type="submit" class="main_bt">Create</button>
                                </div>
                            </div>
                        </form>
                    @endif

                    @if ($formShow)
                        <form wire:submit.prevent="updateEnty({{ $updateId }})" id="new_enty_form">
                            <div class="row">
                                <div class="col-md-3 ">
                                    <label for="importer_name">Importer Name</label>
                                    <input type="text" wire:model="importer_name" name="importer_name"
                                        class="form-control text-uppercase">
                                    @error('importer_name')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="goods_name">Goods Name</label>
                                    <input type="text" wire:model="goods_name" name="goods_name"
                                        class="form-control text-uppercase">
                                    @error('goods_name')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" wire:model="quantity" name="quantity"
                                        class="form-control">
                                    @error('quantity')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
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
                                    <label for="container_no">Container No</label>
                                    <input type="text" wire:model="container_no"
                                        name="container_no"class="form-control text-uppercase">
                                    @error('container_no')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="container_size">Container Size</label>
                                    <select wire:model="container_size" class="form-control">
                                        <option hidden></option>
                                        <option value="20' FCL">20' FCL </option>
                                        <option value="40' FCL">40' FCL </option>
                                        <option value="20' LCL">20' LCL </option>
                                        <option value="40' LCL">40' LCL </option>
                                        <option value="BULK">BULK </option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for=" lc_number">Lc Number</label>
                                    <input type="text" wire:model="lc_number" name="lc_number"
                                        class="form-control">
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
                                    <input type="text" wire:model="gross_weight" name="gross_weight"
                                        class="form-control">
                                </div>

                                <div class="col-md-3 ">
                                    <label for="arivel_date">Arivel Date</label>
                                    <input type="date" wire:model="arivel_date" class="form-control">
                                </div>

                                <div class="col-md-6 my-3">
                                    <button type="submit" class="main_bt">Update</button>
                                </div>
                            </div>
                        </form>
                    @endif
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
                                    <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                        id="dataTable">
                                        <thead>
                                            <tr class="new_enty_tr">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
                                                <th>Vassel</th>
                                                <th>BL No</th>
                                                <th>Cont. No</th>
                                                <th>LC No</th>
                                                <th>LC Date</th>
                                                <th>G.W</th>
                                                <th>ETA. Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enty as $enty)
                                                <tr class="new_enty_tr">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $enty->importer_name }}</td>
                                                    <td class="font-weight-bold">{{ $enty->goods_name }}</td>
                                                    <td>{{ $enty->quantity }} {{ $enty->pkgs_code }}</td>
                                                    <td>{{ $enty->vessel }}</td>
                                                    <td>{{ $enty->bl_no }}</td>
                                                    <td>{{ $enty->container_no }}x{{ $enty->container_size }}</td>
                                                    <td>{{ $enty->lc_number }}</td>
                                                    <td>{{ $enty->lc_date }}</td>
                                                    <td>{{ number_format($enty->gross_weight ?? 0, 2) }} KGS</td>
                                                    <td>{{ $enty->arivel_date }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-warning data-edit"
                                                            wire:click="editToEnty({{ $enty->id }})"><i
                                                                class="fa fa-edit"></i></a>
                                                        @if (
                                                            $enty->importer_name &&
                                                                $enty->goods_name &&
                                                                $enty->quantity &&
                                                                $enty->pkgs_code &&
                                                                $enty->bl_no &&
                                                                $enty->container_no &&
                                                                $enty->container_size &&
                                                                $enty->lc_number &&
                                                                $enty->lc_date &&
                                                                $enty->gross_weight &&
                                                                $enty->arivel_date)
                                                            <a class="btn btn-sm btn-success"
                                                                wire:click="moveToReceived({{ $enty->id }})"
                                                                wire:confirm="Are you Move To Received Document?">
                                                                <i class="fa fa-arrow-circle-right "></i></a>
                                                        @endif
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
