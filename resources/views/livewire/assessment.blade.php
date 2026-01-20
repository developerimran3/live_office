<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Assessment To Delivery</h2>
                </div>
            </div>
        </div>
        @if ($assessmentId)
            <div class="row column1">
                <div class="col-md-12">
                    <div class="white_shd full p-4">
                        <div class="heading1 margin_0">
                            <h2>Documents Details</h2>
                            <hr class="m-0">
                        </div>
                        <form wire:submit.prevent="updateAssessment({{ $assessmentId }})">
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
                                    <label for="assessment_date">Assessment Date</label>
                                    <input type="date" wire:model="assessment_date" name="assessment_date"
                                        class="form-control">
                                    @error('assessment_date')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="r_no">R No</label>
                                    <input type="text" wire:model="r_no" name="r_no" class="form-control">
                                    @error('r_no')
                                        <p class="text-danger"> {{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-3">
                                    <label for="document">Document</label>
                                    <input type="file" wire:model="document" class="form-control">
                                    @error('document')
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
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ Session::get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @error('r_no')
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $message }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @enderror
                        <h2 class="">All Assessment Documents</h2>
                    </div>
                    <div class="row column1">
                        <div class="col-md-12">
                            <div class=" full">
                                <div class="heading1 margin_0">
                                    <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                        id="dataTable">
                                        <thead>
                                            <tr class="assessment">
                                                <th>#</th>
                                                <th>Importer Name</th>
                                                <th>Lc No</th>
                                                <th>Goods Name</th>
                                                <th>Quantity</th>
                                                <th>B/E No</th>
                                                <th>B/E Date</th>
                                                <th>Ass. Date</th>
                                                <th>R No</th>
                                                <th>G. W</th>
                                                <th>Cont. No</th>
                                                <th>Yard</th>
                                                <th>Doc</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($assessments as $assessment)
                                                <tr class="assessment">
                                                    <td> {{ $loop->iteration }} </td>
                                                    <td>{{ $assessment->importer_name }}</td>
                                                    <td>{{ $assessment->lc_number }}</td>
                                                    <td class="font-weight-bold">{{ $assessment->goods_name }}</td>
                                                    <td>{{ $assessment->quantity }} {{ $assessment->pkgs_code }}</td>
                                                    <td>
                                                        {{ $assessment->be_no ? 'C- ' . $assessment->be_no : '' }}
                                                    </td>
                                                    <td>{{ $assessment->be_date }}</td>
                                                    <td>{{ $assessment->assessment_date }}</td>
                                                    <td>
                                                        {{ $assessment->r_no ? 'R- ' . $assessment->r_no : '' }}
                                                    </td>
                                                    <td>{{ number_format($assessment->gross_weight ?? 0, 2) }} KGS</td>
                                                    <td>{{ $assessment->container_no }} x
                                                        {{ $assessment->container_size }}
                                                    </td>
                                                    <td>
                                                        {{ $assessment->container_location ? 'Y- ' . $assessment->container_location : '' }}
                                                    </td>
                                                    <td>
                                                        @if ($assessment->document)
                                                            <a href="{{ Storage::url($assessment->document) }}"
                                                                target="_blank" class="btn btn-sm btn-info">
                                                                View
                                                            </a>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a class="btn btn-sm btn-warning"
                                                            wire:click="editToAssessment({{ $assessment->id }})">
                                                            <i class="fa fa-edit"></i></a>
                                                        @if ($assessment->assessment_date && $assessment->r_no && $assessment->container_location)
                                                            <a class="btn btn-success"
                                                                wire:click.prevent="confirmMoveToDelivery({{ $assessment->id }})">
                                                                <i class="fa fa-arrow-circle-right"></i>
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
        </div>
    </div>
    <!-- Delivery Modal -->
    @if ($showDeliveryModal)
        <div class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-3">
                    <h5>Move to Delivery</h5>

                    <div class="form-group">
                        <label for="delivery_date">Delivery Date</label>
                        <input type="date" id="delivery_date" wire:model="delivery_date" class="form-control">
                        @error('delivery_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end mt-2">
                        <button class="btn btn-success"
                            wire:click="moveToDelivery({{ $assessment->id }})">Confirm</button>
                        <button class="btn btn-secondary ml-2"
                            wire:click="$set('showDeliveryModal', false)">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
