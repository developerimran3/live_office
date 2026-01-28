<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Bond Licence</h2>
                </div>
            </div>
        </div>
        <div class="row column1">
            <div class="col-md-5">
                <div class="white_shd full p-4">
                    <div class="heading1 margin_0">
                        <h2>Licence Details</h2>
                        <hr class="m-0">
                    </div>
                    <form wire:submit.prevent="bondlicence()">
                        <div class="row">
                            <div class="col-md-7">
                                <label for="quantity">Goods Name</label>
                                <input type="text" wire:model="goods_name" name="goods_name"
                                    class="form-control text-uppercase">
                            </div>

                            <div class="col-md-5">
                                <label for="availability">M.T/GG SET</label>
                                <input type="number" wire:model="availability" name="availability"
                                    class="form-control">
                            </div>
                            <div class="col-md-6 my-3">
                                <button type="submit" class="main_bt">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- table srart -->
            <div class="col-md-7">
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
                        <h2>All Availability</h2>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Goods Name</th>
                                <th>B/E No</th>
                                <th>B/E Date</th>
                                <th>LC No</th>
                                <th>Availability</th>
                                <th>Total Minus</th>
                                <th>Balance</th>
                                <th>% Used</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- @foreach ($this->registers as $register)
                                <tr>
                                    <td>{{ $register->be_no }}</td>
                                    <td>{{ $register->be_date }}</td>
                                    <td>{{ $register->goods_name }}</td>
                                    <td>{{ $register->lc_no }}</td>
                                    <td>{{ $register->net_weight }}</td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- table end -->
        </div>
    </div>
</div>
