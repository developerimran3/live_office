 <!-- end topbar -->
 <div class="midde_cont">
     <div class="container-fluid">
         <div class="row column_title">
             <div class="col-md-12">
                 <div class="page_title">
                     <h2>Orginial Documents Received</h2>
                 </div>
             </div>
         </div>
         @if ($receivedId)
             <div class="row column1">
                 <div class="col-md-12">
                     <div class="white_shd full p-4">
                         <div class="heading1 margin_0">
                             <h2>Documents Details</h2>
                             <hr class="m-0">
                         </div>
                         <form wire:submit.prevent="updateReceived({{ $receivedId }})">
                             <div class="row">
                                 <div class="col-md-3">
                                     <label for="quantity">Quantity</label>
                                     <input type="text" wire:model="quantity" class="form-control"
                                         placeholder="Quantity" readonly>
                                 </div>
                                 @if (!$vessel)
                                     <div class="col-md-3">
                                         <label for="vessel">Vessel</label>
                                         <input type="text" wire:model="vessel" name="vessel"
                                             class="form-control text-uppercase">
                                     </div>
                                 @endif
                                 <div class="col-md-3">
                                     <label for="vessel">Rotation No</label>
                                     <input type="text" wire:model="rot_no" name="rot_no" class="form-control">
                                     @error('rot_no')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-3">
                                     <label for="container_location">Container Location</label>
                                     <input type="text" wire:model="container_location" name="container_location"
                                         class="form-control text-uppercase">
                                 </div>
                                 <div class="col-md-3">
                                     <label for="invoice_value">Invoice Value</label>
                                     <input type="text" wire:model="invoice_value" name="invoice_value"
                                         class="form-control" placeholder="Invoice Value">
                                     @error('invoice_value')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-3">
                                     <label for="invoice_no">Invoice Number</label>
                                     <input type="text" wire:model="invoice_no" name="invoice_no"
                                         class="form-control text-uppercase" placeholder="Invoice Number">
                                     @error('invoice_no')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-3">
                                     <label for="invoice_date">Invoice Date</label>
                                     <input type="date" wire:model="invoice_date" name="invoice_date"
                                         class="form-control" placeholder="Invoice Date">
                                     @error('invoice_date')
                                         <p class="text-danger"> {{ $message }}</p>
                                     @enderror
                                 </div>
                                 <div class="col-md-3">
                                     <label for="net_weight">Net Weight</label>
                                     <input type="text" wire:model="net_weight" name="net_weight"
                                         class="form-control" placeholder="Net Weight">
                                     @error('net_weight')
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
                     <div>
                         @if (Session::has('success'))
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                                 {{ Session::get('success') }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                         @endif
                         @error('invoice_no')
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 {{ $message }}
                                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                         @enderror
                     </div>
                     <div class="heading1 m-0 p-0">
                         <h2 class="">All Received Documents</h2>
                     </div>
                     <div class="row column1">
                         <div class="col-md-12">
                             <div class=" full">
                                 <div class="heading1 margin_0">
                                     <table class="table table-bordered table-striped mb-none dataTable no-footer "
                                         id="dataTable">
                                         <thead>
                                             <tr class="document_received">
                                                 <th>#</th>
                                                 <th>Importer Name</th>
                                                 <th>Goods Name</th>
                                                 <th>Quantity</th>
                                                 <th>Vessel</th>
                                                 <th>BL. No</th>
                                                 <th>Rot. No</th>
                                                 <th>Yard</th>
                                                 <th>Value</th>
                                                 <th>Invoice No</th>
                                                 <th>IV. Date</th>
                                                 <th>N.W</th>
                                                 <th>Rec. Doc</th>
                                                 <th>Action</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($receiveds as $receive)
                                                 <tr class="document_received">
                                                     <td> {{ $loop->iteration }} </td>
                                                     <td>{{ $receive->importer_name }}</td>
                                                     <td class="font-weight-bold">{{ $receive->goods_name }}</td>
                                                     <td>{{ $receive->quantity }} {{ $receive->pkgs_code }}</td>
                                                     <td>{{ $receive->vessel }}</td>
                                                     <td>{{ $receive->bl_no }}</td>
                                                     <td>{{ $receive->rot_no ? date('Y') . '/' . $receive->rot_no : '' }}
                                                     </td>
                                                     <td>
                                                         {{ $receive->container_location ? 'Y- ' . $receive->container_location : '' }}
                                                     </td>
                                                     <td>$ {{ number_format($receive->invoice_value ?? 0, 2) }}</td>
                                                     <td>{{ $receive->invoice_no }}</td>
                                                     <td>{{ $receive->invoice_date }}</td>
                                                     <td>{{ number_format($receive->net_weight ?? 0, 2) }} KGS</td>
                                                     <td>{{ $receive->document_receiver }}</td>
                                                     <td>
                                                         <a class="btn btn-sm btn-warning"
                                                             wire:click="editToReceived({{ $receive->id }})">
                                                             <i class="fa fa-edit"></i></a>
                                                         @if (
                                                             $receive->invoice_value &&
                                                                 $receive->invoice_no &&
                                                                 $receive->invoice_date &&
                                                                 $receive->net_weight &&
                                                                 $receive->rot_no &&
                                                                 $receive->vessel)
                                                             <a class="btn btn-sm btn-success"
                                                                 wire:click="moveToRegister({{ $receive->id }})"
                                                                 wire:confirm="Are you Move To Register Document?">
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
         </div>
         <!-- table end -->
