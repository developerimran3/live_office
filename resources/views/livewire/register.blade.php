<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Registered <small>(C- Number)</small> </h2>
                </div>
            </div>
        </div>
        @if ($registerId)
            <div class="row column1">
                <div class="col-md-12">
                    <div class="white_shd full p-4">

                        <div class="heading1 margin_0">
                            <h2>Documents Details</h2>
                            <hr class="m-0">
                        </div>
                        <form wire:submit.prevent="updateRegister({{ $registerId }})">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" wire:model="quantity" class="form-control"
                                        placeholder="Quantity" readonly>
                                </div>
                                @if (!$container_location)
                                    <div class="col-md-3">
                                        <label for="container_location">Container Location</label>
                                        <input type="text" wire:model="container_location" name="container_location"
                                            class="form-control text-uppercase">
                                    </div>
                                @endif
                                <div class="col-md-3">
                                    <label for="be_no">B/E Number</label>
                                    <input type="text" wire:model="be_no" name="be_no" class="form-control"
                                        placeholder="B/E Number">
                                    @error('be_no')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="be_date">B/E Date</label>
                                    <input type="date" wire:model="be_date" name="be_date" class="form-control"
                                        placeholder="B/E Date">
                                    @error('be_date')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="be_lane">B/E Lane</label>
                                    <select wire:model="be_lane" name="be_lane" id="" class="form-control">
                                        <option hidden>B/E LANE</option>
                                        <option value="YELLOW">YELLOW LANE</option>
                                        <option value="RED">RED LANE</option>
                                    </select>
                                    @error('be_lane')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6 my-3">
                                    <button type="submit" class="main_bt">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        <!-- table srart -->
        <div class="row column1 pt-lg-4">
            <div class="col-md-12">
                <div class="white_shd full p-4">
                    <div class="heading1 m-0 p-0">
                        <div>
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ Session::get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @error('be_no')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @enderror
                        </div>
                        <h2 class="">All Registered Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0">
                                    <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                        id="dataTable">
                                        <thead>
                                            <tr class="register_enty">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
                                                <th>Vessel</th>
                                                <th>BL No</th>
                                                <th>Rot No</th>
                                                <th>Cont No</th>
                                                <th>Yard</th>
                                                <th>B/E No</th>
                                                <th>B/E Date</th>
                                                <th>G.W</th>
                                                <th>N.W</th>
                                                <th>B/E Lane</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registers as $register)
                                                <tr class="register_enty">
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $register->importer_name }}</td>
                                                    <td class="font-weight-bold">{{ $register->goods_name }}</td>
                                                    <td>{{ $register->quantity }} {{ $register->pkgs_code }}</td>
                                                    <td>{{ $register->vessel }}</td>
                                                    <td>{{ $register->bl_no }}</td>
                                                    <td>{{ date('Y') }}/{{ $register->rot_no }}</td>
                                                    <td>{{ $register->container_no }} x
                                                        {{ $register->container_size }}
                                                    </td>
                                                    <td>
                                                        {{ $register->container_location ? 'Y- ' . $register->container_location : '' }}
                                                    </td>
                                                    <td>
                                                        {{ $register->be_no ? 'C- ' . $register->be_no : '' }}
                                                    </td>
                                                    <td>{{ $register->be_date }}</td>
                                                    <td>{{ number_format($register->gross_weight ?? 0, 2) }} KGS</td>
                                                    <td>{{ number_format($register->net_weight ?? 0, 2) }} KGS</td>
                                                    <td
                                                        class="font-weight-bold {{ $register->be_lane === 'RED' ? 'text-danger' : '' }}
                                                            {{ $register->be_lane === 'YELLOW' ? 'text-warning' : '' }}">
                                                        {{ $register->be_lane }}
                                                    </td>
                                                    {{-- <td>{{ $register->be_lane }}</td> --}}
                                                    <td>
                                                        <a class="btn btn-sm btn-warning"
                                                            wire:click="editToregister({{ $register->id }})">
                                                            <i class="fa fa-edit"></i></a>
                                                        @if ($register->be_no && $register->be_date && $register->be_lane)
                                                            <a class="btn btn-sm btn-success"
                                                                wire:click="moveToAssessment({{ $register->id }})"
                                                                wire:confirm="Are you Move To Assessment Document?">
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
